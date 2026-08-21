<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\QueryBuilder;

define('PROJECT_ROOT', dirname(__DIR__));

// Подключение автозагрузки классов
spl_autoload_register(function (string $class): void {

    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));

    $file = PROJECT_ROOT
        . '/app/'
        . str_replace('\\', '/', $relativeClass)
        . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
// -------------------------------------------------------------

require_once PROJECT_ROOT . '/app/EnvLoader.php';

EnvLoader::load(PROJECT_ROOT . '/.env');

$database = new Database();
$pdo = $database->getConnection();

$db = new QueryBuilder($pdo);

$appUrl = EnvLoader::get(
    'APP_URL',
    'http://localhost:8888'
);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}