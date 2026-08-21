<?php

include('db-connect.php');

$data = $_POST;

if(!empty($_POST)){
    $db = new queryBuilder($pdo);
    $db->create('kids', $data);
    $_SESSION['alert'] = 'Запись добавлена!';
} else {
    $_SESSION['alert'] = 'Форма не заполнена!';
}

header("Location: /?page=admin");
