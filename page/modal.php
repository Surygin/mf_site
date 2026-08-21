<?php
foreach($kids as $kid){ ?>
<section class="modal m_kid_<?php echo $kid['id']; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal-window">
                    <div class="modal-window__img">
                        <img src="<?php echo $kid['avatar'] ?>" alt="Фото">
                    </div>
                    <!-- /.modal-window__img -->
                    <div class="modal-window__text">
                        <img class="modal__btn-close" src="img/header/close_btn.svg" alt="Закрыть окно">
                        <h2><?php echo $kid['firstname']. ' ' . $kid['lastname']?></h2>
                        <p>
                            <?php echo $kid['history']?>
                        </p>
                        <a class="main__btn modal2__active-<?php echo $kid['id']; ?>" href="#">Фото и документы</a>
                    </div>
                    <!-- /.modal-window__text -->
                </div>
                <!-- /.modal-window -->
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.contaner -->
</section>
<!-- /.modal -->

<?php } ?>