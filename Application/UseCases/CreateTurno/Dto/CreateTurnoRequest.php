<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GenericDto.php";

class CreateTurnoRequest extends GenericDto
{
    private $numero;
    private $estado;

    private $observaciones;
    private $guia_id;
    private $atencion_id;
    private $fecha_registro;
    private $usuario_registro;

    public function __construct(
        int $numero,
        string $estado = null,
        string $observaciones = null,
        string $guia_id,
        int $atencion_id,
        int $usuario_registro
    ) {
        if ( $numero < 0) {
            throw new InvalidArgumentException("El Numero del Turno es requerido para crear un nuevo Turno");
        }

        if ($guia_id === null || empty(trim($guia_id))) {
            throw new InvalidArgumentException("El Id del Guia es requerido para crear un nuevo Turno");
        }

        if ($atencion_id === null || $atencion_id <= 0) {
            throw new InvalidArgumentException("El Id de la Atencion es requerido para crear un nuevo Turno");
        }

        if ($usuario_registro === null || $usuario_registro <= 0) {
            throw new InvalidArgumentException("El Id del Usuario que registra es requerido para crear un nuevo Turno");
        }


        $this->numero = $numero;
        $this->guia_id = $guia_id;
        $this->estado = $estado;
        $this->observaciones = $observaciones;
        $this->guia_id = $guia_id;
        $this->fecha_registro = new DateTime();
        $this->atencion_id = $atencion_id;
        $this->usuario_registro = $usuario_registro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero(int $numero){
        $this->numero = $numero;
    }

    public function getGuiaId()
    {
        return $this->guia_id;
    }

    public function getEstado()
    {
        return $this->estado;
    }


    public function getObservaciones()
    {
        return $this->observaciones;
    }


    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }


    public function getUsuarioRegistro()
    {
        return $this->usuario_registro;
    }

    public function getAtencionId(){
        return $this->atencion_id;
    }

}