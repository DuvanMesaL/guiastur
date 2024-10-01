<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Controllers/SessionUtility.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/Login/Dto/LoginResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladas/Dto/GetRecaladasResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRecaladasInThePort/Dto/GetRecaladasInThePortResponse.php";

SessionUtility::startSession();
$usuarioLogin = $_SESSION[ItemsInSessionEnum::USER_LOGIN];
if (!isset($usuarioLogin)) {
    SessionUtility::clearAllSession();
    SessionUtility::startSession();
    $errorMessage = "Accion denegada, primero debe iniciar sesion";
    $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] = $errorMessage;
    header('Location: ../Users/login.php');
    exit;
}
$recaladasResponse = @$_SESSION[ItemsInSessionEnum::LIST_RECALADAS] ?? null;
$errorMessage = $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] ?? "";
$infoMessage = $_SESSION[ItemsInSessionEnum::INFO_MESSAGE] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Turnos para Guias de Turismo</title>
    <link rel="stylesheet" href="../Css/listbuque.css">
    <link rel="stylesheet" href="../Css/index.css">
</head>

<body>
    <div class="header">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        Reporte de Recaladas
    </div>

    <?php require_once "../menu.php" ?>
    <div class="icon-bar">
        <a href="<?= UrlHelper::getUrlBase() ?>/Views/Recaladas/index.php?action=menu"> <img
                src="https://icons.iconarchive.com/icons/alecive/flatwoken/48/Apps-Home-icon.png" alt="Home"></a>
        <a href="<?= UrlHelper::getUrlBase() ?>/Views/Recaladas/index.php?action=create"> <img
                src="https://icons.iconarchive.com/icons/icojam/blue-bits/48/document-add-icon.png" alt="Add"></a>
        <a href="#"> <img src="https://icons.iconarchive.com/icons/icojam/blue-bits/48/document-search-icon.png"
                alt="Search"></a>
        <a href="#"><img src="https://icons.iconarchive.com/icons/icojam/blue-bits/48/document-check-icon.png"
                alt="Check"></a>
        <a href="#"> <img src="https://icons.iconarchive.com/icons/icojam/blue-bits/48/document-delete-icon.png"
                alt="Delete"></a>
    </div>

    <div class="container">
        <?php if ($errorMessage): ?>
            <script type="text/javascript">
                window.onload = function () {
                    showSimpleAlert("error", "", "<?= $errorMessage?>");
                };
            </script>
        <?php endif; ?>
        <?php if ($infoMessage): ?>
            <script type="text/javascript">
                window.onload = function () {
                    showSimpleAlert("info", "", "<?= $infoMessage?>");
                };
            </script>
        <?php endif; ?>
        <?php if ($recaladasResponse === null || @count($recaladasResponse->getRecaladas()) < 1): ?>
            <script type="text/javascript">
                window.onload = function () {
                    let message = "No hay recaladas disponibles. Menu/Recaladas/Crear Recalada"
                    showSimpleAlert("info", "", message);
                };
            </script>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>BUQUE</th>
                            <th>ARRIBO</th>
                            <th>ZARPE</th>
                            <th>TURISTAS</th>
                            <th>PAIS</th>
                            <th>ATENCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recaladasResponse->getRecaladas() as $recalada): ?>
                            <tr>
                                <td><?= $recalada->getRecaladaId(); ?></td>
                                <td><?= $recalada->getBuqueNombre(); ?></td>
                                <td><?= $recalada->getFechaArribo()->format("Y-m-d H:i:s"); ?></td>
                                <td><?= $recalada->getFechaZarpe()->format("Y-m-d H:i:s"); ?></td>
                                <td><?= $recalada->getTotalTuristas(); ?></td>
                                <td><?= $recalada->getPaisNombre(); ?></td>
                                <td>
                                    <a
                                        href="../Atenciones/index.php?action=listbyrecalada&page=listall&recalada=<?= $recalada->getRecaladaId() ?>"><?= $recalada->getNumeroAtenciones() ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <script src="../Js/index.js"></script>
    <script src="../Js/alert.js"></script>
    <script src="../Js/listbuque.js"></script>
</body>

</html>

<?php
// SessionUtility::deleteItemInSession(ItemsInSessionEnum::LIST_RECALADAS);
;
SessionUtility::deleteItemInSession(ItemsInSessionEnum::ERROR_MESSAGE);
SessionUtility::deleteItemInSession(ItemsInSessionEnum::INFO_MESSAGE);
?>