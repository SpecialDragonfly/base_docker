<?php

use Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';

// Instantiate the app
// Load .env file
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_PORT']);
}

// Database settings
$databaseSettings = [
    'name' => 'production',
    'host' => getenv('DB_HOST'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'port' => getenv('DB_PORT'),
    'charset' => 'utf8'
];

$dsn = sprintf(
    "mysql:host=%s;port=%s;charset=%s",
    $databaseSettings['host'],
    $databaseSettings['port'],
    $databaseSettings['charset']
);
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

$pdo = new PDO($dsn, $username, $password);
$pdo->exec("CREATE DATABASE IF NOT EXISTS ".getenv('DB_DATABASE'));