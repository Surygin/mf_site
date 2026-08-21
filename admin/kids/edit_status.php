<?php

global $db, $appUrl;
include(__DIR__ . '/../pageConstract/header.php');

$id = $_GET['id'];
$kid = $db->get_one('kids', $id);

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <h2>Статус сбора - <?= $kid['name'] ?></h2>
<!--                <form action="kid_update_status.php?id=--><?php //= $id ?><!--" method="POST">-->
                <form action="<?= $appUrl ?>/?page=admin/kid/update/status&id=<?= $id ?>" method="POST">
                    <div class="mb-3">
                        <select class="form-select" required name="status">
                            <option value="active" <?= $kid['status'] == 'active' ? 'selected' : '' ?>>Активный</option>
                            <option value="finished" <?= $kid['status'] == 'finished' ? 'selected' : '' ?>>Закрыт</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Обновить</button>
                </form>
            </div>
            <div class="col-12 col-lg-4 pt-4">
                <span class="d-block mb-4">Уведомления:</span>
                <?php if (!empty($_SESSION['alert'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['alert'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION['alert']); ?>
            </div>
        </div>
    </div>

<?php
if (file_exists(__DIR__ . '/../pageConstract/footer.php')) {
    include(__DIR__ . '/../pageConstract/footer.php');
} else {
    echo '</body></html>';
}
?>