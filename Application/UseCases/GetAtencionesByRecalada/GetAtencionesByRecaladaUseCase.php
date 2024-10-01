<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetAtencionesByRecaladaUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetAtencionesByRecaladaQuery.php";
require_once __DIR__."/Dto/GetAtencionesByRecaladaRequest.php";
require_once __DIR__."/Dto/GetAtencionesByRecaladaResponse.php";


class GetAtencionesByRecaladaUseCase implements IGetAtencionesByRecaladaUseCase{
    private $getAtencionesByRecaladasQuery;

    public function __construct(IGetAtencionesByRecaladaQuery $getAtencionesByRecaladasQuery) {
        $this->getAtencionesByRecaladasQuery = $getAtencionesByRecaladasQuery;
    }

    public function getAtencionesByRecalada(GetAtencionesByRecaladaRequest $request) : GetAtencionesByRecaladaResponse {
        return $this->getAtencionesByRecaladasQuery->handler($request);
    }
}
