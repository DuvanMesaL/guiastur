<?php
require_once __DIR__ . "/Dto/GetNextTurnoRequest.php";
require_once __DIR__ . "/Dto/GetNextTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetNextTurnoUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetNextTurnoQuery.php";

class GetNextTurnoUseCase implements IGetNextTurnoUseCase {
    private $getNextTurnoQuery;

    public function __construct(IGetNextTurnoQuery $getNextTurnoQuery) {
        $this->getNextTurnoQuery = $getNextTurnoQuery;
    }

    public function getNextTurno(GetNextTurnoRequest $request) : GetNextTurnoResponse {
        return $this->getNextTurnoQuery->handler($request);
    }
}
