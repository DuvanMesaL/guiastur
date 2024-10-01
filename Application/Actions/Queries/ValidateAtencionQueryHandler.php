<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IValidateAtencionQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateAtencion/Dto/ValidateAtencionRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IAtencionRepository.php";

class ValidateAtencionQueryHandler implements IValidateAtencionQuery{


    private $atencionRepository;

    public function __construct(IAtencionRepository $atencionRepository)
    {
        $this->atencionRepository = $atencionRepository;
    }

    public function handler(ValidateAtencionRequest $request) {
         $this->atencionRepository->validateAtencion($request->getRecaladaId(), $request->getFechaInicio(), $request->getFechaCierre());
    }
}
