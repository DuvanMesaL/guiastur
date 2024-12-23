<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateBuque/Dto/CreateBuqueRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateBuque/Dto/CreateBuqueResponse.php";

interface ICreateBuqueCommand {
    public function handler(CreateBuqueRequest $request) : CreateBuqueResponse;
}