<?php

use Api\Controllers\Recaladas\GetPaisesMobileController;

require_once __DIR__ . '/../../controllers/Recaladas/GetPaisesMobileController.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$controller = new GetPaisesMobileController();
$controller->handleRequest();
