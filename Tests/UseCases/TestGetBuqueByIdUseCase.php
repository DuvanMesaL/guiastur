<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Infrastructure/Repositories/BuqueRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Actions/Queries/GetBuqueByIdQueryHandler.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuqueById/GetBuqueByIdUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuqueById/Dto/GetBuqueByIdRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetBuqueById/Dto/GetBuqueByIdResponse.php";

class TestGetBuqueByIdUseCase
{

    public static function testGetBuqueByIdShouldShowData()
    {
        try {
            // Arrange
            $buqueRepository = new BuqueRepository();
            $getBuqueByIdQuery = new GetBuqueByIdQueryHandler($buqueRepository);
            $getBuqueByIdUseCase = new GetBuqueByIdUseCase($getBuqueByIdQuery);
            $buqueId = 1;
            $request = new GetBuqueByIdRequest($buqueId);
             //Act
            $response = $getBuqueByIdUseCase->getBuqueById($request);
              //Assert
            TestGetBuqueByIdUseCase::showBuqueData(array($response), "Datos del Buque ID : $buqueId");
        } catch (Exception $e) {
            echo '<hr><span style="color: red">Error al Obtener Buque por Id<br></span>';
            echo '<span style="color: red"> ' . $e->getMessage() . '<br></span>';
        }
    }

    public static function showBuqueData($buques, string $title)
    {
        $output = "<hr/><h3>$title</h3>
        <table border=4> <tr>
          <th>BUQUE ID</th>
          <th>CODIGO</th>
          <th>NOMBRE ID</th>
          <th>FOTO</th>
          <th>RECALADAS</th>
          <th>ATENCIONES</th>
          </tr> ";
        foreach ($buques as $buque) {
            $output .= "<tr><td>" . $buque->getId() . "</td>
            <td>" . $buque->getCodigo() . "</td>
            <td>" . $buque->getNombre() . "</td>
            <td>" . $buque->getFoto() . "</td>
            <td>" . $buque->getTotalRecaladas() . "</td>
            <td>" . $buque->getTotalAtenciones() . "</td></tr>";
        }
        $output .= "</table>";
        echo $output;

    }

}

TestGetBuqueByIdUseCase::testGetBuqueByIdShouldShowData();