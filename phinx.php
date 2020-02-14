<?php

use Dotenv\Dotenv;

require_once './vendor/autoload.php';

// Instantiate the app
// Load .env file
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_PORT']);
}

// Database settings
$databaseSettings = [
    'name' => 'production',
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'port' => getenv('DB_PORT'),
    'charset' => 'utf8'
];

$dsn = sprintf(
    "mysql:host=%s;dbname=%s;port=%s;charset=%s",
    $databaseSettings['host'],
    $databaseSettings['database'],
    $databaseSettings['port'],
    $databaseSettings['charset']
);
$username = $databaseSettings['username'];
$password = $databaseSettings['password'];
$pdo = new PDO($dsn, $username, $password);

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'migration_base_class' => 'BaseMigration',
    'templates' => [
        'class' => 'TemplateGenerator',
    ],
    'aliases' => [
        'create' => 'CreateTableTemplateGenerator',
    ],

    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'development',
        'development' => [
            'name' => 'dev',
            'connection' => $pdo,
        ],
        'production' => $databaseSettings,
    ],
];