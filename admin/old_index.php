<?php
// admin/index.php

// Проверка авторизации (временно отключаем для разработки)
global $db, $appUrl;
session_start();
// if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
//     header('Location: /login');
//     exit;
// }

// Подключаем header (проверяем правильный путь)
if (file_exists(__DIR__ . '/pageConstract/header.php')) {
    include('pageConstract/header.php');
} else {
    // Если файла нет - пробуем другой путь
    include('../public/header.php');
}

// Получаем список детей (РАСКОММЕНТИРУЕМ!)
$kids = $db->get_all('kids');

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <a href="http://localhost:8888/?page=admin/add_new_kid" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                        <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                    </svg>
                </a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($kids && count($kids) > 0): ?>
                        <?php foreach ($kids as $post): ?>
                            <tr>
                                <th scope="row"><?= $post['id'] ?></th>
                                <td>

                                    <?php if ($post['is_active'] === 0): ?>
                                        <!-- Зеленая галочка - активен -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    <?php else: ?>
                                        <!-- Красный крестик - неактивен -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                        </svg>
                                    <?php endif; ?>

                                    <?= $post['name'] . ' ' . $post['last_name'] ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Кнопка Редактировать (карандаш) -->
                                        <a href="<?= $appUrl ?>/?page=admin/kid/edit&id=<?= $post['id'] ?>"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Редактировать">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a>

                                        <!-- Кнопка Аватар (человечек) -->
                                        <a href="<?= $appUrl ?>/?page=admin/kid/edit/avatar&id=<?= $post['id'] ?>"
                                           class="btn btn-sm btn-outline-info"
                                           title="Изменить аватар">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
                                            </svg>
                                        </a>

                                        <!-- Кнопка Удалить (корзина) -->
                                        <a href="kids/kid_delete.php?id=<?= $post['id'] ?>"
                                           onclick="return confirm('Вы точно хотите удалить запись <?= $post['name'] . ' ' . $post['last_name'] ?>')"
                                           class="btn btn-sm btn-outline-danger"
                                           title="Удалить">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Нет добавленных детей</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col-8 -->
            <div class="col-lg-4 col-12">
                <?php include('pageConstract/sidebar.php'); ?>
            </div>
            <!-- /.col-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php
// Подключаем footer
if (file_exists(__DIR__ . '/pageConstract/footer.php')) {
    include('pageConstract/footer.php');
} else {
    include('../public/footer.php');
}
?>