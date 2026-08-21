<?php

declare(strict_types=1);

$pdo = new PDO(
    sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        EnvLoader::get('DB_HOST', 'localhost'),
        EnvLoader::get('DB_PORT', '3306'),
        EnvLoader::get('DB_NAME', ''),
        EnvLoader::get('DB_CHARSET', 'utf8mb4')
    ),
    EnvLoader::get('DB_USER', ''),
    EnvLoader::get('DB_PASS', ''),
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);