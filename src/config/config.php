<?php

use Dotenv\Dotenv;

// Carregar as variáveis de ambiente do arquivo .env
$dotenv = Dotenv::createImmutable( __DIR__ . '/../../');
$dotenv->load();

return [
    'db' => [
        'host' => $_ENV['MYSQL_HOST'],
        'dbname' => $_ENV['MYSQL_DATABASE'],
        'user' => $_ENV['MYSQL_USER'],
        'pass' => $_ENV['MYSQL_PASSWORD']
    ]
];
