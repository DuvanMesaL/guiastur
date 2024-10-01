<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IValidateRecaladaQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateRecalada/Dto/ValidaRecaladaRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IRecaladaRepository.php";

class ValidateRecaladaQueryHandler implements IValidateRecaladaQuery{


    private $atencionRepository;

    public function __construct(IRecaladaRepository $recaladaRepository)
    {
        $this->atencionRepository = $recaladaRepository;
    }

    public function handler(ValidateRecaldaRequest $request) : bool{

        return $this->atencionRepository->validateRecalada($request->getBuqueId(), $request->getFecha());

    }
}
