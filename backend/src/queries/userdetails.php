<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../scripts/databaseconnection.php';

$statementInsertRecipeDetails = $connection->prepare("SELECT * FROM userdetails");
$statementInsertRecipeDetails->execute();
$userdetails = $statementInsertRecipeDetails->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($userdetails);