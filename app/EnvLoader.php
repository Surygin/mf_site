<?php
// EnvLoader.php - загрузчик переменных окружения

class EnvLoader
{
    private static $env = [];

    /**
     * Загружает .env файл
     */
    public static function load($path = null)
    {
        if (empty(self::$env)) {
            if ($path === null) {
                $path = __DIR__ . '/../.env';
            }

            if (!file_exists($path)) {
                throw new Exception(".env файл не найден по пути: $path");
            }

            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                // Пропускаем комментарии
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }

                // Разбираем строку KEY=VALUE
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);

                    // Убираем кавычки, если есть
                    $value = trim($value, '"\'');

                    self::$env[$key] = $value;
                }
            }
        }

        return self::$env;
    }

    /**
     * Получает значение переменной
     */
    public static function get($key, $default = null)
    {
        if (empty(self::$env)) {
            self::load();
        }

        return self::$env[$key] ?? $default;
    }

    /**
     * Получает все переменные
     */
    public static function all()
    {
        if (empty(self::$env)) {
            self::load();
        }

        return self::$env;
    }
}