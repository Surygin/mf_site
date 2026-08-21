<?php
// admin/kids/edit_avatar.php

global $appUrl, $db;
include(__DIR__ . '/../pageConstract/header.php');

$id = (int)$_GET['id'];
$kid = $db->get_one('kids', $id);

if (!$kid) {
    $_SESSION['alert'] = 'Ребенок не найден';
    header("Location: /?page=admin");
    exit;
}

$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
?>

    <style>
        .avatar-preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #dee2e6;
            background: #f8f9fa;
            transition: transform 0.3s ease;
        }
        .avatar-preview:hover {
            transform: scale(1.05);
        }
        .avatar-placeholder {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px dashed #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #adb5bd;
            background: #f8f9fa;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .drop-zone {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        .drop-zone:hover {
            border-color: #86b7fe;
            background: #e9ecef;
        }
        .drop-zone.dragover {
            border-color: #198754;
            background: #d1e7dd;
        }
        .file-info {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 10px;
        }
        .file-info strong {
            color: #212529;
        }
    </style>

    <div class="container py-4">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/?page=admin"><i class="bi bi-house-door"></i> Главная</a></li>
                <li class="breadcrumb-item"><a href="/?page=admin">Дети</a></li>
                <li class="breadcrumb-item active" aria-current="page">Аватар: <?= htmlspecialchars($kid['name']) ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- Карточка с формой -->
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-person-badge"></i> Аватар: <?= htmlspecialchars($kid['name'] . ' ' . $kid['last_name']) ?>
                        </h4>
                    </div>
                    <div class="card-body text-center">
                        <!-- Уведомление -->
                        <?php if (!empty($alert)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= htmlspecialchars($alert) ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Текущий аватар -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Текущий аватар</h6>
                            <?php if (!empty($kid['avatar']) && file_exists(__DIR__ . '/../../public/' . $kid['avatar'])): ?>
                                <img class="avatar-preview" src="public/<?= $kid['avatar'] ?>" alt="<?= $kid['name'] ?>">
                            <?php else: ?>
                                <div class="avatar-placeholder mx-auto">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <!-- Форма загрузки -->
                        <form action="<?= $appUrl ?>/?page=admin/kid/update/avatar&id=<?= $id ?>" method="POST" enctype="multipart/form-data" id="avatarForm">

                            <div class="drop-zone" id="dropZone">
                                <i class="bi bi-cloud-upload" style="font-size: 48px; color: #6c757d;"></i>
                                <p class="mt-2 mb-0"><strong>Нажмите или перетащите</strong></p>
                                <p class="text-muted small">Поддерживаемые форматы: JPG, PNG, GIF, WEBP (до 5 МБ)</p>
                                <input class="form-control" type="file" name="avatar" id="avatarInput"
                                       accept="image/*" style="display: none;">
                            </div>

                            <div class="file-info mt-2" id="fileInfo" style="display: none;">
                                Выбран файл: <strong id="fileName"></strong>
                                <span id="fileSize" class="text-muted"></span>
                            </div>

                            <div class="d-flex gap-2 justify-content-between flex-wrap mt-4">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg" id="submitBtn" disabled>
                                        <i class="bi bi-upload"></i> Загрузить аватар
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
                        <p class="mb-1"><strong>ID:</strong> <?= $kid['id'] ?></p>
                        <p class="mb-1"><strong>Имя:</strong> <?= htmlspecialchars($kid['name'] . ' ' . $kid['last_name']) ?></p>
                        <p class="mb-0"><strong>Текущий статус:</strong>
                            <span class="badge <?= $kid['is_active'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $kid['is_active'] == 1 ? 'Активен' : 'Закрыт' ?>
                        </span>
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
                            <li><i class="bi bi-check text-success"></i> Рекомендуемый размер: 200x200 px</li>
                            <li><i class="bi bi-check text-success"></i> Максимальный размер: 5 МБ</li>
                            <li><i class="bi bi-check text-success"></i> Форматы: JPG, PNG, GIF, WEBP</li>
                            <li><i class="bi bi-check text-success"></i> Аватар обрезается до квадрата</li>
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
        // Drag and Drop
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('avatarInput');
        const submitBtn = document.getElementById('submitBtn');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

        // Клик по зоне для выбора файла
        dropZone.addEventListener('click', function() {
            fileInput.click();
        });

        // Drag and Drop события
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');

            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(e.dataTransfer.files[0]);
            }
        });

        // Выбор файла через input
        fileInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFileSelect(this.files[0]);
            }
        });

        // Обработка выбранного файла
        function handleFileSelect(file) {
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const maxSize = 5 * 1024 * 1024; // 5 MB

            if (!validTypes.includes(file.type)) {
                alert('Пожалуйста, выберите изображение (JPG, PNG, GIF или WEBP)');
                fileInput.value = '';
                submitBtn.disabled = true;
                fileInfo.style.display = 'none';
                return;
            }

            if (file.size > maxSize) {
                alert('Файл слишком большой. Максимальный размер: 5 МБ');
                fileInput.value = '';
                submitBtn.disabled = true;
                fileInfo.style.display = 'none';
                return;
            }

            // Отображаем информацию о файле
            fileName.textContent = file.name;
            let size = file.size;
            if (size < 1024) {
                fileSize.textContent = ' (' + size + ' B)';
            } else if (size < 1024 * 1024) {
                fileSize.textContent = ' (' + (size / 1024).toFixed(1) + ' KB)';
            } else {
                fileSize.textContent = ' (' + (size / (1024 * 1024)).toFixed(1) + ' MB)';
            }
            fileInfo.style.display = 'block';
            submitBtn.disabled = false;
        }

        // Превью изображения перед загрузкой (опционально)
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(loadEvent) {
                    // Можно добавить превью, если нужно
                    // document.querySelector('.avatar-preview').src = loadEvent.target.result;
                }
                reader.readAsDataURL(this.files[0]);
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