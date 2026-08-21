<?php
// admin/kids/edit.php

// Правильный путь к header (на уровень выше)
global $appUrl, $db;
include(__DIR__ . '/../pageConstract/header.php');

$id = $_GET['id'];

$kid = $db->get_one('kids', $id);

//dd($kid);

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <form action="<?= $appUrl ?>/?page=admin/kid/update&id=<?= $id ?>" method="POST">
                    <h2>Кому нужна помощь?</h2>
                    <input class="form-control mb-3" type="text" name="name" value="<?php echo $kid['name'] ?>">
                    <input class="form-control mb-3" type="text" name="last_name"
                           value="<?php echo $kid['last_name'] ?>">
                    <textarea class="form-control mb-3" id="editor" name="history" cols="30"
                              rows="10"><?php echo $kid['history'] ?></textarea>
                    <input class="form-control mb-3" type="text" name="sum1" value="<?php echo $kid['sum1'] ?>">
                    <input class="form-control mb-3" type="text" name="sum2" value="<?php echo $kid['sum2'] ?>">

                    <div class="form-check mb-3">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                            <?= $kid['is_active'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Сбор активен</label>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Обновить</button>
                    <a class="btn btn-dark" href="?page=admin">Назад</a>
                </form>
            </div>
            <!-- /.col-lg-8 col-12 -->
            <div class="col-12 col-lg-4 pt-4">
                <span class="d-block mb-4">Уведомления:</span>
                <?php
                if (!empty($_SESSION['alert'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['alert'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION['alert']);
                ?>
            </div>
            <!-- /.col-12 col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

<?php
// Подключаем footer
if (file_exists(__DIR__ . '/../pageConstract/footer.php')) {
    include(__DIR__ . '/../pageConstract/footer.php');
} elseif (file_exists(__DIR__ . '/../../public/footer.php')) {
    include(__DIR__ . '/../../public/footer.php');
} else {
    echo '</body></html>';
}
?>