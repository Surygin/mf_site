<?php
// admin/index.php

global $db, $appUrl;
session_start();

// Подключаем header
if (file_exists(__DIR__ . '/pageConstract/header.php')) {
    include('pageConstract/header.php');
} else {
    include('../public/header.php');
}

// Получаем список детей
$kids = $db->get_all('kids');
?>

    <style>
        /* ===== ОБЩИЕ СТИЛИ ===== */
        :root {
            --accent-color: #0d6efd;
            --accent-hover: #0b5ed7;
            --danger-color: #dc3545;
            --danger-hover: #b02a37;
            --gray-light: #f8f9fa;
            --gray-border: #dee2e6;
            --text-muted: #6c757d;
        }

        .btn-square {
            border-radius: 4px !important;
            padding: 0.35rem 0.75rem;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-square svg {
            width: 18px;
            height: 18px;
            vertical-align: middle;
        }

        .btn-square-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
        }
        .btn-square-sm svg {
            width: 16px;
            height: 16px;
        }

        /* ===== КНОПКИ ===== */
        .btn-accent {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }
        .btn-accent:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            color: #fff;
        }

        .btn-outline-accent {
            background-color: transparent;
            border-color: var(--accent-color);
            color: var(--accent-color);
        }
        .btn-outline-accent:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }

        .btn-danger-square {
            background-color: transparent;
            border-color: var(--danger-color);
            color: var(--danger-color);
            border-radius: 4px !important;
        }
        .btn-danger-square:hover {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
            color: #fff;
        }

        .btn-success-square {
            background-color: #198754;
            border-color: #198754;
            color: #fff;
            border-radius: 4px !important;
        }
        .btn-success-square:hover {
            background-color: #157347;
            border-color: #157347;
            color: #fff;
        }

        .btn-outline-secondary-square {
            background-color: transparent;
            border-color: var(--gray-border);
            color: var(--text-muted);
            border-radius: 4px !important;
        }
        .btn-outline-secondary-square:hover {
            background-color: var(--gray-light);
            border-color: #c1c9d0;
            color: #212529;
        }

        /* ===== БЕЙДЖИ ===== */
        .badge-square {
            border-radius: 4px !important;
            padding: 0.3rem 0.8rem;
            font-weight: 500;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-square svg {
            width: 12px;
            height: 12px;
        }

        .badge-active {
            background-color: var(--accent-color);
            color: #fff;
        }
        .badge-inactive {
            background-color: var(--gray-border);
            color: var(--text-muted);
        }

        /* ===== ТАБЛИЦА ===== */
        .table thead th {
            background: var(--gray-light);
            border-bottom: 2px solid var(--gray-border);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0.75rem 0.5rem;
        }

        .table tbody td {
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-border);
        }

        .table tbody tr:hover {
            background-color: var(--gray-light);
        }

        .kid-name {
            font-weight: 500;
            color: #212529;
        }

        .table-actions {
            white-space: nowrap;
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .table-actions .btn {
            border-radius: 4px !important;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        .table-actions .btn svg {
            width: 16px;
            height: 16px;
            display: block;
        }

        /* ===== ЗАГОЛОВОК ===== */
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        .header-actions h2 {
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
            color: #212529;
        }
        .header-actions h2 .badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            background-color: var(--gray-border);
            color: var(--text-muted);
            font-weight: 500;
        }

        .table-container {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--gray-border);
        }

        /* ===== АВАТАР ===== */
        .avatar-thumb {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--gray-border);
            background: var(--gray-light);
        }
        .avatar-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 4px;
            background: var(--gray-light);
            border: 1px solid var(--gray-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 16px;
        }

        /* ===== МОБИЛЬНЫЕ ===== */
        @media (max-width: 767.98px) {
            .table-actions .btn svg {
                width: 14px;
                height: 14px;
            }
            .table-actions .btn {
                padding: 0.2rem 0.4rem;
            }
            .header-actions h2 {
                font-size: 1.2rem;
            }
            .avatar-thumb,
            .avatar-placeholder {
                width: 30px;
                height: 30px;
            }
        }
    </style>

    <div class="container py-4">
        <!-- Заголовок -->
        <div class="header-actions">
            <h2>
                <i class="bi bi-people-fill" style="color: var(--accent-color);"></i> Дети
                <span class="badge"><?= count($kids) ?></span>
            </h2>
            <a href="<?= $appUrl ?>/?page=admin/add_new_kid" class="btn btn-success-square btn-square">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" width="18" height="18">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                </svg>
                Добавить
            </a>
        </div>

        <!-- Таблица -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Имя</th>
                        <th class="d-none d-lg-table-cell" style="width: 130px;">Статус</th>
                        <th class="d-none d-lg-table-cell" style="width: 150px;">Собрано</th>
                        <th class="d-none d-lg-table-cell" style="width: 150px;">Нужно</th>
                        <th style="width: 140px; text-align: center;">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($kids && count($kids) > 0): ?>
                        <?php foreach ($kids as $post): ?>
                            <tr>
                                <td class="text-center" style="color: var(--text-muted);"><?= $post['id'] ?></td>
                                <td class="kid-name"><?= htmlspecialchars($post['name'] . ' ' . $post['last_name']) ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <?php if ($post['is_active'] == 1): ?>
                                        <span class="badge-square badge-active">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                            Активен
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-square badge-inactive">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                            Закрыт
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-none d-lg-table-cell" style="color: var(--text-muted);"><?= number_format($post['sum1'], 0, '', ' ') ?> ₽</td>
                                <td class="d-none d-lg-table-cell" style="color: var(--text-muted);"><?= number_format($post['sum2'], 0, '', ' ') ?> ₽</td>
                                <td>
                                    <div class="table-actions">
                                        <!-- Редактировать -->
                                        <a href="<?= $appUrl ?>/?page=admin/kid/edit&id=<?= $post['id'] ?>"
                                           class="btn btn-outline-accent btn-square-sm"
                                           title="Редактировать">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>

                                        <!-- Аватар -->
                                        <a href="<?= $appUrl ?>/?page=admin/kid/edit/avatar&id=<?= $post['id'] ?>"
                                           class="btn btn-outline-accent btn-square-sm"
                                           title="Аватар">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
                                            </svg>
                                        </a>

                                        <!-- Удалить -->
                                        <a href="kids/kid_delete.php?id=<?= $post['id'] ?>"
                                           onclick="return confirm('Вы точно хотите удалить запись <?= $post['name'] . ' ' . $post['last_name'] ?>?')"
                                           class="btn btn-danger-square btn-square-sm"
                                           title="Удалить">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-people" style="font-size: 36px; color: var(--gray-border);"></i>
                                <h5 class="mt-3" style="color: var(--text-muted);">Нет добавленных детей</h5>
                                <p class="text-muted">Нажмите кнопку "Добавить" чтобы создать первую запись.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
// Подключаем footer
if (file_exists(__DIR__ . '/pageConstract/footer.php')) {
    include('pageConstract/footer.php');
} else {
    include('../public/footer.php');
}
?>