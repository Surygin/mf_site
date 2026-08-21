<?php
// admin/kids/edit_avatar.php

global $appUrl, $db;

include(__DIR__ . '/../pageConstract/header.php');

$id = (int)($_GET['id'] ?? 0);
$kid = $db->get_one('kids', $id);

if (!$kid) {
    $_SESSION['alert'] = 'Ребенок не найден';
    header("Location: /?page=admin");
    exit;
}

$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$fullName = trim($kid['name'] . ' ' . $kid['last_name']);

$avatarPath = null;

if (
    !empty($kid['avatar']) &&
    file_exists(__DIR__ . '/../../public/' . $kid['avatar'])
) {
    $avatarPath = 'public/' . ltrim($kid['avatar'], '/');
}
?>

    <div class="container-fluid py-4">

        <!-- Заголовок -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">

            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="/?page=admin" class="text-decoration-none">
                                <i class="bi bi-house-door me-1"></i>
                                Дети
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a
                                href="/?page=admin/kid/edit&id=<?= $id ?>"
                                class="text-decoration-none"
                            >
                                <?= htmlspecialchars($fullName) ?>
                            </a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Аватар
                        </li>
                    </ol>
                </nav>

                <h1 class="h3 fw-semibold mb-1">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    Аватар ребёнка
                </h1>

                <p class="text-muted mb-0">
                    Загрузите фотографию для профиля <?= htmlspecialchars($kid['name']) ?>
                </p>
            </div>

            <a
                href="/?page=admin/kid/edit&id=<?= $id ?>"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Вернуться к профилю
            </a>

        </div>


        <!-- Уведомление -->
        <?php if (!empty($alert)): ?>

            <div
                class="alert alert-success alert-dismissible fade show shadow-sm"
                role="alert"
            >
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= htmlspecialchars($alert) ?>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Закрыть"
                ></button>
            </div>

        <?php endif; ?>


        <div class="row g-4">

            <!-- Левая колонка -->
            <div class="col-12 col-xl-5">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <div class="text-center">

                            <div class="mb-3">

                                <?php if ($avatarPath): ?>

                                    <img
                                        src="<?= htmlspecialchars($avatarPath) ?>"
                                        alt="<?= htmlspecialchars($fullName) ?>"
                                        id="avatarPreview"
                                        class="rounded-circle object-fit-cover shadow-sm"
                                        style="width: 240px; height: 240px;"
                                    >

                                <?php else: ?>

                                    <div
                                        id="avatarPlaceholder"
                                        class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                        style="width: 240px; height: 240px;"
                                    >
                                        <i class="bi bi-person text-secondary" style="font-size: 7rem;"></i>
                                    </div>

                                <?php endif; ?>

                            </div>


                            <h2 class="h4 fw-semibold mb-1">
                                <?= htmlspecialchars($fullName) ?>
                            </h2>

                            <div class="mb-3">

                                <?php if ((int)$kid['is_active'] === 1): ?>

                                    <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Активен
                                </span>

                                <?php else: ?>

                                    <span class="badge rounded-pill text-bg-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Закрыт
                                </span>

                                <?php endif; ?>

                            </div>


                            <div class="border-top pt-3 mt-3">

                                <div class="row text-start g-3">

                                    <div class="col-6">
                                        <div class="text-muted small">
                                            ID
                                        </div>

                                        <div class="fw-semibold">
                                            <?= (int)$kid['id'] ?>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="text-muted small">
                                            Статус
                                        </div>

                                        <div class="fw-semibold">
                                            <?= (int)$kid['is_active'] === 1 ? 'Активен' : 'Закрыт' ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Правая колонка -->
            <div class="col-12 col-xl-7">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-lg-5">

                        <div class="mb-4">

                            <h2 class="h5 fw-semibold mb-1">
                                Загрузить новый аватар
                            </h2>

                            <p class="text-muted mb-0">
                                Выберите изображение с компьютера или перетащите его в область ниже.
                            </p>

                        </div>


                        <form
                            action="<?= htmlspecialchars($appUrl) ?>/?page=admin/kid/update/avatar&id=<?= $id ?>"
                            method="POST"
                            enctype="multipart/form-data"
                            id="avatarForm"
                        >

                            <!-- Drop zone -->
                            <div
                                id="dropZone"
                                class="border border-2 border-secondary-subtle rounded-4 bg-light p-4 p-md-5 text-center"
                                role="button"
                                tabindex="0"
                            >

                                <div id="dropZoneContent">

                                    <div class="mb-3">

                                        <div
                                            class="rounded-circle bg-white shadow-sm d-inline-flex align-items-center justify-content-center"
                                            style="width: 72px; height: 72px;"
                                        >
                                            <i
                                                class="bi bi-cloud-arrow-up text-primary"
                                                style="font-size: 2rem;"
                                            ></i>
                                        </div>

                                    </div>


                                    <h3 class="h5 fw-semibold">
                                        Перетащите изображение сюда
                                    </h3>

                                    <p class="text-muted mb-3">
                                        или нажмите, чтобы выбрать файл
                                    </p>


                                    <button
                                        type="button"
                                        class="btn btn-outline-primary"
                                        id="selectFileBtn"
                                    >
                                        <i class="bi bi-folder2-open me-1"></i>
                                        Выбрать файл
                                    </button>


                                    <div class="small text-muted mt-3">
                                        JPG, PNG, GIF или WEBP
                                        <span class="mx-1">•</span>
                                        максимум 5 МБ
                                    </div>

                                </div>


                                <!-- Превью выбранного файла -->
                                <div
                                    id="newPreviewContainer"
                                    class="d-none"
                                >

                                    <img
                                        id="newAvatarPreview"
                                        src=""
                                        alt="Предпросмотр"
                                        class="rounded-circle object-fit-cover shadow-sm mb-3"
                                        style="width: 180px; height: 180px;"
                                    >

                                    <div class="fw-semibold" id="selectedFileName"></div>

                                    <div
                                        class="small text-muted mt-1"
                                        id="selectedFileSize"
                                    ></div>

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-secondary mt-3"
                                        id="changeFileBtn"
                                    >
                                        <i class="bi bi-arrow-repeat me-1"></i>
                                        Выбрать другой файл
                                    </button>

                                </div>


                                <input
                                    type="file"
                                    name="avatar"
                                    id="avatarInput"
                                    accept="image/jpeg,image/png,image/gif,image/webp"
                                    class="d-none"
                                >

                            </div>


                            <!-- Информация о файле -->
                            <div
                                id="fileError"
                                class="alert alert-danger d-none mt-3 mb-0"
                                role="alert"
                            >
                                <i class="bi bi-exclamation-circle me-2"></i>
                                <span id="fileErrorText"></span>
                            </div>


                            <!-- Подсказки -->
                            <div class="row g-3 mt-4">

                                <div class="col-12 col-md-4">

                                    <div class="d-flex gap-2">

                                        <i class="bi bi-image text-primary fs-5"></i>

                                        <div>
                                            <div class="fw-semibold small">
                                                Форматы
                                            </div>

                                            <div class="text-muted small">
                                                JPG, PNG, GIF, WEBP
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-12 col-md-4">

                                    <div class="d-flex gap-2">

                                        <i class="bi bi-file-earmark text-primary fs-5"></i>

                                        <div>
                                            <div class="fw-semibold small">
                                                Размер
                                            </div>

                                            <div class="text-muted small">
                                                До 5 МБ
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-12 col-md-4">

                                    <div class="d-flex gap-2">

                                        <i class="bi bi-aspect-ratio text-primary fs-5"></i>

                                        <div>
                                            <div class="fw-semibold small">
                                                Рекомендация
                                            </div>

                                            <div class="text-muted small">
                                                Квадратное изображение
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Кнопки -->
                            <div class="border-top mt-4 pt-4">

                                <div class="d-flex flex-column-reverse flex-sm-row justify-content-between gap-2">

                                    <a
                                        href="/?page=admin/kid/edit&id=<?= $id ?>"
                                        class="btn btn-outline-secondary"
                                    >
                                        <i class="bi bi-x-lg me-1"></i>
                                        Отмена
                                    </a>


                                    <button
                                        type="submit"
                                        class="btn btn-primary px-4"
                                        id="submitBtn"
                                        disabled
                                    >
                                        <i class="bi bi-cloud-arrow-up me-1"></i>
                                        Загрузить аватар
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('avatarInput');

            const selectFileBtn = document.getElementById('selectFileBtn');
            const changeFileBtn = document.getElementById('changeFileBtn');

            const submitBtn = document.getElementById('submitBtn');

            const dropZoneContent = document.getElementById('dropZoneContent');
            const newPreviewContainer = document.getElementById('newPreviewContainer');

            const newAvatarPreview = document.getElementById('newAvatarPreview');

            const selectedFileName = document.getElementById('selectedFileName');
            const selectedFileSize = document.getElementById('selectedFileSize');

            const fileError = document.getElementById('fileError');
            const fileErrorText = document.getElementById('fileErrorText');

            const maxFileSize = 5 * 1024 * 1024;

            const validTypes = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp'
            ];


            function showError(message) {

                fileErrorText.textContent = message;
                fileError.classList.remove('d-none');

                submitBtn.disabled = true;
            }


            function hideError() {

                fileError.classList.add('d-none');
                fileErrorText.textContent = '';
            }


            function formatFileSize(bytes) {

                if (bytes < 1024) {
                    return bytes + ' Б';
                }

                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(1) + ' КБ';
                }

                return (bytes / (1024 * 1024)).toFixed(1) + ' МБ';
            }


            function openFileDialog() {
                fileInput.click();
            }


            function handleFile(file) {

                hideError();

                if (!file) {
                    return;
                }


                if (!validTypes.includes(file.type)) {

                    fileInput.value = '';

                    showError(
                        'Неподдерживаемый формат файла. Выберите JPG, PNG, GIF или WEBP.'
                    );

                    return;
                }


                if (file.size > maxFileSize) {

                    fileInput.value = '';

                    showError(
                        'Файл слишком большой. Максимальный размер — 5 МБ.'
                    );

                    return;
                }


                const reader = new FileReader();


                reader.onload = function (event) {

                    newAvatarPreview.src = event.target.result;

                    selectedFileName.textContent = file.name;

                    selectedFileSize.textContent =
                        formatFileSize(file.size);


                    dropZoneContent.classList.add('d-none');

                    newPreviewContainer.classList.remove('d-none');

                    submitBtn.disabled = false;

                    dropZone.classList.remove(
                        'border-secondary-subtle'
                    );

                    dropZone.classList.add(
                        'border-primary'
                    );

                };


                reader.readAsDataURL(file);
            }


            selectFileBtn.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    openFileDialog();

                }
            );


            changeFileBtn.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    openFileDialog();

                }
            );


            dropZone.addEventListener(
                'click',
                function () {

                    openFileDialog();

                }
            );


            dropZone.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Enter' ||
                        event.key === ' '
                    ) {

                        event.preventDefault();

                        openFileDialog();

                    }

                }
            );


            fileInput.addEventListener(
                'change',
                function () {

                    if (this.files.length > 0) {

                        handleFile(this.files[0]);

                    }

                }
            );


            dropZone.addEventListener(
                'dragover',
                function (event) {

                    event.preventDefault();

                    this.classList.remove(
                        'border-secondary-subtle'
                    );

                    this.classList.add(
                        'border-primary',
                        'bg-primary-subtle'
                    );

                }
            );


            dropZone.addEventListener(
                'dragleave',
                function () {

                    this.classList.remove(
                        'border-primary',
                        'bg-primary-subtle'
                    );

                    this.classList.add(
                        'border-secondary-subtle'
                    );

                }
            );


            dropZone.addEventListener(
                'drop',
                function (event) {

                    event.preventDefault();

                    this.classList.remove(
                        'border-primary',
                        'bg-primary-subtle'
                    );

                    this.classList.add(
                        'border-secondary-subtle'
                    );


                    if (
                        event.dataTransfer.files &&
                        event.dataTransfer.files.length > 0
                    ) {

                        const file =
                            event.dataTransfer.files[0];

                        /*
                         * Используем DataTransfer, чтобы
                         * файл реально попал в input.
                         */
                        const dataTransfer = new DataTransfer();

                        dataTransfer.items.add(file);

                        fileInput.files =
                            dataTransfer.files;

                        handleFile(file);

                    }

                }
            );


            /*
             * Не позволяем браузеру открыть файл,
             * если его случайно бросили вне drop-zone.
             */
            document.addEventListener(
                'dragover',
                function (event) {

                    event.preventDefault();

                }
            );


            document.addEventListener(
                'drop',
                function (event) {

                    if (!dropZone.contains(event.target)) {

                        event.preventDefault();

                    }

                }
            );

        });
    </script>


<?php

if (file_exists(__DIR__ . '/../pageConstract/footer.php')) {

    include(__DIR__ . '/../pageConstract/footer.php');

} elseif (
    file_exists(__DIR__ . '/../../public/footer.php')
) {

    include(__DIR__ . '/../../public/footer.php');

} else {

    echo '</body></html>';

}

?>