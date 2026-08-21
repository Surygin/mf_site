<?php
session_start();
include('db-connect.php');

$id = 9;
$data = $_POST;

if(!empty($_POST)){
    $db = new queryBuilder($pdo);
    $db->update('requisites', $data, $id);
    $_SESSION['alert'] = 'Запись обновлена';
}

header("Location:requisites.php");

#var_dump($id); echo '<br>';
#var_dump($data);

