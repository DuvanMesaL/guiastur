<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladasByBuque/Dto/GetRecaladasByBuqueRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";

interface IGetRecaladasByBuqueQuery{
    public function handler(GetRecaladasByBuqueRequest $request) : GetRecaladasResponse;
}
