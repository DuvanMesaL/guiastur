<?php

use Api\Controllers\Buques\GetBuquesMobileControllerApi;

require_once $_SERVER["DOCUMENT_ROOT"] . "/guiastur/api/controllers/Buques/GetBuquesMobileControllerApi.php";

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

$controller = new GetBuquesMobileControllerApi();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $request = $_GET;
    $controller->handleRequest($request);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $request = json_decode(file_get_contents('php://input'), true);
    $controller->handleRequest($request);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido.']);
    exit();
}
