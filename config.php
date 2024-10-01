<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (getenv('DOCUMENT_ROOT')) {
    $_SERVER['DOCUMENT_ROOT'] = getenv('DOCUMENT_ROOT');
} else {
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
}
