<?php

namespace Api\Controllers\Buques;

use Api\Services\Auth\AuthService;
use Api\Middleware\Response\ResponseMiddleware;
use Api\Middleware\Authorization\AuthorizationMiddleware;

require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/services/Auth/AuthService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/middleware/Authorization/AuthorizationMiddleware.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/middleware/Response/ResponseMiddleware.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/DependencyInjection.php";

class GetBuquesMobileControllerApi
{
    private $authService;
    private $getBuquesService;

    public function __construct()
    {
        try {
            $this->authService = new AuthService();
            $this->getBuquesService = \DependencyInjection::getBuquesService();
        } catch (\Exception $e) {
            $this->logError($e);
            ResponseMiddleware::error("Error en el constructor", 500);
        }
    }

    public function handleRequest($request = null)
    {
        try {
            // Validación de la acción
            if (!isset($request["action"]) || $request["action"] !== "listall") {
                ResponseMiddleware::error("Acción no permitida", 403);
                return;
            }

            // Validación del token
            $decodedToken = $this->authService->validateToken($this->getAuthorizationHeader());
            AuthorizationMiddleware::checkRolePermission($decodedToken->data->role, ['ADMIN', 'Super Usuario']);

            // Parámetros de paginación
            $page = isset($request['page']) ? (int)$request['page'] : 1;
            $perPage = isset($request['perPage']) ? (int)$request['perPage'] : 20;

            // Obtén todos los buques (sin paginación en el servicio)
            $response = $this->getBuquesService->getBuques();
            $buques = $response->getBuques();

            // Total de buques
            $total = count($buques);

            // Lógica de paginación
            $offset = ($page - 1) * $perPage;
            $paginatedBuques = array_slice($buques, $offset, $perPage);

            // Formateo de la respuesta
            $result = [];
            foreach ($paginatedBuques as $buque) {
                $result[] = [
                    'id' => $buque->getId(),
                    'codigo' => $buque->getCodigo(),
                    'nombre' => $buque->getNombre(),
                    'recaladas' => $buque->getTotalRecaladas(),
                    'atenciones' => $buque->getTotalAtenciones(),
                ];
            }

            // Respuesta con paginación
            ResponseMiddleware::success([
                'data' => $result,
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            $this->logError($e);
            ResponseMiddleware::error("Error en el servidor", 500);
        }
    }

    private function getAuthorizationHeader()
    {
        try {
            $headers = apache_request_headers();
            $authHeader = $headers['Authorization'] ?? '';

            if (!$authHeader) {
                throw new \Exception("Token de autorización no proporcionado.");
            }
            return $authHeader;
        } catch (\Exception $e) {
            $this->logError($e);
            throw $e;
        }
    }

    private function logError(\Exception $e)
    {
        error_log("[ERROR] " . $e->getMessage() . " en " . $e->getFile() . " línea " . $e->getLine());
    }
}
