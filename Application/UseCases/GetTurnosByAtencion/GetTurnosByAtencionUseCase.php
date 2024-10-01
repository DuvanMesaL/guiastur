<?php
require_once __DIR__ . "/Dto/GetTurnosByAtencionRequest.php";
require_once __DIR__ . "/Dto/GetTurnosByAtencionResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetTurnosByAtencionQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetTurnosByAtencionUseCase.php";

class GetTurnosByAtencionUseCase implements IGetTurnosByAtencionUseCase {
    private $getTurnosByAtencionQuery;

    public function __construct(IGetTurnosByAtencionQuery $getTurnosByAtencionQuery) {
        $this->getTurnosByAtencionQuery = $getTurnosByAtencionQuery;
    }
    public function getTurnosByAtencion(GetTurnosByAtencionRequest $request): GetTurnosByAtencionResponse{
        return $this->getTurnosByAtencionQuery->handler($request);
    }

}

