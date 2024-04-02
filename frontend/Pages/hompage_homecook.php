<?php

require_once('../backend/index.php');

// Query to fetch data from the database
$query = "SELECT * FROM userdetails";
$statement = $connection->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_BOTH);

// Return the data as JSON
echo json_encode($users);
