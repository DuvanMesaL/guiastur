<?php

require 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/api/buques/create':
        require_once $_SERVER["DOCUMENT_ROOT"] . '/guiastur/api/routes/Buques/CreateBuque.php';
        break;
    case '/api/buques':
        require_once $_SERVER["DOCUMENT_ROOT"] . '/guiastur/api/routes/Buques/GetBuques.php';
        break;
    case '/api/recaladas/create':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Recaladas/CreateRecalada.php";
        break;
    case '/api/paises':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes//Recaladas/Getpaises.php";
        break;
    case '/api/users/create':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Users/createUsers.php";
        break;
    case '/api/users/login':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Users/login.php";
        break;
    case '/api/users/logout':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Users/logout.php";
        break;
    case '/api/users/refresh':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Users/refreshtoken.php";
        break;
    case '/api/users/roles':
        require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/routes/Users/roles.php";
        break;

    default:
        http_response_code(404);
        echo "404 - Not Found";
        break;
}
?>
