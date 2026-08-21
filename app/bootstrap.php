<?php

declare(strict_types=1);

define('PROJECT_ROOT', dirname(__DIR__));

require_once PROJECT_ROOT . '/app/EnvLoader.php';

EnvLoader::load(PROJECT_ROOT . '/.env');

require_once PROJECT_ROOT . '/app/Database.php';

$database = new Database();
$pdo = $database->getConnection();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}