<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CancelTurno/Dto/CancelTurnoRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CancelTurno/Dto/CancelTurnoResponse.php";

interface ICancelTurnoCommand {
    public function handler(CancelTurnoRequest $request) : CancelTurnoResponse;
}