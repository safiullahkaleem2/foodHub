<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../scripts/databaseconnection.php';

// Query to fetch data from the database
$statement = $connection->prepare("SELECT * FROM recipedetails");
$statement->execute();
$recipedetails = $statement->fetchAll(PDO::FETCH_ASSOC);

// Return the first name as JSON
echo json_encode($recipedetails);
