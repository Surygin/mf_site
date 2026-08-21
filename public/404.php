<?php
// public/404.php - Страница 404

// Устанавливаем статус 404
http_response_code(404);

include('header.php');
?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="main__text">
                        <div class="main__text-title">
                            <img id="heart_1" src="/public/img/main/Heart1.png" alt="heart1">
                            <h1>404</h1>
                        </div>
                        <!-- /.main__text-title -->
                        <div class="main__text-subtitle">
                            <p>Страница не найдена</p>
                        </div>
                        <!-- /.main__text-subtitle -->

                        <div class="main__text-description" style="margin-top: 30px;">
                            <p style="font-size: 18px; color: #555;">
                                К сожалению, запрашиваемая страница не существует или была перемещена.
                            </p>
                        </div>

                        <div style="margin-top: 40px;">
                            <a href="<?= $appUrl ?>/" class="main__btn" style="display: inline-block; margin-bottom: 20px; color: #fff;">
                                <i class="bi bi-arrow-left"></i> Вернуться на главную
                            </a>
                        </div>
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

<?php include('footer.php'); ?>