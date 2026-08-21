<?php

declare(strict_types=1);

define('PROJECT_ROOT', dirname(__DIR__));

require_once PROJECT_ROOT . '/app/EnvLoader.php';

EnvLoader::load(PROJECT_ROOT . '/.env');

require_once PROJECT_ROOT . '/app/Database.php';
require_once PROJECT_ROOT . '/app/Core/QueryBuilder.php'; // подключаем наш новый класс

$database = new Database();
$pdo = $database->getConnection();

// Создаём экземпляр QueryBuilder — теперь это и есть наш "$db"
$db = new \App\Core\QueryBuilder($pdo);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}