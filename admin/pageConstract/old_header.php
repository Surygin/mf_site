<?php

session_start();

include ('db-connect.php');
include ('functions.php');
include ('tools/tools.php');

//    if (empty($_SESSION['user_id'])){
//        header('Location: login');
//    }


$db = new queryBuilder($pdo);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
                        <li><a href="index" class="nav-link px-2 link-secondary">Главная</a></li>
                        <li><a href="requisites" class="nav-link px-2 link-dark">Реквизиты</a></li>
                        <li><a href="contacts" class="nav-link px-2 link-dark">Контакты</a></li>
                        <li><a href="logaut" class="nav-link px-2 link-dark">Выход</a></li>
                        <li><a href="http://марияфонд.рф" target="_blank" class="nav-link px-2 link-dark">На сайт</a></li>
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