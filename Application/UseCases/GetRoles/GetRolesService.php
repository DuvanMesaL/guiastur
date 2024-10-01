<?php
require_once __DIR__."/Dto/GetRolesResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetRolesQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetRolesService.php";

class GetRolesService implements IGetRolesService {
    private $getRolesQuery;

    public function __construct(IGetRolesQuery $getRolesQuery) {
        $this->getRolesQuery = $getRolesQuery;
    }

    public function getRoles() : GetRolesResponse {
        return $this->getRolesQuery->handler();
    }
}