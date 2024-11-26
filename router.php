<?php

require_once __DIR__ . '/ClassLoader.php';
require_once __DIR__ . '/api/routes/cros.php';
handleCors();

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch (true) {
    case preg_match('#^/atencions/createatencion$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Atencions/CreateAtencion.php';
        break;
    case preg_match('#^/buques/createbuque$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Buques/CreateBuque.php';
        break;
    case preg_match('#^/buques/getbuques$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Buques/GetBuques.php';
        break;
    case preg_match('#^/recaladas/createrecalada$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Recaladas/CreateRecalada.php';
        break;
    case preg_match('#^/recaladas/getpaises$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Recaladas/Getpaises.php';
        break;
    case preg_match('#^/recaladas/getrecalada$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Recaladas/GetRecalada.php';
        break;
    case preg_match('#^/recaladas/getrecaladasbybuque$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Recaladas/GetRecaladasByBuque.php';
        break;
    case preg_match('#^/recaladas/getrecaladasintheport$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Recaladas/GetRecaladasInThePort.php';
        break;
    case preg_match('#^/turnos/createturno$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/CreateTurno.php';
        break;
    case preg_match('#^/turnos/finishturno$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/FinishTurno.php';
        break;
    case preg_match('#^/turnos/getnextallturnosbystatus$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/GetNextAllTurnosByStatus.php';
        break;
    case preg_match('#^/turnos/getturnosbyatencion$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/GetTurnosByAtencion.php';
        break;
    case preg_match('#^/turnos/releaseturno$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/ReleaseTurno.php';
        break;
    case preg_match('#^/turnos/useturno$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Turnos/UseTurno.php';
        break;
    case preg_match('#^/users/createusers$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Users/createUsers.php';
        break;
    case preg_match('#^/users/login$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Users/login.php';
        break;
    case preg_match('#^/users/logout$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Users/logout.php';
        break;
    case preg_match('#^/users/refreshtoken$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Users/refreshtoken.php';
        break;
    case preg_match('#^/users/roles$#', $requestUri) && $requestMethod === 'POST':
        require __DIR__ . '/api/routes/Users/roles.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Ruta no encontrada']);
        break;
}
?>
