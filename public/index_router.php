<?php
// public/index_router.php - универсальный роутер для Apache

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Определяем корневые пути
define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_ROOT', __DIR__);

// Автозагрузка composer
require_once PROJECT_ROOT . '/vendor/autoload.php';

// Загружаем .env
EnvLoader::load(PROJECT_ROOT . '/.env');

// Подключаем БД
require_once PUBLIC_ROOT . '/admin/db-connect.php';

// Получаем запрошенный URL
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$request = ltrim($request, '/');

// Маппинг URL => физические файлы
$routes = [
    '' => PUBLIC_ROOT . '/index_router.php',
    'index' => PUBLIC_ROOT . '/index_router.php',
    'about' => PROJECT_ROOT . '/pages/about.php',
    'contacts' => PROJECT_ROOT . '/pages/contacts.php',
    'admin' => PROJECT_ROOT . '/admin/index_router.php',
    'admin/dashboard' => PROJECT_ROOT . '/admin/dashboard.php',
    'admin/settings' => PROJECT_ROOT . '/admin/settings.php',
    // Добавьте другие маршруты
];

// Проверяем, есть ли такой маршрут
if (isset($routes[$request])) {
    require_once $routes[$request];
    exit;
}

// Проверяем, есть ли файл в папке pages выше
$possibleFile = PROJECT_ROOT . '/pages/' . $request . '.php';
if (file_exists($possibleFile)) {
    require_once $possibleFile;
    exit;
}

// Или в папке admin выше
$possibleFile = PROJECT_ROOT . '/admin/' . $request . '.php';
if (file_exists($possibleFile)) {
    require_once $possibleFile;
    exit;
}

// 404
http_response_code(404);
echo "Страница не найдена";