<?php

Dotenv\Dotenv::createImmutable(__DIR__)->load();

return [
    'db' => [
        'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
        'user' => getenv('DB_USERNAME'),
        'pass' => getenv('DB_PASSWORD')
    ]
];
