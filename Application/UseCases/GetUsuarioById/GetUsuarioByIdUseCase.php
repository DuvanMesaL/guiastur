<?php
require_once __DIR__ . "/Dto/GetUsuarioByIdRequest.php";
require_once __DIR__ . "/Dto/GetUsuarioByIdResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetUsuarioByIdUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetUsuarioByIdQuery.php";

class GetUsuarioByIdUseCase implements IGetUsuarioByIdUseCase {

    private $getUsuarioByIdQuery;

    public function __construct(IGetUsuarioByIdQuery $getUsuarioByIdQuery) {
        $this->getUsuarioByIdQuery = $getUsuarioByIdQuery;
    }

    public function getUsuarioById(GetUsuarioByIdRequest $request): GetUsuarioByIdResponse{
       return $this->getUsuarioByIdQuery->handler($request);
    }
}
