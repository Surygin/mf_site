<?php
session_start();
include('db-connect.php');

$id = 4;
$data = $_POST;

if(!empty($_POST)){
    $db = new queryBuilder($pdo);
    $db->update('contacts', $data, $id);
    $_SESSION['alert'] = 'Запись обновлена';
}

header("Location:contacts.php");

#var_dump($id); echo '<br>';
#var_dump($data);

