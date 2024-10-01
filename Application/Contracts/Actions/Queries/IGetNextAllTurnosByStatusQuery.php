<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextAllTurnosByStatusRequest.php";

interface IGetNextAllTurnosByStatusQuery{
    public function handler(GetNextAllTurnosByStatusRequest $request ) : array;
}
