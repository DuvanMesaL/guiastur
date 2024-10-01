<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuques/Dto/GetBuquesResponse.php";

interface IGetBuquesQuery{
    public function handler() : GetBuquesResponse;
}