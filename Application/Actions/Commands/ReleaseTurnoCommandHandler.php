<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Constants/TurnoStatusEnum.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/ReleaseTurno/Dto/ReleaseTurnoRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/ReleaseTurno/Dto/ReleaseTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Commands/IReleaseTurnoCommand.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/ITurnoRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Entities/Turno.php";

class ReleaseTurnoCommandHandler implements IReleaseTurnoCommand{

    private $turnoRepository;
    public function __construct(ITurnoRepository $turnoRepository)
    {
        $this->turnoRepository = $turnoRepository;
    }

    public function handler(ReleaseTurnoRequest $request) : ReleaseTurnoResponse{
        $estado = TurnoStatusEnum::RELEASE;
        $turno = $this->turnoRepository->find($request->getTurnoId());
        $turno->estado = $estado;
        $turno->fecha_salida = new DateTime();
        $turno->usuario_salida = $request->getUsuarioIdUso();
        $observaciones =  $request->getObservaciones();
        if($turno->observaciones && $observaciones && !empty(trim($observaciones))){
            $turno->observaciones .= ". Liberado: $observaciones";
        }
        if(!$turno->observaciones && $observaciones && !empty(trim($observaciones))){
            $turno->observaciones = "Liberado: $observaciones";
        }
        $turno = $this->turnoRepository->update($turno);
        return new ReleaseTurnoResponse(
            $turno->id,
            $turno->numero,
            $turno->estado,
            new DateTime($turno->fecha_salida),
            $turno->usuario_salida
        );
    }

}
