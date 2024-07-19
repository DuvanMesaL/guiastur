
<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "guiastur/Controllers/SessionUtility.php";
// require_once $_SERVER["DOCUMENT_ROOT"] . "guiastur/Application/UseCases/Login/Dto/LoginResponse.php";
// require_once $_SERVER["DOCUMENT_ROOT"] . "guiastur/Controllers/Users/LoginController.php";
// LoginController::validateAccess();
SessionUtility::startSession();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <style>
        .menu {
            margin: 20px 0;
        }
        .menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            background-color: #f2f2f2;
            margin: 2px 0;
        }
        .menu a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h2><?= @$_SESSION[ItemsInSessionEnum::INFO_MESSAGE]?></h2>

<h3>Menú Usuarios</h3>
<div class="menu">
    <a href="index.php?action=create">Crear</a>
    <!-- <a href="index.php?action=find">Buscar</a> -->
    <!-- <a href="index.php?action=all">Listar</a> -->
    <!-- <a href="index.php?action=edit">Editar</a> -->
    <!-- <a href="index.php?action=desable">Desactivar</a> -->
    <a href="../index.php">Menu Principal</a>
</div>

</body>
</html>