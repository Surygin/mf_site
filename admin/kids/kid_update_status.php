<?php
// admin/kids/kid_update_status.php

session_start();

// Подключаем БД (на уровень выше)
include(__DIR__ . '/../db-connect.php');

$id = $_GET['id'] ?? null;
$data = $_POST ?? [];

if (!empty($data) && $id) {
    $db = new queryBuilder($pdo);
    $db->update('kids', $data, $id);
    $_SESSION['alert'] = 'Статус обновлен';
}

header("Location: /?page=admin");