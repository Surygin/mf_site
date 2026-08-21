<?php
// public/change_status.php

// Правильный путь к db-connect.php (на уровень выше в папку admin)
global $pdo;
include(__DIR__ . '/../admin/db-connect.php');

// Выполняем запрос
$pdo->query("UPDATE kids SET is_active = 0");

echo "Готово!";
echo "<br><a href='/?page=admin'>Назад</a>";
?>