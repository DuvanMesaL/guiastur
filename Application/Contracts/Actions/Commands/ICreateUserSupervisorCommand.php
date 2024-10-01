<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserSupervisorRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserSupervisorResponse.php";

interface ICreateUserSupervisorCommand {
    public function handler(CreateUserSupervisorRequest $request) : CreateUserSupervisorResponse;
}