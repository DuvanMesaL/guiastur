<?php

namespace Api\Controllers\Buques;

use Api\Services\Auth\AuthService;
use Api\Middleware\Request\RequestMiddleware;
use Api\Middleware\Response\ResponseMiddleware;
use Api\Middleware\Authorization\AuthorizationMiddleware;

require_once __DIR__ . '/../../services/Auth/AuthService.php';
require_once __DIR__ . '/../../middleware/Authorization/AuthorizationMiddleware.php';
require_once __DIR__ . '/../../middleware/Request/RequestMiddleware.php';
require_once __DIR__ . '/../../middleware/Response/ResponseMiddleware.php';
require_once __DIR__ . '/../../../Application/UseCases/CreateBuque/Dto/CreateBuqueRequest.php';
require_once __DIR__ . '/../../../Application/UseCases/CreateBuque/CreateBuqueUseCase.php';
require_once __DIR__ . '/../../../DependencyInjection.php';

class CreateBuqueMobileController
{
    private $createBuqueService;
    private $authService;

    public function __construct()
    {
        $this->createBuqueService = \DependencyInjection::getCreateBuqueServce();
        $this->authService = new AuthService();
    }

    public function handleRequest(array $request)
    {
        try {
            if ($request["action"] !== "create") {
                ResponseMiddleware::error("Acción no permitida", 403);
            }

            $decodedToken = $this->authService->validateToken($this->getAuthorizationHeader());

            AuthorizationMiddleware::checkRolePermission($decodedToken->data->role, ['ADMIN', 'Super Usuario']);

            RequestMiddleware::validateCreateBuqueRequest($request);

            $createRequest = new \CreateBuqueRequest($request['codigo'], $request['nombre'], null, $decodedToken->data->userId);
            $response = $this->createBuqueService->CreateBuque($createRequest);

            ResponseMiddleware::success($response->toJSON());
        } catch (\InvalidArgumentException $e) {
            ResponseMiddleware::error($e->getMessage(), 400);
        } catch (\Exception $e) {
            ResponseMiddleware::error("Error interno del servidor", 500);
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
}
