<?php

$contacts = $db->get_one('contacts', 4);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= $appUrl ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $appUrl ?>/public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <title>марияфонд.рф</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-4">
                <div class="header__menu">
                    <div class="header__menu-link">
                        <p id="header__menu"><span class="header__menu-btn"></span></p>
                        <ul class="header__menu-body">
                            <li><img class="header__menu-close" src="<?= $appUrl ?>/public/img/header/close_btn.svg" alt="btn-close" style="position: absolute; right: 10px; top: 5px; width: 50px; cursor: pointer"></li>
                            <li><a href="<?= $appUrl ?>/#help">Кому нужна помощь?</a></li>
                            <li><a href="https://t.me/+1l86gq5zIsE0OTAy">Стань детским волшебником</a></li>
                            <li><a href="<?= $appUrl ?>?page=files">Документы</a></li>
                            <li><a href="<?= $appUrl ?>?page=reports">Отчеты</a></li>
                            <li><a href="<?= $appUrl ?>?page=history">История фонда</a></li>
                            <li><a href="https://cloud.mail.ru/public/xXTt/F6cFe6AvU">Активный гражданин</a></li>
                            <li><a href="<?= $appUrl ?>?page=sms">СМС-помощь</a></li>
                            <li><a href="<?= $appUrl ?>/#contacts">Контакты</a></li>
                        </ul>
                    </div>
                    <!-- /.header__menu-link -->
                </div>
                <!-- /.header__menu -->
            </div>
            <!-- /.col-12 -->
            <div class="col-md-7 col-8">
                <div class="header__menu-social text-right text-lg-center">
                    <a href="https://www.mos.ru/city/projects/blago/fond/blagotvoritelnyy-fond-marii-leontyevoy/" style="color: red;">Мы на сайте Мэра Москвы </a>
                </div>
                <!-- /.header__menu-social -->
            </div>
            <!-- /.col-8 -->
            <div class="col-md-3 col-12">
                <div class="header__menu-contacts">
                    <p><a href="tel:+79661932420">+7(966)193-24-20</a></p>
                    <p><a class="header__menu-contacts-mail" href="mailto:maria.fond@mail.ru">maria.fond@mail.ru</a> </p>
                </div>
                <!-- /.header__menu-contacts -->
            </div>
            <!-- /.col-2 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
<!-- /.header -->