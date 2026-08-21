<?php
// debug.php - полная диагностика
echo "<h1>Диагностика проекта</h1>";

// 1. Определяем пути
echo "<h2>1. Пути:</h2>";
$paths = [
    '__DIR__' => __DIR__,
    'dirname(__DIR__)' => dirname(__DIR__),
    'dirname(__DIR__, 2)' => dirname(__DIR__, 2),
    'dirname(__DIR__, 3)' => dirname(__DIR__, 3),
    '$_SERVER[DOCUMENT_ROOT]' => $_SERVER['DOCUMENT_ROOT'] ?? 'не определен',
];

foreach ($paths as $name => $path) {
    echo "$name: $path<br>";
}

// 2. Проверяем структуру
echo "<h2>2. Структура проекта:</h2>";
$checkPaths = [
    'vendor/autoload.php' => dirname(__DIR__, 1) . '/vendor/autoload.php',
    'vendor/autoload.php (2 levels)' => dirname(__DIR__, 2) . '/vendor/autoload.php',
    'src/Core/EnvLoader.php' => dirname(__DIR__, 1) . '/src/Core/EnvLoader.php',
    'src/Core/EnvLoader.php (2 levels)' => dirname(__DIR__, 2) . '/src/Core/EnvLoader.php',
    '.env' => dirname(__DIR__, 1) . '/.env',
    '.env (2 levels)' => dirname(__DIR__, 2) . '/.env',
    'composer.json' => dirname(__DIR__, 1) . '/composer.json',
    'composer.json (2 levels)' => dirname(__DIR__, 2) . '/composer.json',
];

foreach ($checkPaths as $name => $path) {
    if (file_exists($path)) {
        echo "✅ $name: $path<br>";
    } else {
        echo "❌ $name НЕ НАЙДЕН: $path<br>";
    }
}

// 3. Проверка PHP расширений
echo "<h2>3. Расширения:</h2>";
$extensions = ['pdo', 'pdo_mysql', 'json', 'mbstring'];
foreach ($extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✅ $ext<br>";
    } else {
        echo "❌ $ext<br>";
    }
}

// 4. Проверка классов
echo "<h2>4. Классы:</h2>";
if (class_exists('App\Core\EnvLoader')) {
    echo "✅ EnvLoader найден<br>";
} else {
    echo "❌ EnvLoader НЕ найден<br>";
}

// 5. Содержимое .env (без паролей)
echo "<h2>5. Переменные .env:</h2>";
$envPath = dirname(__DIR__, 1) . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            if (strpos($key, 'PASS') === false) {
                echo "$key = $value<br>";
            } else {
                echo "$key = ******<br>";
            }
        }
    }
} else {
    echo "❌ .env файл не найден<br>";
}