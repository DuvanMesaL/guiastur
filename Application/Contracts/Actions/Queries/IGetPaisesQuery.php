<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetPaises/Dto/GetPaisesResponse.php";

interface IGetPaisesQuery{
    public function handler() : GetPaisesResponse;

}