<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../scripts/databaseconnection.php';

$statement = $connection->prepare("SELECT * FROM userdetails");
$statement->execute();
$userdetails = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($userdetails);
