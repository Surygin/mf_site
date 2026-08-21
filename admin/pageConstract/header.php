<?php
// admin/pageConstract/header.php

// Управление сессией
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Временно отключаем проверку авторизации для разработки
// if (empty($_SESSION['user_id'])) {
//     header('Location: login');
//     exit;
// }

// Подключаем БД с правильным путем (на уровень выше)
if (file_exists(__DIR__ . '/../db-connect.php')) {
    include(__DIR__ . '/../db-connect.php');
} else {
    die("Файл db-connect.php не найден");
}

// Подключаем функции, если есть
if (file_exists(__DIR__ . '/../functions.php')) {
    include(__DIR__ . '/../functions.php');
}

// Подключаем инструменты, если есть
if (file_exists(__DIR__ . '/../tools/tools.php')) {
    include(__DIR__ . '/../tools/tools.php');
}


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <title>Mariafond</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                        Mariafond
                    </a>

                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/?page=admin" class="nav-link px-2 link-secondary">Главная</a></li>
                        <li><a href="/?page=admin/requisites" class="nav-link px-2 link-dark">Реквизиты</a></li>
                        <li><a href="/?page=admin/contacts" class="nav-link px-2 link-dark">Контакты</a></li>
                        <li><a href="/?page=admin/logout" class="nav-link px-2 link-dark">Выход</a></li>
                        <li><a href="<?= $appUrl ?>/" target="_blank" class="nav-link px-2 link-dark">На сайт</a></li>
                    </ul>
                </header>
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
<!-- /.header -->