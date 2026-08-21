<?php

declare(strict_types=1);

define('PROJECT_ROOT', dirname(__DIR__));

// --- ДОБАВЬ ЭТОТ БЛОК ---
spl_autoload_register(function ($class) {
    // Превращаем App\Core\QueryBuilder в app/Core/QueryBuilder.php
    $file = str_replace('\\', '/', $class) . '.php';
    $path = PROJECT_ROOT . '/' . $file;

    if (file_exists($path)) {
        require_once $path;
    }
});
// ------------------------

require_once PROJECT_ROOT . '/app/EnvLoader.php';

EnvLoader::load(PROJECT_ROOT . '/.env');

require_once PROJECT_ROOT . '/app/Database.php';
require_once PROJECT_ROOT . '/app/Core/QueryBuilder.php'; // подключаем наш новый класс

$database = new Database();
$pdo = $database->getConnection();

// Создаём экземпляр QueryBuilder — теперь это и есть наш "$db"
$db = new \App\Core\QueryBuilder($pdo);

$appUrl = EnvLoader::get('APP_URL', 'http://localhost:8888');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}