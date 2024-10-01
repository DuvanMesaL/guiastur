<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetRecaladasService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetRecaladasQuery.php";
require_once __DIR__."/Dto/GetRecaladasResponse.php";

class GetRecaladasService implements IGetRecaladasService {
    private $getRecaladasQuery;

    public function __construct(IGetRecaladasQuery $getRecaladasInThePortQuery) {
        $this->getRecaladasQuery = $getRecaladasInThePortQuery;
    }

    public function getRecaladas( ) : GetRecaladasResponse {
        return $this->getRecaladasQuery->handler();
    }

}