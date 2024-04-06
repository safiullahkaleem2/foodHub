<?php
require_once __DIR__ . '/../scripts/databaseconnection.php'; 

session_start();


    $followerId =  $_SESSION['userid'];
    $followedId =  $_GET['eventid'];

    $stmt = $connection->prepare("INSERT INTO Participates (UserID, EventID) VALUES (:followerId, :followedId)");
    $stmt->bindParam(':followerId', $followerId);
    $stmt->bindParam(':followedId', $followedId);
    $stmt->execute();

    if ($_SESSION['userType'] === 'HomeCook') {
        header("Location: /frontend/Pages/homepage_homecook.php");
        exit();
    } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
        header("Location: /frontend/Pages/homepage_professionalcook.php");
        exit();
    } else {
        echo "console.log('User type not determined.');"; 
    }

