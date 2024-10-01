<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladasByBuque/Dto/GetRecaladasByBuqueRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetRecaladasByBuqueQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetRecaladasByBuqueService.php";

class GetRecaladasByBuqueService implements IGetRecaladasByBuqueService {
    private $getRecaladasByBuqueQuery;

    public function __construct(IGetRecaladasByBuqueQuery $getRecaladasByBuqueQuery) {
        $this->getRecaladasByBuqueQuery = $getRecaladasByBuqueQuery;
    }

    public function getRecaladasByBuque(GetRecaladasByBuqueRequest $request ) : GetRecaladasResponse {
        return $this->getRecaladasByBuqueQuery->handler($request);
    }

}