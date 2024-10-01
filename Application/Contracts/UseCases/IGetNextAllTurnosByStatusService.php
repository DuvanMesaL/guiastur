<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextAllTurnosByStatusRequest.php";
interface IGetNextAllTurnosByStatusService  {

    public function getNextAllTurnosByStatus(GetNextAllTurnosByStatusRequest $request) : array;

 }