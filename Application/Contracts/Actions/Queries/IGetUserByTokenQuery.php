<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsusarioByToken/Dto/GetUsuarioByTokenRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsusarioByToken/Dto/GetUsuarioByTokenResponse.php";

interface IGetUserByTokenQuery{
    public function handler(GetUsuarioByTokenRequest $request) : GetUsuarioByTokenResponse;
}