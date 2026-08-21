<?php
// admin/kids/kid_update_avatar.php

session_start();

// Правильный путь к db-connect.php (на уровень выше)
include(__DIR__ . '/../db-connect.php');

$id = (int)$_GET['id'];

// Получаем текущего ребенка, чтобы узнать старую картинку
$kid = $db->get_one('kids', $id);

// Проверяем, что файл загружен
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {

    $file = $_FILES['avatar'];
    $fileName = $file['name'];
    $tmpPath = $file['tmp_name'];

    // Получаем расширение файла
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

    // Генерируем уникальное имя
    $newName = 'avatar-' . uniqid() . '.' . $ext;
    $uploadPath = __DIR__ . '/../../public/img/avatars/' . $newName;

    // Создаём папку, если её нет
    $uploadDir = __DIR__ . '/../../public/img/avatars/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Перемещаем файл
    if (move_uploaded_file($tmpPath, $uploadPath)) {

        // ✅ УДАЛЯЕМ СТАРУЮ КАРТИНКУ
        if (!empty($kid['avatar'])) {
            $oldFilePath = __DIR__ . '/../../public/' . $kid['avatar'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);  // Удаляем файл
            }
        }

        // Сохраняем новый путь в БД
        $dbPath = 'img/avatars/' . $newName;

        $data = [
            'avatar' => $dbPath
        ];

        $db = new queryBuilder($pdo);
        $db->update('kids', $data, $id);

        $_SESSION['alert'] = 'Фото загружено';

    } else {
        $_SESSION['alert'] = 'Ошибка загрузки файла';
    }

} else {
    $_SESSION['alert'] = 'Файл не выбран или произошла ошибка';
}

// Редирект обратно
header("Location: /?page=admin/kid/edit/avatar&id=" . $id);