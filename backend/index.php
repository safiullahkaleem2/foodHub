<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once('./scripts/scripts.php');
require_once('./scripts/databaseconnection.php');

session_start();

try {
   
    createTables($connection);
    
    sampleData($connection);

    
    header('Location: /frontend/Pages/loginpage.html');
    exit();
     
} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());
}
