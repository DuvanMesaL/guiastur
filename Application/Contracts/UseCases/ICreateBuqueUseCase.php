<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateUser/Dto/CreateUserResponse.php";

interface ICreateBuqueUseCase  {

   public function CreateBuque(CreateBuqueRequest $request) : CreateBuqueResponse;

}