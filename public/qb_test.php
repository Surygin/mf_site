<?php
// Подключаем БД
require_once __DIR__ . '/admin/db-connect.php';

// Проверяем, существует ли класс
if (class_exists('queryBuilder')) {
    echo "✅ Класс queryBuilder существует<br>";

    // Создаем объект
    $db = new queryBuilder($pdo);
    echo "✅ Объект queryBuilder создан";

} else {
    echo "❌ Класс queryBuilder НЕ существует";
}
?>