<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Controllers/SessionUtility.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladasByBuque/Dto/GetRecaladasByBuqueRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetRecaladasByBuqueService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/InvalidPermissionException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/DependencyInjection.php";

class GetRecaladasByBuqueController
{

    public function handleRequest($request)
    {
        SessionUtility::startSession();
        $accion = @$request["action"];
        if ($accion === "listbybuque") {
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                $this->getRecaladasByBuque($request);
            }
            else{
                $this->showLogin("Accion invalida");
            }
        } else {
            $this->showLogin("Accion invalida");
        }
    }

    private function getRecaladasByBuque($request)
    {
        try {
            $loginUser = $_SESSION[ItemsInSessionEnum::USER_LOGIN] ?? null;
            if ($loginUser === null) {
                throw new InvalidPermissionException();
            }
            $service = DependencyInjection::getRecaladasByBuqueService();
            $getRecaladasRequest = new GetRecaladasByBuqueRequest($request["buque"]);
            $response = $service->getRecaladasByBuque($getRecaladasRequest);
            $_SESSION[ItemsInSessionEnum::LIST_RECALADAS] = $response;
        } catch (InvalidPermissionException $e) {
            $this->showLogin("Acceso denegado");
        } catch (Exception $e) {
            $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] = $e->getMessage();
        }
        header("Location: ../../Views/Recaladas/listbybuque.php");
    }


    private function showLogin(string $message)
    {
        SessionUtility::clearAllSession();
        SessionUtility::startSession();
        $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] = $message;
        header("Location: ../../Views/Users/login.php");
        exit;
    }
}
