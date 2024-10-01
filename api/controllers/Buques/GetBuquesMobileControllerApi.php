<?php

namespace Api\Controllers\Buques;

use Api\Services\Auth\AuthService;
use Api\Middleware\Response\ResponseMiddleware;
use Api\Middleware\Authorization\AuthorizationMiddleware;

require_once __DIR__ . '/../../services/Auth/AuthService.php';
require_once __DIR__ . '/../../middleware/Authorization/AuthorizationMiddleware.php';
require_once __DIR__ . '/../../middleware/Response/ResponseMiddleware.php';
require_once __DIR__ . '/../../services/Auth/AuthService.php';
require_once __DIR__ . '/../../../DependencyInjection.php';

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

    public function handleRequest()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            if (!isset($request["action"]) || $request["action"] !== "listall") {
                ResponseMiddleware::error("Acción no permitida", 403);
                return;
            }

            $decodedToken = $this->authService->validateToken($this->getAuthorizationHeader());
            AuthorizationMiddleware::checkRolePermission($decodedToken->data->role, ['ADMIN', 'Super Usuario']);

            $response = $this->getBuquesService->getBuques();
            $buques = $response->getBuques();

            $result = [];
            foreach ($buques as $buque) {
                $result[] = [
                    'id' => $buque->getId(),
                    'codigo' => $buque->getCodigo(),
                    'nombre' => $buque->getNombre(),
                    'recaladas' => $buque->getTotalRecaladas(),
                    'atenciones' => $buque->getTotalAtenciones(),
                ];
            }

            ResponseMiddleware::success([
                "status" => "success",
                "data" => $result
            ]);
        } catch (\Exception $e) {
            // Loguea y maneja los errores
            $this->logError($e);
            ResponseMiddleware::error("Error en el servidor", 500);
        }
    }

    private function getAuthorizationHeader()
    {
        $headers = apache_request_headers();

        $authHeader = $headers['Authorization'] ?? '';
        if (!$authHeader) {
            throw new \Exception("Token de autorización no proporcionado.");
        }
        return $authHeader;
    }

    private function logError(\Exception $e)
    {
        error_log("[ERROR] " . $e->getMessage() . " en " . $e->getFile() . " línea " . $e->getLine());
    }
}
