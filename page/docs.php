<?php

foreach($kids as $kid){ ?>

<section class="modal-2 d_kid_<?php echo $kid['id']; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal-2-window">
                    <div class="modal-2-window__img text-center">
                        <div class="docs">
                            <?php
                            foreach ($docs as $doc){
                                if($doc['kids_id'] == $kid['id']){?>
                                        <div>your content 

                                            <img src="img/docs/<?php echo $doc['name']?>" alt="Документ">
                                        </div>

                                <?php }
                            }
                            ?>
                        </div>
                        <!-- /.docs -->
                    </div>
                    <!-- /.modal-window__img -->
                    <div class="modal-2-window__text">
                        <img class="modal__btn-close" src="img/header/close_btn.svg" alt="Закрыть окно">
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