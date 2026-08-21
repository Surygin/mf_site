<?php
session_start();
include('db-connect.php');

$id = $_GET['id'];
$data = $_POST;

if(!empty($_POST)){
    $db = new queryBuilder($pdo);
    $db->update('kids', $data, $id);
    $_SESSION['alert'] = 'Запись обновлена';
}

header("Location: /?page=admin");


