<?php include('header.php'); ?>

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
              <h2 class="mb-5">Документы</h2>
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
                      <li><a href="<?= $appUrl ?>/docs_file/Ustav.pdf" download>Устав Фонда</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/svid_reg.pdf" download>Свидетельство о регистрации</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/svid_nalog.pdf" download>Свидетельство о постановке в налоговую</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/requiziti.pdf" download>Реквизиты</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/vipiska.pdf" download>Выписка из ЕГРЮЛ</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/audit2023.pdf" download>Аудит 2023</a></li>
                      <li><a href="<?= $appUrl ?>/docs_file/reestr-moscow.pdf" download>Реестр Москвы</a></li>
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