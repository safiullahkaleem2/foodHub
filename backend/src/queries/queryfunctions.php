<?php
require_once __DIR__ . '/../../scripts/databaseconnection.php';

function createleaderboards($connection) {

// Declaration

global $globalarray, $nationalarray, $regionalarray; 

$globalarray = array();
$nationalarray = array();
$regionalarray = array();

// Global

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Global' AND  u.points >= ALL (select u2.points FROM userranking u2 WHERE u2.leaderboardcategory = 'Global')");
$queryvar->execute();
$globalarray[0]  = $queryvar->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Global' AND  u.position = 2");
$queryvar ->execute();
$globalarray[1]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Global' AND  u.position = 3");
$queryvar ->execute();
$globalarray[2]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Global' AND  u.position = 4");
$queryvar ->execute();
$globalarray[3]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Global' AND  u.position = 5");
$queryvar ->execute();
$globalarray[4]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

// National

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'National' AND  u.points >= ALL (select u2.points FROM userranking u2 WHERE u2.leaderboardcategory = 'National')");
$queryvar ->execute();
$nationalarray[0]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'National' AND  u.position = 2");
$queryvar ->execute();
$nationalarray[1]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'National' AND  u.position = 3");
$queryvar ->execute();
$nationalarray[2]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'National' AND  u.position = 4");
$queryvar ->execute();
$nationalarray[3]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'National' AND  u.position = 5");
$queryvar ->execute();
$nationalarray[4]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

// Regional

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Regional' AND  u.points >= ALL (select u2.points FROM userranking u2 WHERE u2.leaderboardcategory = 'Regional')");
$queryvar ->execute();
$regionalarray[0]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Regional' AND  u.position = 2");
$queryvar ->execute();
$regionalarray[1]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Regional' AND  u.position = 3");
$queryvar ->execute();
$regionalarray[2]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Regional' AND  u.position = 4");
$queryvar ->execute();
$regionalarray[3]  = $queryvar ->fetch(PDO::FETCH_ASSOC);

$queryvar = $connection->prepare("SELECT * FROM userranking u, appuser a 
WHERE a.userid = u.userid AND u.leaderboardcategory = 'Regional' AND  u.position = 5");
$queryvar ->execute();
$regionalarray[4]  = $queryvar ->fetch(PDO::FETCH_ASSOC);
}

function createprochefs($connection) {

global $prochefs;

$statement = $connection->prepare("SELECT * 
                                    FROM userdetails u, professionalchef p, appuser a, professionalchefskill p2
                                    WHERE a.username = u.username 
                                    AND a.password = u.password 
                                    AND a.userid = p.userid 
                                    AND p2.restaurantaffiliation = p.RestaurantAffiliation 
                                    AND p2.restaurantlocation = p.restaurantlocation");
$statement->execute();
$prochefs = $statement->fetchAll(PDO::FETCH_ASSOC);

}

function createevents($connection) {

global $events;  
    
$statement = $connection->prepare("SELECT * 
                                   FROM eventdetails e1, eventlocation e2 
                                   WHERE e1.category = e2.category AND e1.entryfee = e2.entryfee");
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);
}

function createrecipe($connection) {

global $recipe;

$statement = $connection->prepare("SELECT * FROM recipedetails");
$statement->execute();
$recipe = $statement->fetchAll(PDO::FETCH_ASSOC);
}