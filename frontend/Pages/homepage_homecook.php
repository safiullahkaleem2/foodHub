<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';
// Query to fetch data from the database
$query = "SELECT username FROM userdetails";
$statement = $connection->prepare($query);
$statement->execute();
$userdetails = $statement->fetchAll(PDO::FETCH_ASSOC);

// Return the first name as JSON
echo json_encode($userdetails);
