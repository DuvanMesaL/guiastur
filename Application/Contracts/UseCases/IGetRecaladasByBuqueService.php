<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladasByBuque/Dto/GetRecaladasByBuqueRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";

interface IGetRecaladasByBuqueService{
    public function getRecaladasByBuque(GetRecaladasByBuqueRequest $request) : GetRecaladasResponse;
}
