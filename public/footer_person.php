<footer class="footer" id="contacts">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-12">
        <p class="footer__title">ФОНД
          МАРИИ
          ЛЕОНТЬЕВОЙ
        </p>
        <ul class="footer__social">
          <!--<li><a href="http://"><img src="img/footer/facebook.png" alt="link"></a></li>-->
          <!--<li><a href="http://"><img src="img/footer/twitter.png" alt="link"></a></li>-->
          <!--<li><a href="http://"><img src="img/footer/vk.png" alt="link"></a></li>-->
          <!--<li><a href="http://"><img src="img/footer/instagramm.png" alt="link"></a></li>-->
          <a href="https://www.mos.ru/city/projects/blago/fond/blagotvoritelnyy-fond-marii-leontyevoy/" style="color: #fff;">Мы на сайте Мэра Москвы </a>
        </ul>
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-3 col-12">
        <p class="footer__title">юридический адрес</p>
        <p><?php echo $contacts['adress']?></p>
        <p>Телефон:
          <span><?php echo $contacts['phone']?></span>
        </p>
        <p>
          E-mail:
          <span><?php echo $contacts['email']?></span>
        </p>
        <p><a href="https://марияфонд.рф/sms" style="color: #fff">СМС Помощь</a></p>
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-3 col-12">
        <p class="footer__title">Реквизиты:</p>
        <p>108836, г. Москва,
          ул. Нововатутинская
          ИНН 7751188246</p>
      </div>
      <!-- /.col-lg-3 -->
      <?php $requisites = $db->get_one('requisites', '9'); ?>
      <div class="col-lg-3 col-12">
        <p class="footer__title">банк:</p>
        <p>
          <span class="w-100">ИНН <?php echo $requisites['inn']?></span>
          <span class="w-100">Р/С <?php echo $requisites['rs']?></span>
          <span class="w-100">К/С <?php echo $requisites['ks']?></span>
          <span class="w-100">КПП <?php echo $requisites['kpp']?></span>
          <span class="w-100">БИК <?php echo $requisites['bik']?></span>
          <span class="w-100">ОГРН <?php echo $requisites['ogrn']?></span>
          <span class="w-100">Получатель платежа <?php echo $requisites['recipient']?></span>
          <span class="w-100">Наименование Банка <?php echo $requisites['bank']?></span>
        </p>
      </div>
      <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</footer>
<!-- /.footer -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
  $(document).ready(function(){
    $('#header__menu').on("click", function(){
      $('.header__menu-body').show(100);
      $('body').toggleClass('.fixed');
    });
    $('.header__menu-close').on("click", function(){
      $('.header__menu-body').hide(100);
    });
    $('.docs__btn').on("click", function(){
      $('.modal').show(100);
    });
    $('.modal__btn-close').on("click", function(){
      $('.modal').hide(100);
    });
  });
</script>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script type="module">
  import Swiper from 'https://unpkg.com/swiper@7/swiper-bundle.esm.browser.min.js'

  const swiper = new Swiper('.swiper', {
  // Optional parameters

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});

</script>

</body>
</html>