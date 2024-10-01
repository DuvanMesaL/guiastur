<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateRecalada/Dto/CreateRecaladaRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/CreateRecalada/Dto/CreateRecaladaResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Commands/ICreateRecaladaCommand.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IRecaladaRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Entities/Recalada.php";

class CreateRecaladaCommandHandler implements ICreateRecaladaCommand {
    private $recaladaRepository;

    public function __construct(IRecaladaRepository $recaladaRepository){
        $this->recaladaRepository = $recaladaRepository;
    }

    public function handler(CreateRecaladaRequest $request): CreateRecaladaResponse {
        $recalada = new Recalada();
        $recalada->fecha_arribo = $request->getFechaArribo();
        $recalada->fecha_zarpe = $request->getFechaZarpe();
        $recalada->total_turistas = $request->getTotalTuristas();
        $recalada->observaciones = $request->getObservaciones();
        $recalada->buque_id = $request->getBuqueId();
        $recalada->pais_id = $request->getPaisId();
        $recalada->fecha_registro = $request->getFechaRegistro();
        $recalada->usuario_registro = $request->getUsuarioRegistro();
        $recalada = $this->recaladaRepository->create($recalada);
        return new CreateRecaladaResponse(
            $recalada->id
        );
    }

}