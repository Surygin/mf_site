<?php
// admin/db-connect.php

// Подключаем EnvLoader
$envFile = __DIR__ . '/../app/EnvLoader.php';
if (!file_exists($envFile)) {
    die("Файл EnvLoader.php не найден по пути: $envFile");
}
require_once $envFile;

try {
    // Загружаем .env
    EnvLoader::load();

    // Получаем настройки из .env
    $host = EnvLoader::get('DB_HOST', 'localhost');
    $port = EnvLoader::get('DB_PORT', '8889');
    $dbname = EnvLoader::get('DB_NAME', 'mf_site');
    $user = EnvLoader::get('DB_USER', 'root');
    $pass = EnvLoader::get('DB_PASS', 'root');
    $charset = EnvLoader::get('DB_CHARSET', 'utf8');

    // Создаем подключение к БД
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Проверяем подключение
    $pdo->query("SELECT 1");

    // Для отладки
    if (EnvLoader::get('APP_DEBUG', false) === true) {
        echo "<!-- Подключение к БД успешно -->";
    }

} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
} catch (Exception $e) {
    die("Ошибка: " . $e->getMessage());
}

// Подключаем queryBuilder ТОЛЬКО ОДИН РАЗ
if (!class_exists('queryBuilder')) {
    $qbFile = __DIR__ . '/queryBuilder_oop.php';
    if (file_exists($qbFile)) {
        require_once $qbFile;
    } else {
        die("Файл queryBuilder_oop.php не найден по пути: $qbFile");
    }
}

// Создаем объект $db только если его еще нет
if (class_exists('queryBuilder') && !isset($db)) {
    $db = new queryBuilder($pdo);
}
?>