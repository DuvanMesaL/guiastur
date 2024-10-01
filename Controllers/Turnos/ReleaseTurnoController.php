<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Controllers/SessionUtility.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/ReleaseTurno/Dto/ReleaseTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/ReleaseTurno/Dto/ReleaseTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IReleaseTurnoUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/InvalidPermissionException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/DependencyInjection.php";

class ReleaseTurnoController
{

    public function handleRequest($request)
    {

        SessionUtility::startSession();
        $accion = @$request["action"];
        if ($accion === "liberarturno") {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->releaseTurno($request);
            }
            else {
                $errorResponse = ["error" => "Accion invalida"];
                echo json_encode($errorResponse);
                exit;
            }
        } else {
            $errorResponse = ["error" => "Accion invalida"];
            echo json_encode($errorResponse);
            exit;
        }
    }

    private function releaseTurno($request)
    {
        try {
            $loginUser = $_SESSION[ItemsInSessionEnum::USER_LOGIN] ?? null;
            if ($loginUser === null) {
                throw new InvalidPermissionException("Carece de los permisos necesarios");
            }

            $releasetunroRequest = new ReleaseTurnoRequest(
                $request["turnoid"],
                $loginUser->getId(),
                $request["observaciones"]
            );

            $service = DependencyInjection::getReleaseTurnoServce();
            $response = $service->releaseTurno($releasetunroRequest);
            echo $response->toJSON();
            exit();
        } catch (Exception $e) {
            $responseData = array("error" => $e->getMessage());
            echo json_encode($responseData);
            exit;
        }
    }
}
