<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuqueById/Dto/GetBuqueByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuqueById/Dto/GetBuqueByIdResponse.php";

interface IGetBuqueByIdUseCase  {

   public function getBuqueById(GetBuqueByIdRequest $request) : GetBuqueByIdResponse;

}