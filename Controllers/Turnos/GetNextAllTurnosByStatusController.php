<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Controllers/SessionUtility.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextTurnoResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetNextTurno/Dto/GetNextAllTurnosByStatusRequest.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/IGetNextAllTurnosByStatusService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Exceptions/InvalidPermissionException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/DependencyInjection.php";

class GetNextAllTurnosByStatusController
{

    public function handleRequest($request)
    {
        SessionUtility::startSession();
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->getNextAllTurnosByStatus($request);
        }
        else{
            $this->showLogin("Accion invalida");
        }

    }

    private function getNextAllTurnosByStatus($request)
    {
        $turnoStatus = "";
        try {
            $loginUser = $_SESSION[ItemsInSessionEnum::USER_LOGIN] ?? null;
            if ($loginUser === null) {
                throw new InvalidPermissionException();
            }
            $turnoStatus = $request["action"];
            $getNextAllTurnosByStatusRequest = new GetNextAllTurnosByStatusRequest($turnoStatus);
            $service = DependencyInjection::getNextAllTurnosByStatusService();
            $response = $service->getNextAllTurnosByStatus($getNextAllTurnosByStatusRequest);
            $_SESSION[ItemsInSessionEnum::LIST_NEXT_TURNOS_BY_STATUS] = $response;
        } catch (InvalidPermissionException $e) {
            $this->showLogin("Acceso denegado");
        } catch (Exception $e) {
            SessionUtility::deleteItemInSession(ItemsInSessionEnum::LIST_NEXT_TURNOS_BY_STATUS);
            $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] = $e->getMessage();
        }

       $this->showListTurnosByStatus($turnoStatus);
    }

    private function showListTurnosByStatus($turnoStatus){
        $webPage = "";
        switch($turnoStatus){
            case TurnoStatusEnum::CREATED:
                $webPage = "listnextall.php";
                break;
            case TurnoStatusEnum::INUSE:
                $webPage = "listused.php";
                break;
            case TurnoStatusEnum::RELEASE:
                $webPage = "listrealeased.php";
                break;
            case TurnoStatusEnum::FINALIZED:
                $webPage = "listfinished.php";
                break;
            default:
                $webPage = "menu.php";
        }
        header("Location: ../../Views/Turnos/$webPage");
        exit();
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
