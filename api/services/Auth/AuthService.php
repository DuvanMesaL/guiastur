<?php

namespace Api\Services\Auth;

require_once __DIR__ . '/../../Helpers/JWTHandler.php';
require_once __DIR__ . '/../../../Domain/Constants/RolTypeEnum.php';
require_once __DIR__ . '/../../../Application/Exceptions/InvalidPermissionException.php';

use Api\Helpers\JWTHandler;

class AuthService
{
    public function validateToken($authHeader)
    {
        if (strpos($authHeader, 'Bearer ') === 0) {
            $token = str_replace('Bearer ', '', $authHeader);
        } else {
            throw new \InvalidPermissionException("Token no proporcionado.");
        }

        if (!JWTHandler::validateToken($token)) {
            throw new \InvalidPermissionException("Token no válido o expirado.");
        }

        return JWTHandler::decodeJWT($token);
    }

    public function checkRolePermission($userRole, $requiredRoles)
    {
        if (!in_array($userRole, $requiredRoles)) {
            throw new \InvalidPermissionException("No tiene permisos suficientes.");
        }
    }
}
