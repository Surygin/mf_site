<?php

include('pageConstract/header.php');

$id = $_GET['id'];


$path = $_FILES['docs']['tmp_name'];
$name = uniqid('doc-') . '.jpg';
$path_name = '../img/docs/' . $name;
$old_name = $_FILES['docs']['name'];

move_uploaded_file($path, $path_name);

var_dump($id); echo '<br>';
var_dump($path); echo '<br>';
var_dump($path_name); echo '<br>';
var_dump($name); echo '<br>';
var_dump($old_name); echo '<br>';

$data = [
    'kids_id' => $_GET['id'],
    'name'  =>  $name
];

$db->create('docs', $data);
$_SESSION['alert'] = 'Документ загружен';

header('Location:'.$_SERVER['HTTP_REFERER'].'');