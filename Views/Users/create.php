<?php
require_once '../../Controllers/Users/CreateUserController.php';
require_once '../../Controllers/SessionUtility.php';
require_once '../../DependencyInjection.php';
require_once '../../Application/UseCases/GetRoles/Dto/GetRolesResponse.php';

SessionUtility::startSession();
$rolesResponse = @$_SESSION[ItemsInSessionEnum::LIST_ROLES];
if (!isset($rolesResponse)) {
    $rolesResponse = DependencyInjection::getRolesServce()->getRoles();
    $_SESSION[ItemsInSessionEnum::LIST_ROLES] = $rolesResponse;
}
$usuarioLogin = $_SESSION[ItemsInSessionEnum::USER_LOGIN];
if (!isset($usuarioLogin)) {
    $errorMessage = "Accion denegada, primero debe iniciar sesion";
    $_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] = $errorMessage;
    header('Location: login.php');
    exit;
}

$errorMessage = @$_SESSION[ItemsInSessionEnum::ERROR_MESSAGE] ?? @$_GET["error"];
$infoMessage = @$_SESSION[ItemsInSessionEnum::INFO_MESSAGE] ?? @$_GET["message"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .header {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: calc(100vh - 60px);
            margin-top: 60px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            margin: auto;
        }

        .form-container::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            margin-top: 5px;
        }

        .form-group input[type="submit"], .form-group button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            margin-right: 4%;
        }
        .form-group button {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Formulario de Registro</h1>
    </div>

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Crear Usuario</h2>
            <div style="color: red;"><?= @$errorMessage ?></div>
            <div style="color: green;"><?= @$infoMessage ?></div>

            <form action="index.php" method="post">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="rol_id">Rol:</label>
                    <select id="rol_id" name="rol_id" required>
                        <?php foreach ($rolesResponse->getRoles() as $rol): ?>
                            <option value="<?= $rol->getId() ?>"><?= $rol->getNombre() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    <input type="hidden" name="usuario_registro" value="<?= $usuarioLogin->getId() ?>">
                <div class="form-group">
                <input type="submit" value="Crear Usuario">
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php
unset($_SESSION[ItemsInSessionEnum::ERROR_MESSAGE]);
unset($_SESSION[ItemsInSessionEnum::INFO_MESSAGE]);
?>

