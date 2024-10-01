<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRoles/Dto/GetRolesResponse.php";

interface IGetRolesService {
    public function getRoles(): GetRolesResponse;
}

