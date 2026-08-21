<?php
// admin/kids/edit.php

global $appUrl, $db;
include(__DIR__ . '/../pageConstract/header.php');

$id = (int)$_GET['id'];
$kid = $db->get_one('kids', $id);

if (!$kid) {
    $_SESSION['alert'] = 'Ребенок не найден';
    header("Location: /?page=admin");
    exit;
}
?>

    <style>
        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .form-check-input:not(:checked) {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>

    <div class="container py-4">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/?page=admin"><i class="bi bi-house-door"></i> Главная</a></li>
                <li class="breadcrumb-item"><a href="/?page=admin">Дети</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Карточка с формой -->
                <div class="card shadow-sm">
                    <div class="card-header alert-info">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Редактирование: <?= htmlspecialchars($kid['name'] . ' ' . $kid['last_name']) ?>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="<?= $appUrl ?>/?page=admin/kid/update&id=<?= $id ?>" method="POST">
                            <!-- Основная информация -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Имя <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="text" name="name" id="name"
                                               value="<?= htmlspecialchars($kid['name']) ?>" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label fw-bold">Фамилия <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="text" name="last_name" id="last_name"
                                               value="<?= htmlspecialchars($kid['last_name']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- История -->
                            <div class="mb-3">
                                <label for="editor" class="form-label fw-bold">История ребенка</label>
                                <textarea class="form-control" id="editor" name="history" cols="30" rows="10"><?= htmlspecialchars($kid['history']) ?></textarea>
                            </div>

                            <!-- Суммы -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sum1" class="form-label fw-bold">Собрано средств (руб.)</label>
                                        <input class="form-control" type="number" name="sum1" id="sum1"
                                               value="<?= $kid['sum1'] ?>" step="0.01" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sum2" class="form-label fw-bold">Необходимо собрать (руб.)</label>
                                        <input class="form-control" type="number" name="sum2" id="sum2"
                                               value="<?= $kid['sum2'] ?>" step="0.01" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Статус -->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Статус сбора</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                        <?= $kid['is_active'] == 1 ? 'checked' : '' ?>
                                           style="width: 3.5em; height: 1.8em; cursor: pointer;">
                                    <label class="form-check-label fw-bold <?= $kid['is_active'] == 1 ? 'text-success' : 'text-secondary' ?>"
                                           for="is_active" id="statusLabel" style="font-size: 1.1em;">
                                        <?= $kid['is_active'] == 1 ? '✅ Сбор активен' : '⛔ Сбор закрыт' ?>
                                    </label>
                                </div>
                            </div>

                            <!-- Кнопки -->
                            <div class="d-flex gap-2 justify-content-between flex-wrap">
                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-check-lg"></i> Сохранить
                                    </button>
                                    <a href="/?page=admin/kid/delete&id=<?= $id ?>"
                                       onclick="return confirm('Вы точно хотите удалить <?= $kid['name'] . ' ' . $kid['last_name'] ?>?')"
                                       class="btn btn-outline-danger btn-lg">
                                        <i class="bi bi-trash3"></i> Удалить
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-outline-secondary" href="/?page=admin">
                                        <i class="bi bi-x-lg"></i> Отмена
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <!-- Информационная карточка -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-info-circle"></i> Информация
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>ID:</strong> <?= $kid['id'] ?></p>
                        <p class="mb-1"><strong>Создан:</strong> <?= date('d.m.Y', strtotime($kid['created_at'] ?? 'now')) ?></p>
                        <p class="mb-0"><strong>Текущий статус:</strong>
                            <span class="badge <?= $kid['is_active'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $kid['is_active'] == 1 ? 'Активен' : 'Закрыт' ?>
                        </span>
                        </p>
                    </div>
                </div>

                <!-- Уведомления -->
                <span class="d-block mb-3 fw-bold"><i class="bi bi-bell"></i> Уведомления:</span>
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        // Изменение текста статуса при клике
        document.getElementById('is_active').addEventListener('change', function() {
            const label = document.getElementById('statusLabel');
            if (this.checked) {
                label.className = 'form-check-label fw-bold text-success';
                label.textContent = '✅ Сбор активен';
            } else {
                label.className = 'form-check-label fw-bold text-secondary';
                label.textContent = '⛔ Сбор закрыт';
            }
        });
    </script>

<?php
if (file_exists(__DIR__ . '/../pageConstract/footer.php')) {
    include(__DIR__ . '/../pageConstract/footer.php');
} elseif (file_exists(__DIR__ . '/../../public/footer.php')) {
    include(__DIR__ . '/../../public/footer.php');
} else {
    echo '</body></html>';
}
?>