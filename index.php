<?php
// index.php - ЕДИНАЯ ТОЧКА ВХОДА

// Подключаем БД
require_once __DIR__ . '/admin/db-connect.php';

// Создаем объект $db для работы с БД
if (class_exists('queryBuilder')) {
    $db = new queryBuilder($pdo);
} else {
    die("Класс queryBuilder не найден");
}

$appUrl = EnvLoader::get('APP_URL', 'http://localhost:8888');

// Определяем, какую страницу запросил пользователь
$page = $_GET['page'] ?? 'home';

// Маппинг страниц
$pages = [
    'home' => 'public/index.php',
    'about' => 'public/about.php',
    'contacts' => 'public/contacts.php',
    'reports' => 'public/reports.php',
    'files' => 'public/files.php',
    'history' => 'public/history.php',
    'sms' => 'public/sms.php',
    'help_qr' => 'public/help_qr.php',
    'person' => 'public/person.php',

    '404' => 'public/404.php',

    // админка
    'admin' => 'admin/index.php',
    'admin/requisites' => 'admin/requisites.php',
    'admin/contacts' => 'admin/contacts.php',

    //Kids
    'admin/add_new_kid' => 'admin/kids/add_new_kid.php',
    'admin/kid/create' => 'admin/kids/kid_create.php',
    'admin/kid/edit' => 'admin/kids/edit.php',
    'admin/kid/edit/avatar' => 'admin/kids/edit_avatar.php',
    'admin/kid/edit/doc' => 'admin/kids/edit_doc.php',
    'admin/kid/edit/status' => 'admin/kids/edit_status.php',
    'admin/kid/update/status' => 'admin/kids/kid_update_status.php',
    'admin/kid/update' => 'admin/kids/kid_update.php',
    'admin/kid/update/avatar' => 'admin/kids/kid_update_avatar.php',

    // Tools
    'change_status' => 'public/change_status.php',
    // Добавьте другие страницы
];

// Если страница есть в маппинге - подключаем
if (isset($pages[$page])) {
    require_once $pages[$page];
} else {
    // Если страница не найдена - показываем 404
    require_once 'public/404.php';
    exit;
}