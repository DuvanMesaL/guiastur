<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetTurnoById/Dto/GetTurnoByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetTurnoById/Dto/GetTurnoByIdResponse.php";

interface IGetTurnoByIdUseCase {
    public function getTurnoById(GetTurnoByIdRequest $request) : GetTurnoByIdResponse;
}