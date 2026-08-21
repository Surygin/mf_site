<?php
// admin/kids/edit_doc.php

// Правильный путь к header (на уровень выше)
include(__DIR__ . '/../pageConstract/header.php');

$id = $_GET['id'];

$kid = $db->get_one('kids', $id);

$docs = $db->get_all('docs');
//dd($kid);

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <h2>Документы - <?= $kid['name'] ?></h2>
                <hr>

                <!-- Если есть документы - показываем их -->
                <?php if ($docs && count($docs) > 0): ?>
                    <ul class="list-group mb-3">
                        <?php foreach ($docs as $doc): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $doc['name'] ?? 'Документ' ?>
                                <a href="../kid_delete_doc.php?id=<?= $doc['id'] ?>&kid_id=<?= $id ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Удалить документ?')">Удалить</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="kid_add_doc.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                    <input class="form-control mb-3" type="file" name="docs" multiple>
                    <button type="submit" class="btn btn-primary mb-3">Добавить документы</button>
                </form>
            </div>
            <!-- /.col-lg-8 col-12 -->
            <div class="col-12 col-lg-4">
                <span class="d-block mb-4">Уведомления:</span>
                <?php
                if (!empty($_SESSION['alert'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['alert'] ?></strong>
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