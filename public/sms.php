<?php

    require_once __DIR__ . '/../app/bootstrap.php';

    include('header.php');

?>

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
                    <h2 class="mb-5">СМС-помощь</h2>
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="offset-lg-3 col-lg-6 col-12">
                    <div class="person__descr">
                        <h3>Самый простой способ помочь — СМС на номер 3434 со словом «Алиса» с указанием любой комфортной для Вас суммы</h3>

                        <p>В ответ вы получите смс для подтверждения платежа. Подтвердите СМС платеж, деньги будут списаны.</p>

                        <ul>
                            <li><a class="link" href="https://moscow.megafon.ru/download/~federal/oferts/oferta_m_platezhi.pdf" target="_blank">Оферта услуги Мегафон</a></li>
                            <li><a class="link" href="https://static.mts.ru/uploadmsk/contents/1655/soglashenie_easy_pay.pdf" target="_blank">Оферта услуги МТС</a></li>
                            <li><a class="link" href="https://www.ruru.ru/storage/offers/OfferNSK.pdf" target="_blank">Оферта услуги Билайн</a>, <a class="link" href="https://static.beeline.ru/upload/images/Documents/limits-mobilnyi-platezh.pdf" target="_blank">лимиты</a></li>
                            <li><a class="link" href="https://acdn.tinkoff.ru/static/documents/e49f66a8-1a32-4263-83c2-9eb306487464.pdf" target="_blank">Оферта услуги T - Mobile</a></li>
                            <li><a class="link" href="https://www.yota.ru/downloads/forms/oferta_m_platezh.pdf" target="_blank">Оферта услуги Yota</a></li>
                        </ul>

                        <p>Услуга доступна для абонентов МТС, билайн, Мегафон, Т-Мобайл, Yota. Допустимый размер платежа — от 1 до 15 000 рублей. Стоимость отправки SMS на номер 3434 — бесплатно. Комиссия с абонента — 0%.</p>

                        <p>Мобильные платежи осуществляются через платёжный сервис Миксплат. Совершая платёж, вы принимаете условия <a class="link" href="https://mixplat.ru/offer/offer_subscriber.pdf" target="_blank">Оферты</a>.</p>

                        <p>Информацию о порядке и периодичности оказания услуг и условиях возврата вы можете получить по телефону <a class="link" href="tel:+74957750600">+7 495 775 06 00</a> или почте <a class="link" href="mailto:support@mixplat.ru">support@mixplat.ru</a>.</p>
                    </div>
                    <!-- /.person__descr -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 text-center">
                    <img src="<?= $appUrl ?>/public/img/operators.png" style="width: 100%; max-width: 800px;" alt="Операторы">
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.person -->

<?php include('footer.php'); ?>