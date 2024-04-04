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