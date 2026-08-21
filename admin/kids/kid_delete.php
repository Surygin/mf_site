<?php
session_start();
include('db-connect.php');

$id = $_GET['id'];
$db = new queryBuilder($pdo);
$db->delete('kids', $id);
$_SESSION['alert'] = 'Запись удалена!';

header("Location:index.php");

#var_dump($id); echo '<br>';
#var_dump($data);

