<?php

require_once __DIR__ . '/../app/bootstrap.php';

// 1. Создаём репозиторий, передавая туда QueryBuilder ($db)
$kidRepo = new \App\Repositories\KidRepository($db);

// 2. Создаём сервис, передавая ему репозиторий (теперь типы совпадают)
$kidService = new \App\Services\KidService($kidRepo);

$activeKids = $kidService->getActive();
$finishedKids = $kidService->getFinished();

include 'header.php';


?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="main__text">
                        <div class="main__text-title">
                            <img id="heart_1" src="/public/img/main/Heart1.png" alt="heart1">
                            <h1>Благотворительный фонд Марии Леонтьевой <img id="heart_2"
                                                                             src="/public/img/main/Heart2.png"
                                                                             alt="heart2"></h1>
                        </div>
                        <!-- /.main__text-title -->
                        <div class="main__text-subtitle">
                            <p>Быть рядом!</p>
                        </div>
                        <!-- /.main__text-subtitle -->
                        <a class="main__btn" style="display: inline-block; margin-bottom: 20px; color: #fff;">Пожертвовать
                            средства</a>
                        <a href="https://t.me/+1l86gq5zIsE0OTAy" class="main__btn main__btn-reverse">Стать&nbsp;волонтером</a>
                        <a href="<?= $appUrl ?>/?page=help_qr" class="main__btn main__btn-reverse">Помочь&nbsp;QR</a>
                    </div>
                    <!-- /.main-text -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="offset-md-0 col-md-4 offset-3 col-6 d-none d-md-block">
                    <div class="main__bg">
                        <img src="/public/img/main/rocket.png" alt="rocket">
                        <img class="main__img-bg" src="/public/img/main/Fond_ML.png" alt="фон">
                        <img class="main__img-fly" src="/public/img/main/lego.png" alt="lego">
                        <img class="main__img-fly2" src="/public/img/main/cubes.png" alt="cubes">
                    </div>
                    <!-- /.main__bg -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.main -->

    <!--  Нужна помощь  -->
    <section class="help" id="help">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="help__header" id="whu">Кому нужна наша помощь</h2>
                </div>
            </div>

            <?php
            $step = 1;
            foreach ($activeKids as $kid):
                // Теперь $kid — это объект App\Models\Kid, а не массив
                $fullName = $kid->getFullName();
                $avatarPath = $kid->avatar ? '/public/' . $kid->avatar : '/public/img/default.png';
                ?>
                <div class="row <?= $step % 2 === 0 ? 'd-flex flex-row-reverse' : '' ?>">
                    <div class="col-md-6 col-12 text-center">
                        <div class="help__item text-left">
                            <img class="help_photo" src="<?= htmlspecialchars($avatarPath) ?>"
                                 alt="<?= htmlspecialchars($fullName) ?>">
                            <div class="help__info">
                                <p class="help__name"><?= htmlspecialchars($fullName) ?></p>
                                <p class="help__money d-flex flex-column">
                                    <span>Внесено пожертвований</span>
                                    <!-- number_format красиво форматирует числа с пробелами -->
                                    <span><?= htmlspecialchars($kid->getFormattedSum1()) ?> рублей из</span>
                                    <span><?= htmlspecialchars($kid->getFormattedSum2()) ?> рублей</span>
                                </p>
                                <p>
                                    <a class="help__link"
                                       href="<?= $appUrl ?>?page=person&id=<?= $kid->id ?>">История <?= htmlspecialchars($kid->name ?? 'ребёнка') ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="help__btn d-flex flex-column">
                            <a class="main__btn" href="person?person=<?= $kid->id ?>">Сделать пожертвование</a>
                            <a class="main__btn main__btn-reverse" href="https://t.me/+1l86gq5zIsE0OTAy">Помочь другим
                                способом</a>
                            <a class="main__btn main__btn-reverse" href="#">Счёт для юридических лиц</a>
                        </div>
                    </div>
                </div>
                <?php $step++; ?>
            <?php endforeach; ?>

            <?php if (empty($activeKids)): ?>
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <p>Сейчас нет детей, которым нужна срочная помощь.</p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <!-- /.help -->

    <!--  Уже помогли  -->
    <?php if (!empty($finishedKids)): ?>
    <section class="help mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="help__header">Уже помогли</h2>
                </div>
            </div>

            <?php
            $step = 1;
            foreach ($finishedKids as $kid):
                $fullName = $kid->getFullName();
                $avatarPath = $kid->avatar ? '/public/' . $kid->avatar : '/public/img/default.png';
                ?>
                <div class="row <?= $step % 2 === 0 ? 'd-flex flex-row-reverse' : '' ?>">
                    <div class="col-md-6 col-12 text-center">
                        <div class="help__item text-left">
                            <img class="help_photo" src="<?= htmlspecialchars($avatarPath) ?>"
                                 alt="<?= htmlspecialchars($fullName) ?>">
                            <div class="help__info">
                                <p class="help__name"><?= htmlspecialchars($fullName) ?></p>

                                <!-- Тут можно сразу увидеть фразу для транскрибации -->
                                <?php if ($kid->isFinished()): ?>
                                    <p style="color: #006600; font-weight: bold;">Сбор закрыт</p>
                                <?php endif; ?>

                                <p class="help__money d-flex flex-column">
                                    <span>Собрано</span>
                                    <span><?= htmlspecialchars($kid->getFormattedSum1()) ?> рублей из</span>
                                    <span><?= htmlspecialchars($kid->getFormattedSum2()) ?> рублей</span>
                                </p>
                                <p>
                                    <a class="help__link"
                                       href="<?= $appUrl ?>?page=person&id=<?= $kid->id ?>">История <?= htmlspecialchars($kid->name ?? 'ребёнка') ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="help__btn d-flex flex-column">
                            <!-- Для закрытых сборов кнопку «Сделать пожертвование» можно либо скрыть, либо оставить как «Помочь другим» -->
                            <a class="main__btn main__btn-reverse" href="https://t.me/+1l86gq5zIsE0OTAy">Помочь другим
                                детям</a>
                            <a class="main__btn main__btn-reverse" href="https://t.me/+1l86gq5zIsE0OTAy">Стать
                                волонтёром</a>
                            <a class="main__btn main__btn-reverse" href="#">Счёт для юрлиц</a>
                        </div>
                    </div>
                </div>
                <?php $step++; ?>
            <?php endforeach; ?>

        </div>
    </section>
    <!-- /.help -->
    <?php endif; ?>

    <section class="important">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="important__bg">
                        <img src="/public/img/important/important.png" alt="картинка">
                    </div>
                    <!-- /.vazhno__bg -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="important__msg">
                        <!--<img src="/public/img/important/important_msg.png" alt="картинка">-->
                        <div class="important__msg-text text-center">
                            <p class="important__msg-title">Делимся важным</p>
                            <p>Фонд Марии Леонтьевой рассматривает разные варианты помощи больным детям. Мы всегда
                                готовы предоставить любые правоустанавливающие документы фонда, счета и акты, чтобы
                                сделать вашу помощь «юридически легкой» для вас.</p>
                        </div>
                        <!-- /.important__msg-text -->
                    </div>
                    <!-- /.important_msg -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.vazhno -->
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="about__text">
                        <div class="about__text-title">
                            Благотворительный фонд
                            с открытым сердцем
                        </div>
                        <!-- /.about__text-title -->
                        <div class="about__text-text">
                            Фонд Марии Леонтьевой зарегистрирован в министерстве юстиции под учетным номером 7714017510.
                            Инициативная группа фонда – это волонтеры, которые в разное время пришли на помощь Марии
                            Леонтьевой и ее родителям.
                        </div>
                        <!-- /.about__text-text -->
                    </div>
                    <!-- /.about1__text -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-md-5 col-12">
                    <div class="about__link text-center">
                        <!--<img src="/public/img/about/Ellipse.png" alt="подложка">-->
                        <div class="about__link-wrap">
                            <a class="reg_number" href="http://unro.minjust.ru/NKOs.aspx">Ссылка на
                                регистрационный
                                номер <img src="/public/img/about/Arrow.svg" alt="arrow"></a>
                        </div>
                        <!-- /.about__link-wrap -->
                    </div>
                    <!-- /.about__link -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.about1 -->
    <section class="openBook" id="openBook">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="openBook__img">
                        <img src="/public/img/openBook/openBook.png" alt="background">
                    </div>
                    <!-- /.openBook__img -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6 col-12">
                    <div class="openBook__text">
                        <div class="openBook__text-title">
                            Открытая книга
                        </div>
                        <!-- /.openBook__text-title -->
                        <div class="openBook__text-subtitle">
                            Мы покажем каждый рубль, поступивший к нам
                        </div>
                        <!-- /.openBook__text-subtitle -->
                        <div class="openBook__text-body">
                            Целью нашей работы является не только сбор средств больным детям, но и открытость каждого
                            вашего взноса. Мы не скрываем расходы фонда на рекламу и АХО, а также полученные фондом
                            деньги от юридических лиц.
                            <span>Давайте сделаем Благотворительность прозрачнее.</span>
                        </div>
                        <!-- /.openBook__text-body -->
                    </div>
                    <!-- /.openBook__text -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.openBook -->
    <section class="donations">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="donations__text">
                        <div class="donations__text-title">
                            Ежемесячная подписка
                            на пожертвования
                        </div>
                        <!-- /.donations__text-title -->
                        <div class="donations__text-subtitle">
                            Действительно важно
                        </div>
                        <!-- /.donations__text-subtitle -->
                        <div class="donations__text-body">
                            Ежемесячные перечисления в указанную дату дают нам невероятно важную вещь – возможность
                            планировать! Иногда такой план может спасти жизнь ребенку.
                        </div>
                        <!-- /.donations__text-body -->
                    </div>
                    <!-- /.donations-text -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6 col-12">
                    <div class="donations__img">
                        <img src="/public/img/donations/donations.png" alt="картинка">
                    </div>
                    <!-- /.donations__img -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.donations -->
    <section class="offer" id="kid_wizard">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="offer__header">
                        Стань детским волшебником
                    </div>
                    <!-- /.offer__header -->
                    <div class="offer__subtitle">
                        Чтобы фонд работал эффективнее нам очень нужны волонтеры
                    </div>
                    <!-- /.offer__subtitle -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="offert__heart">
                        <img src="/public/img/donations/heart__1.png" alt="heart">
                        <img class="offer__heart-absolute" src="/public/img/donations/heart__2.png" alt="heart">
                    </div>
                    <!-- /.offert__hert -->
                </div>
                <!-- /.col-lg-3 -->
                <div class="col-lg-6">
                    <form class="offer__form" action="#">
                        <input class="btn main__btn main__btn-reverse" type="text" placeholder="Ваше имя">
                        <input class="btn main__btn main__btn-reverse" type="text" placeholder="Ваш телефон">
                        <button class="btn main__btn">Стань частью нашей Команды</button>
                    </form>
                </div>
                <!-- /.offset-lg-3 col-lg-6 -->
                <div class="col-lg-3">
                    <div class="offer__img">
                        <img src="/public/img/donations/magic.png" alt="magic">
                    </div>
                    <!-- /.offer__img -->
                </div>
                <!-- /.col-lg-3 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.offer -->
    <section class="donations2">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="donations2__form">
                        <form action="https://марияфонд.рф/pay/pay.php" method="POST">
                            <div class="donations2__form-header">
                                Сделать пожертвование
                            </div>
                            <!-- /.donations2__form-header -->
                            <input name="kid_name" type="hidden" value="БФ Марии Леонтьевой">
                            <input class="btn main__btn main__btn-reverse" type="text" name="sum"
                                   placeholder="Введите сумму" value="100">
                            <button class="btn main__btn">Пожертвовать</button>
                            <br>
                            <a href="https://марияфонд.рф/docs_file/draft_offer_nko.docx"
                               style="margin-top: 20px; color: #F82A04; border-bottom: 1px solid #F82A04;">Оферта</a>
                        </form>
                    </div>
                    <!-- /.donations2__form -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.donations2 -->

<?php include('footer.php'); ?>