<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserGuiaRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserGuiaResponse.php";

interface ICreateUserGuiaCommand {
    public function handler(CreateUserGuiaRequest $request) : CreateUserGuiaResponse;
}