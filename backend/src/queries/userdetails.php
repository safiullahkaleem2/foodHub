<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../scripts/databaseconnection.php';

<<<<<<< HEAD
$statementInsertRecipeDetails = $connection->prepare("SELECT * FROM userdetails");
$statementInsertRecipeDetails->execute();
$userdetails = $statementInsertRecipeDetails->fetchAll(PDO::FETCH_ASSOC);
=======
$statement = $connection->prepare("SELECT * 
                                   FROM userdetails u, professionalchef p, appuser a, professionalchefskill p2
                                   WHERE a.username = u.username 
                                   AND a.password = u.password 
                                   AND a.userid = p.userid 
                                   AND p2.restaurantaffiliation = p.RestaurantAffiliation 
                                   AND p2.restaurantlocation = p.restaurantlocation");
$statement->execute();
$userdetails = $statement->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> a808ebf47d2fde7a98a30cdedaa352566319253a

echo json_encode($userdetails);
