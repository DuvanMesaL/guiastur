<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateTurno/Dto/CreateTurnoRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateTurno/Dto/CreateTurnoResponse.php";

interface ICreateTurnoCommand {
    public function handler(CreateTurnoRequest $request) : CreateTurnoResponse;
}