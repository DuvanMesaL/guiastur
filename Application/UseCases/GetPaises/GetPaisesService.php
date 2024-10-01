<?php
require_once __DIR__."/Dto/GetPaisesResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetPaisesQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetPaisesService.php";

class GetPaisesService implements IGetPaisesService {
    private $paisesQuery;

    public function __construct(IGetPaisesQuery $paisesQuery) {
        $this->paisesQuery = $paisesQuery;
    }

    public function getPaises() : GetPaisesResponse {
        return $this->paisesQuery->handler();
    }
}