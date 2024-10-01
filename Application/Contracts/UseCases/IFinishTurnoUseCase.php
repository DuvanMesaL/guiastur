<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/FinishTurno/Dto/FinishTurnoRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/FinishTurno/Dto/FinishTurnoResponse.php";


interface IFinishTurnoUseCase {
    public function finishTurno(FinishTurnoRequest $request) : FinishTurnoResponse;
}