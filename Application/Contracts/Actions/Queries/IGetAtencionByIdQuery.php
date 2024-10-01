<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetAtenciones/Dto/GetAtencionByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetAtenciones/Dto/GetAtencionResponse.php";

interface IGetAtencionByIdQuery  {

   public function handler(GetAtencionByIdRequest $request) : GetAtencionResponse;

}