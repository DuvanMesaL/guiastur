<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";

interface IGetRecaladasInThePortUseCase {
    public function getRecaladasInThePort(): GetRecaladasResponse;
}

