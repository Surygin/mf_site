<?php
// admin/kids/add_new_kid.php

global $appUrl, $db;
include(__DIR__ . '/../pageConstract/header.php');

// Проверяем, есть ли уведомление
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
?>

    <style>
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .form-check-input:not(:checked) {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>

    <div class="container py-4">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/?page=admin"><i class="bi bi-house-door"></i> Главная</a></li>
                <li class="breadcrumb-item"><a href="/?page=admin">Дети</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавление</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Карточка с формой -->
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-person-plus"></i> Добавление нового ребенка
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Уведомление об ошибке -->
                        <?php if (!empty($alert)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= htmlspecialchars($alert) ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= $appUrl ?>/?page=admin/kid/create" method="POST">
                            <!-- Основная информация -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Имя <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="text" name="name" id="name"
                                               placeholder="Введите имя" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label fw-bold">Фамилия <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="text" name="last_name" id="last_name"
                                               placeholder="Введите фамилию" required>
                                    </div>
                                </div>
                            </div>

                            <!-- История -->
                            <div class="mb-3">
                                <label for="editor" class="form-label fw-bold">История ребенка</label>
                                <textarea class="form-control" id="editor" name="history" cols="30" rows="10"
                                          placeholder="Расскажите историю ребенка..."><?= htmlspecialchars($_POST['history'] ?? '') ?></textarea>
                            </div>

                            <!-- Суммы -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sum1" class="form-label fw-bold">Собрано средств (руб.)</label>
                                        <input class="form-control" type="number" name="sum1" id="sum1"
                                               placeholder="0" value="0" step="0.01" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sum2" class="form-label fw-bold">Необходимо собрать (руб.)</label>
                                        <input class="form-control" type="number" name="sum2" id="sum2"
                                               placeholder="0" value="0" step="0.01" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Статус -->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Статус сбора</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                           style="width: 3.5em; height: 1.8em; cursor: pointer;">
                                    <label class="form-check-label fw-bold text-secondary" for="is_active" id="statusLabel"
                                           style="font-size: 1.1em;">
                                        ⛔ Сбор закрыт
                                    </label>
                                </div>
                            </div>

                            <!-- Кнопки -->
                            <div class="d-flex gap-2 justify-content-between flex-wrap">
                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-check-lg"></i> Создать
                                    </button>
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
            <div class="col-12 col-lg-4 pt-4">
                <!-- Информационная карточка -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-info-circle"></i> Информация
                    </div>
                    <div class="card-body">
                        <p class="mb-0 text-muted">
                            <i class="bi bi-lightbulb"></i> Заполните все обязательные поля (<span class="text-danger">*</span>)
                            и нажмите "Создать" для добавления нового ребенка.
                        </p>
                    </div>
                </div>

                <!-- Подсказка -->
                <div class="card shadow-sm mb-4 border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-tip"></i> Подсказка
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li><i class="bi bi-check text-success"></i> Имя и фамилия обязательны</li>
                            <li><i class="bi bi-check text-success"></i> История может быть добавлена позже</li>
                            <li><i class="bi bi-check text-success"></i> Статус можно изменить позже</li>
                            <li><i class="bi bi-check text-success"></i> Аватар загружается отдельно</li>
                        </ul>
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