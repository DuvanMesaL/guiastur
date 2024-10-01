<?php
require_once __DIR__ . "/Dto/ReleaseTurnoRequest.php";
require_once __DIR__ . "/Dto/ReleaseTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetTurnoById/Dto/GetTurnoByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetTurnoById/Dto/GetTurnoByIdResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsuarioById/Dto/GetUsuarioByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsuarioById/Dto/GetUsuarioByIdResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetTurnoByIdQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetUsuarioByIdQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Commands/IReleaseTurnoCommand.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IReleaseTurnoUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/invalidReleaseTurnoException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Domain/Constants/RolTypeEnum.php";


class ReleaseTurnoUseCase implements IReleaseTurnoUseCase {
    private $getTurnoByIdQuery;
    private $getUsuarioByIdQuery;
    private $releaseTurnoCommand;

    public function __construct(IGetTurnoByIdQuery $getTurnoByIdQuery
                                , IGetUsuarioByIdQuery $getUsuarioByIdQuery
                                , IReleaseTurnoCommand $releaseTurnoCommand)
    {
        $this->getTurnoByIdQuery = $getTurnoByIdQuery;
        $this->getUsuarioByIdQuery = $getUsuarioByIdQuery;
        $this->releaseTurnoCommand = $releaseTurnoCommand;
    }

    public function releaseTurno(ReleaseTurnoRequest $request): ReleaseTurnoResponse{
        $getTurnoByIdRequest = new GetTurnoByIdRequest($request->getTurnoId());
        $getTurnoByIdResponse = $this->getTurnoByIdQuery->handler($getTurnoByIdRequest);
        if($getTurnoByIdResponse->getEstado() !==  TurnoStatusEnum::INUSE){
            throw new InvalidReleaseTurnoException("No se puede liberar el Turno #: ".$getTurnoByIdResponse->getNumero() . ", Atencion Id: ".$getTurnoByIdResponse->getAtencion()->getId(). " El turno no está en uso");
        }

        $usuarioByIdRequest = new GetUsuarioByIdRequest($request->getUsuarioIdUso());
        $usuarioByIdResponse = $this->getUsuarioByIdQuery->handler($usuarioByIdRequest);
        if($usuarioByIdResponse->getRolNombre() !== RolTypeEnum::SUPER_USUARIO
            && $usuarioByIdResponse->getRolNombre() !== RolTypeEnum::SUPERVISOR
            && $usuarioByIdResponse->getId() != $getTurnoByIdResponse->getGuia()->getUsuarioId())
        {
            throw new InvalidReleaseTurnoException("No tiene permisos liberar el turno ".$getTurnoByIdResponse->getNumero() ." del Guia ". $getTurnoByIdResponse->getGuia()->getNombre());
        }

        return $this->releaseTurnoCommand->handler($request);
    }
}
