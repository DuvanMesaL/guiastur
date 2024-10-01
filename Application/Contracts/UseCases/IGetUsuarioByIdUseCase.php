<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsuarioById/Dto/GetUsuarioByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsuarioById/Dto/GetUsuarioByIdResponse.php";

interface IGetUsuarioByIdUseCase{
    public function getUsuarioById(GetUsuarioByIdRequest $request) :GetUsuarioByIdResponse ;
}

