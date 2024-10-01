<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRoles/Dto/GetRolesResponse.php";

interface IGetRolesQuery{
    public function handler() : GetRolesResponse;

}