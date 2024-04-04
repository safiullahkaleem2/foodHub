<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../scripts/databaseconnection.php';

$statement = $connection->prepare("SELECT * 
                                   FROM userdetails u, professionalchef p, appuser a, professionalchefskill p2
                                   WHERE a.username = u.username 
                                   AND a.password = u.password 
                                   AND a.userid = p.userid 
                                   AND p2.restaurantaffiliation = p.RestaurantAffiliation 
                                   AND p2.restaurantlocation = p.restaurantlocation");
$statement->execute();
$userdetails = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($userdetails);
