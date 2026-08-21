<?php
// admin/contacts.php

global $appUrl, $db;
include(__DIR__ . '/pageConstract/header.php');

// Получаем данные контактов
$contacts = $db->get_one('contacts', 4);

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

        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>

    <div class="container py-4">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/?page=admin"><i class="bi bi-house-door"></i> Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Контакты</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Карточка с формой -->
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-telephone"></i> Контакты фонда
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

                        <form action="<?= $appUrl ?>/?page=admin/contact/update" method="POST">
                            <div class="row">
                                <!-- Телефон -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">
                                            <i class="bi bi-phone"></i> Телефон <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control form-control-lg" type="tel" name="phone" id="phone"
                                               value="<?= htmlspecialchars($contacts['phone'] ?? '') ?>"
                                               placeholder="+7 (XXX) XXX-XX-XX" required>
                                        <div class="form-text">Формат: +7 (XXX) XXX-XX-XX</div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope"></i> E-mail <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control form-control-lg" type="email" name="email" id="email"
                                               value="<?= htmlspecialchars($contacts['email'] ?? '') ?>"
                                               placeholder="example@mail.ru" required>
                                        <div class="form-text">Введите корректный email адрес</div>
                                    </div>
                                </div>

                                <!-- Адрес -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="adress" class="form-label">
                                            <i class="bi bi-geo-alt"></i> Адрес
                                        </label>
                                        <input class="form-control form-control-lg" type="text" name="adress" id="adress"
                                               value="<?= htmlspecialchars($contacts['adress'] ?? '') ?>"
                                               placeholder="г. Москва, ул. Примерная, д. 1">
                                        <div class="form-text">Юридический или фактический адрес</div>
                                    </div>
                                </div>

                                <!-- Дополнительные поля (если есть в БД) -->
                                <?php if (isset($contacts['social_vk']) || isset($contacts['social_tg'])): ?>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3"><i class="bi bi-share"></i> Социальные сети</h6>
                                    </div>

                                    <?php if (isset($contacts['social_vk'])): ?>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social_vk" class="form-label">
                                                    <i class="bi bi-vk"></i> VK
                                                </label>
                                                <input class="form-control" type="url" name="social_vk" id="social_vk"
                                                       value="<?= htmlspecialchars($contacts['social_vk'] ?? '') ?>"
                                                       placeholder="https://vk.com/...">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($contacts['social_tg'])): ?>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="social_tg" class="form-label">
                                                    <i class="bi bi-telegram"></i> Telegram
                                                </label>
                                                <input class="form-control" type="url" name="social_tg" id="social_tg"
                                                       value="<?= htmlspecialchars($contacts['social_tg'] ?? '') ?>"
                                                       placeholder="https://t.me/...">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
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
                        <p class="mb-1"><strong>ID:</strong> <?= $contacts['id'] ?? '—' ?></p>
                        <p class="mb-0"><strong>Последнее обновление:</strong>
                            <?= isset($contacts['updated_at']) ? date('d.m.Y H:i', strtotime($contacts['updated_at'])) : '—' ?>
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
                            <li><i class="bi bi-check text-success"></i> Телефон и email обязательны</li>
                            <li><i class="bi bi-check text-success"></i> Данные отображаются на сайте</li>
                            <li><i class="bi bi-check text-success"></i> Адрес можно не заполнять</li>
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
        // Маска для телефона (простая)
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            if (value.length > 0) {
                let formatted = '+7';
                if (value.length > 1) {
                    formatted += ' (' + value.slice(1, 4);
                }
                if (value.length > 4) {
                    formatted += ') ' + value.slice(4, 7);
                }
                if (value.length > 7) {
                    formatted += '-' + value.slice(7, 9);
                }
                if (value.length > 9) {
                    formatted += '-' + value.slice(9, 11);
                }
                this.value = formatted;
            }
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