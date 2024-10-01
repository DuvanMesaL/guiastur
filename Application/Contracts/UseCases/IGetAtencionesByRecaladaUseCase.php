<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetAtencionesByRecalada/Dto/GetAtencionesByRecaladaRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetAtencionesByRecalada/Dto/GetAtencionesByRecaladaResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetAtencionesByRecaladaQuery.php";



interface IGetAtencionesByRecaladaUseCase  {

   public function getAtencionesByRecalada(GetAtencionesByRecaladaRequest $request) : GetAtencionesByRecaladaResponse;

}