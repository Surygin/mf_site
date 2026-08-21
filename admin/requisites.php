<?php
// admin/requisites.php

global $appUrl, $db;
include(__DIR__ . '/pageConstract/header.php');

// Получаем данные реквизитов
$requisites = $db->get_one('requisites', 9);

// Проверяем, есть ли уведомление
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
?>

    <style>
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .form-control {
            font-size: 0.95rem;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-size: 0.85rem;
        }
    </style>

    <div class="container py-4">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/?page=admin"><i class="bi bi-house-door"></i> Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Реквизиты</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Карточка с формой -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-credit-card"></i> Реквизиты фонда
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Уведомление -->
                        <?php if (!empty($alert)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= htmlspecialchars($alert) ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= $appUrl ?>/?page=admin/requisite/update" method="POST">
                            <div class="row">
                                <!-- Левая колонка -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inn" class="form-label">ИНН</label>
                                        <input class="form-control" type="text" name="inn" id="inn"
                                               value="<?= htmlspecialchars($requisites['inn'] ?? '') ?>"
                                               placeholder="Введите ИНН">
                                    </div>

                                    <div class="mb-3">
                                        <label for="rs" class="form-label">Р/С</label>
                                        <input class="form-control" type="text" name="rs" id="rs"
                                               value="<?= htmlspecialchars($requisites['rs'] ?? '') ?>"
                                               placeholder="Введите расчетный счет">
                                    </div>

                                    <div class="mb-3">
                                        <label for="ks" class="form-label">К/С</label>
                                        <input class="form-control" type="text" name="ks" id="ks"
                                               value="<?= htmlspecialchars($requisites['ks'] ?? '') ?>"
                                               placeholder="Введите корреспондентский счет">
                                    </div>

                                    <div class="mb-3">
                                        <label for="kpp" class="form-label">КПП</label>
                                        <input class="form-control" type="text" name="kpp" id="kpp"
                                               value="<?= htmlspecialchars($requisites['kpp'] ?? '') ?>"
                                               placeholder="Введите КПП">
                                    </div>

                                    <div class="mb-3">
                                        <label for="bik" class="form-label">БИК</label>
                                        <input class="form-control" type="text" name="bik" id="bik"
                                               value="<?= htmlspecialchars($requisites['bik'] ?? '') ?>"
                                               placeholder="Введите БИК">
                                    </div>
                                </div>

                                <!-- Правая колонка -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ogrn" class="form-label">ОГРН</label>
                                        <input class="form-control" type="text" name="ogrn" id="ogrn"
                                               value="<?= htmlspecialchars($requisites['ogrn'] ?? '') ?>"
                                               placeholder="Введите ОГРН">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient" class="form-label">Получатель</label>
                                        <input class="form-control" type="text" name="recipient" id="recipient"
                                               value="<?= htmlspecialchars($requisites['recipient'] ?? '') ?>"
                                               placeholder="Введите получателя">
                                    </div>

                                    <div class="mb-3">
                                        <label for="bank" class="form-label">Банк</label>
                                        <input class="form-control" type="text" name="bank" id="bank"
                                               value="<?= htmlspecialchars($requisites['bank'] ?? '') ?>"
                                               placeholder="Введите название банка">
                                    </div>

                                    <!-- Дополнительное поле для адреса, если есть -->
                                    <?php if (isset($requisites['address'])): ?>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Адрес</label>
                                            <input class="form-control" type="text" name="address" id="address"
                                                   value="<?= htmlspecialchars($requisites['address'] ?? '') ?>"
                                                   placeholder="Введите адрес">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Кнопки -->
                            <div class="d-flex gap-2 justify-content-between flex-wrap mt-3">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-check-lg"></i> Сохранить изменения
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
            <div class="col-12 col-lg-4">
                <!-- Информационная карточка -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-info-circle"></i> Информация
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>ID:</strong> <?= $requisites['id'] ?? '—' ?></p>
                        <p class="mb-0"><strong>Последнее обновление:</strong>
                            <?= isset($requisites['updated_at']) ? date('d.m.Y H:i', strtotime($requisites['updated_at'])) : '—' ?>
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
                            <li><i class="bi bi-check text-success"></i> Все поля опциональны</li>
                            <li><i class="bi bi-check text-success"></i> Данные сохраняются в БД</li>
                            <li><i class="bi bi-check text-success"></i> Реквизиты отображаются на сайте</li>
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
        // Автоформатирование для номеров счетов
        document.querySelectorAll('input[name="inn"], input[name="rs"], input[name="ks"], input[name="kpp"], input[name="bik"], input[name="ogrn"]').forEach(function(input) {
            input.addEventListener('input', function() {
                // Удаляем все нецифровые символы
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>

<?php
if (file_exists(__DIR__ . '/pageConstract/footer.php')) {
    include(__DIR__ . '/pageConstract/footer.php');
} elseif (file_exists(__DIR__ . '/../public/footer.php')) {
    include(__DIR__ . '/../public/footer.php');
} else {
    echo '</body></html>';
}
?>