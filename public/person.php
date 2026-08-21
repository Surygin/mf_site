<?php
// public/person.php

include('header.php');

// Получаем ID из GET (поддерживаем оба варианта)
$person_id = isset($_GET['person']) ? (int)$_GET['person'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);

// Если ID не передан или равен 0 — показываем ошибку
if ($person_id <= 0) {
    echo "<div class='container'><div class='row'><div class='col-12'><p>Ребенок не найден</p></div></div></div>";
    include('footer.php');
    exit;
}

// Получаем данные ребенка
$kid = $db->get_one('kids', $person_id);

// Если ребенок не найден — показываем ошибку
if (!$kid) {
    echo "<div class='container'><div class='row'><div class='col-12'><p>Ребенок не найден</p></div></div></div>";
    include('footer.php');
    exit;
}

// Получаем документы ребенка
$docs = $db->get_all_docs('docs', $person_id);
?>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <section class="person">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <a class="main__btn" href="<?= $appUrl ?>/">На главную</a>
                </div>
            </div>
            <!--/row-->
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mb-5"><?= $kid['name'] . ' ' . $kid['last_name'] ?></h2>
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="person__img">
                        <img src="<?= $appUrl ?>/public/<?= $kid['avatar'] ?>" alt="Фото <?= $kid['name'] ?>">
                    </div>
                    <!-- /.person__img -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6 col-12">
                    <div class="person__descr">
                        <p><?= $kid['history'] ?></p>
                        <div class="person__btn text-center">
                            <?php if (!empty($docs) && count($docs) > 0) { ?>
                                <a class="main__btn docs__btn" href="#">Фото и документы</a>
                            <?php } ?>
                        </div>
                        <!-- /.person__btn -->
                    </div>
                    <!-- /.person__descr -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.person -->

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
                            <input name="kid_name" type="hidden" value="<?= $kid['name'] . ' ' . $kid['last_name'] ?>">
                            <input class="btn main__btn main__btn-reverse" name="sum" type="text" placeholder="Введите сумму" value="100">
                            <button class="btn main__btn">Пожертвовать</button><br>
                            <a href="https://марияфонд.рф/docs_file/draft_offer_nko.docx" style="margin-top: 20px; color: #F82A04; border-bottom: 1px solid #F82A04;">Оферта</a>
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

    <section class="modal">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="modal__btn-close" src="<?= $appUrl ?>/img/header/close_btn.svg" alt="Закрыть окно">
                </div>
                <!-- /.col-12 -->
                <div class="col-12">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php if (!empty($docs) && count($docs) > 0) { ?>
                                <?php foreach ($docs as $doc) { ?>
                                    <div class="swiper-slide text-center">
                                        <img src="<?= $appUrl ?>/img/docs/<?= $doc['name'] ?>" alt="Документы">
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="swiper-slide text-center">
                                    <p>Нет документов</p>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.modal -->

<?php include('footer_person.php'); ?>