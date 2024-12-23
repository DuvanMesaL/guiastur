php/<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/ILoginQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Constants/UsuarioStatusEnum.php";

class LoginQueryHandler implements ILoginQuery{

    private $repository;

    public function __construct(IUsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handler(LoginRequest $request) : LoginResponse{

        $usuario = $this->repository->findByEmail($request->getEmail());

        if($usuario->estado == UsuarioStatusEnum::CREATED){
            throw new Exception("Aun no ha activado su cuenta, revise su email");
        }

        if($usuario->estado != UsuarioStatusEnum::ACTIVATED){
            throw new Exception("Acceso denegado");
        }

        if($usuario->password != $request->getPassword() ){
            throw new Exception("Datos de acceso incorrectos");
        }

        return new LoginResponse($usuario->id
                                    , $usuario->email
                                    , $usuario->nombre
                                    , $usuario->estado
                                    , $usuario->rol->nombre
                                    , strval($usuario->guia_o_supervisor_id));
    }
}

