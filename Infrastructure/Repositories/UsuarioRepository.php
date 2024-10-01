<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Entities/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/DuplicateEntryException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/NotFoundEntryException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Infrastructure/Repositories/Utility.php";

use ActiveRecord\DatabaseException;

class UsuarioRepository implements IUsuarioRepository
{
    public function find(int $id): Usuario
    {
        try {
            return Usuario::find($id);
        } catch (Exception $e) {
            $resul = Utility::getNotFoundRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "No existe un " . $resul[UtilConstantsEnum::TABLE_NAME] . " con ID: " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new NotFoundEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }

    public function findByEmail(string $email): Usuario
    {
        try {
            $user = Usuario::find_by_email($email);
            if (!$user) {
                throw new NotFoundEntryException("Usuario con email $email no existe");
            }
            return $user;
        } catch (Exception $e) {
            $resul = Utility::getNotFoundRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "No existe un " . $resul[UtilConstantsEnum::TABLE_NAME] . " con ID: " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new NotFoundEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }

    public function findByToken(string $token): Usuario
    {
        try {
            $user = Usuario::find_by_validation_token($token);
            if (!$user) {
                throw new NotFoundEntryException("Usuario con Token $token no existe");
            }
            return $user;
        } catch (Exception $e) {
            $resul = Utility::getNotFoundRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "No existe un " . $resul[UtilConstantsEnum::TABLE_NAME] . " con ID: " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new NotFoundEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }

    public function findAll(): array
    {
        try {
            return Usuario::all();
        } catch (Exception $e) {
            throw Utility::errorHandler($e);
        }
    }

    public function create(Usuario $usuario): Usuario
    {
        try {
            $usuario->validation_token = Utility::generateGUID();
            $usuario->save();
            return $usuario;
        } catch (Exception $e) {
            $resul = Utility::getDuplicateRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "Usuario ya existe: " . $resul[UtilConstantsEnum::COLUMN_NAME] . ": " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new DuplicateEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }

    public function update(Usuario $usuario): Usuario
    {
        $this->find($usuario->id);
        try {
            $usuario->save();
            return $usuario;
        } catch (Exception $e) {
            $resul = Utility::getNotFoundRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "No existe un " . $resul[UtilConstantsEnum::TABLE_NAME] . " con ID: " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new NotFoundEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }

    public function delete(int $id): bool
    {
        try {
            $usuario = $this->find($id);
            return $usuario->delete();
        } catch (Exception $e) {
            $resul = Utility::getNotFoundRecordInfo($e->getMessage());
            if (count($resul) > 0) {
                $message = "No existe un " . $resul[UtilConstantsEnum::TABLE_NAME] . " con ID: " . $resul[UtilConstantsEnum::COLUMN_VALUE];
                throw new NotFoundEntryException($message);
            }
            throw Utility::errorHandler($e);
        }
    }
}
