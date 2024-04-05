<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../scripts/databaseconnection.php';

$statement = $connection->prepare("SELECT * FROM recipedetails");
$statement->execute();
$recipedetails = $statement->fetchAll(PDO::FETCH_ASSOC);

