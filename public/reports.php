<?php

    require_once __DIR__ . '/../app/bootstrap.php';

    include('header.php');

?>

  <section class="person">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12">
          <a class="main__btn" href="http://марияфонд.рф/">На главную</a>
        </div>
      </div>
      <!--/row-->
      <div class="row">
        <div class="offset-lg-3 col-lg-6 col-12">
          <div class="person__descr">
              <h2 class="mb-5">Отчёты</h2>
              <style>
                .docs li{
                    margin-bottom: 20px;
                    list-style: none;
                    border-bottom: 1px solid #000;
                }
                .docs a{
                    padding: 10px;
                    color: #F82A04;
                    transition: all 0.2s ease-in-out;
                }
                .docs a:hover{
                    color: #F82A04;
                    transform: scale(1.1);
                }
              </style>
                <ul class="docs">
                    <li><a href="<?= $appUrl ?>/docs_file/reports/otchet_fonda_v_minust_za_2021.PDF" download>Отчет фонда в мМинюст за 2021 год</a></li>
                    <li><a href="<?= $appUrl ?>/docs_file/reports/otchet_o_celah_i_rashodah_2020.PDF" download>Отчет о целях расходования денежных средств.PDF</a></li>
                    <li><a href="<?= $appUrl ?>/docs_file/reports/buh_otchet_za_2021.pdf" download>Бухгалтерская отчетность за 2021 год</a></li>
                    <li><a href="<?= $appUrl ?>/docs_file/reports/prod_deet.PDF" download>Сообщение о продолжении деятельности</a></li>
                </ul>
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

<?php include('footer.php'); ?>