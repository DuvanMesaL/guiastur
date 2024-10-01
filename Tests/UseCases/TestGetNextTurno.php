<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextTurnoRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Infrastructure/Repositories/TurnoRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Actions/Queries/GetNextTurnoQueryHandler.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/GetNextTurnoUseCase.php";


class TestGetNextTurnoUseCase
{

    public static function testGetNextTurnoShouldShowData()
    {
        try {
            // Arrange
            $turnoRepository = new TurnoRepository();
            $getGetNextQuery = new GetNextTurnoQueryHandler($turnoRepository);
            $getNextTurnoUseCase = new GetNextTurnoUseCase($getGetNextQuery);
            $atencionId = 1;
            $request = new GetNextTurnoRequest($atencionId);
            //Act
            $response = $getNextTurnoUseCase->getNextTurno($request);
            //Assert
            TestGetNextTurnoUseCase::showNextTurno($response, "Datos del Turono Actual");
        } catch (Exception $e) {
            echo '<hr><span style="color: red">Error al Obtener el Proximo Turno Por Atención<br></span>';
            echo '<span style="color: red"> ' . $e->getMessage() . '<br></span>';
        }
    }

    public static function showNextTurno(GetNextTurnoResponse $turno, string $title)
    {
        $output = "<hr/><h3>$title</h3>
        <table border=4>
            <tr>
                <th>ID</th>
                <th>NUMERO</th>
                <th>USADO ID</th>
                <th>REGISTRÓ USO</th>
                <th>SALIDA</th>
                <th>REGISTRÓ LA SALIDA</th>
                <th>REGRESO</th>
                <th>REGISTRÓ EL REGRESO</th>
                <th>OBSERVACIONES</th>
                <th>GUIA ID</th>
                <th>RNT</th>
                <th>GUIA</th>
                <th>TELEFONO</th>
                <th>FOTO</th>
                <th>ATENCION ID</th>
                <th>FECHA INICIO</th>
                <th>FECHA CIERRE</th>
                <th>TOTAL TURNOS</th>
            </tr>
            <TR>
                <TD>" . $turno->getId() . "</td>
                <TD>" . $turno->getNumero() . "</td>
                <TD>" . ($turno->getFechaUso() !== null ? $turno->getFechaUso()->format("Y-m-d H:i:s") : "") . "</td>
                <TD>" . $turno->getUsuarioUso() . "</td>
                <TD>" . ($turno->getFechaSalida() !== null ? $turno->getFechaSalida()->format("Y-m-d H:i:s") : "") . "</td>
                <TD>" . $turno->getUsuarioUso() . "</td>
                <TD>" . ($turno->getFechaRegreso() !== null ? $turno->getFechaRegreso()->format("Y-m-d H:i:s") : "") . "</td>
                <TD>" . $turno->getUsuarioUso() . "</td>
                <TD>" . $turno->getObservaciones() . "</td>
                <TD>" . $turno->getGuia()->getCedula() . "</td>
                <TD>" . $turno->getGuia()->getRnt() . "</td>
                <TD>" . $turno->getGuia()->getNombre() . "</td>
                <TD>" . $turno->getGuia()->getTelefono() . "</td>
                <TD>" . $turno->getGuia()->getFoto() . "</td>
                <TD>" . $turno->getAtencion()->getId() . "</td>
                <TD>" . $turno->getAtencion()->getFechaInicio()->format("Y-m-d H:i:s") . "</td>
                <TD>" . $turno->getAtencion()->getFechaCierre()->format("Y-m-d H:i:s") . "</td>
                <TD >" . $turno->getAtencion()->getTotalTurnos() . "</td>
            </TR>
        </table>";
        echo $output;
    }

}

TestGetNextTurnoUseCase::testGetNextTurnoShouldShowData();