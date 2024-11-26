<?php

namespace Api\Routes\Endopoint\Buques;

use Api\Controllers\Buques\CreateBuqueMobileController;

require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/controllers/Buques/CreateBuqueMobileController.php";

$allowedOrigins = [
    "http://localhost:8100",
    "https://localhost:8100",
    "http://192.168.137.57:8100",
    "http://localhost:8100"
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
    header('Access-Control-Allow-Credentials: true');
} else {
    http_response_code(403);
    echo json_encode(["error" => "Origen no permitido"]);
    exit();
}

header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json; charset=utf-8');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$createBuqueController = new CreateBuqueMobileController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = json_decode(file_get_contents('php://input'), true);
    $createBuqueController->handleRequest($request);
} else {
    header('Content-Type: application/json', true, 405);
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido"
    ]);
}
