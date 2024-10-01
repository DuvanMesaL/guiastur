<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateAtencion/Dto/ValidateAtencionRequest.php";

interface IValidateAtencionQuery{
    public function handler(ValidateAtencionRequest $request) ;
}