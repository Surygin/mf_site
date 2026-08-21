<div class="col-12">
    <span class="d-block mb-4">Уведомления:</span>
    <?php
    if(!empty($_SESSION['alert'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['alert'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    unset($_SESSION['alert']);
    ?>
</div>
<!-- /.col-12 col-lg-4 -->