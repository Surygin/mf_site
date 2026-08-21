<?php

// Подключаем загрузчик .env
require_once __DIR__ . '/../app/EnvLoader.php';
try {
    // Загружаем переменные окружения
    $env = EnvLoader::load();

    // Создаем подключение к БД
    $pdo = new PDO(
        sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            EnvLoader::get('DB_HOST', 'localhost'),
            EnvLoader::get('DB_PORT', '8889'),
            EnvLoader::get('DB_NAME', 'bd_name'),
            EnvLoader::get('DB_CHARSET', 'utf8')
        ),
        EnvLoader::get('DB_USER', 'root'),
        EnvLoader::get('DB_PASS', 'root'),
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Проверяем подключение
    $pdo->query("SELECT 1");

    // Для отладки (включить только при разработке)
    if (EnvLoader::get('APP_DEBUG') === 'true') {
        echo "<!-- Подключение к БД успешно -->";
    }

} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
} catch (Exception $e) {
    die("Ошибка загрузки .env: " . $e->getMessage());
}

// Подключаем queryBuilder
if (file_exists(__DIR__ . '/queryBuilder_oop.php')) {
    include(__DIR__ . '/queryBuilder_oop.php');
} else {
    die("Файл queryBuilder_oop.php не найден");
}
