<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateRecalada/Dto/CreateRecaladaRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateRecalada/Dto/CreateRecaladaResponse.php";

interface ICreateRecaladaCommand {
    public function handler(CreateRecaladaRequest $request) : CreateRecaladaResponse;
}