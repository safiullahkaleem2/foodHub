<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$port = '5432'; 

try {
    $connection = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $user, $password);
    $_SESSION['connection'] = $connection;
     
} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());
}
