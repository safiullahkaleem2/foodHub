<?php
require_once __DIR__ . '/../scripts/databaseconnection.php'; 

session_start();

if (isset($_SESSION['userid'], $_POST['follow'], $_SESSION['followid'])) {
    $followerId = (int) $_SESSION['userid'];
    $followedId = (int) $_SESSION['followid'];

    $stmt = $connection->prepare("INSERT INTO Follows (userid1, userid2) VALUES (:followerId, :followedId)");
    $stmt->bindParam(':followerId', $followerId);
    $stmt->bindParam(':followedId', $followedId);

    try {
        $stmt->execute();

        $username = $_SESSION['username'];
        // Increase the number of followings for the follower
        $updateFollowing = $connection->prepare("UPDATE userdetails SET numberoffollowing = numberoffollowing + 1 WHERE username = :username");
        $updateFollowing->bindParam(':username', $username);
        $updateFollowing->execute();

        $updateFollowers = $connection->prepare("UPDATE userdetails
        SET numberoffollowers = numberoffollowers + 1
        WHERE username IN (SELECT username FROM appuser WHERE userid = $followedId)");
        $updateFollowers->execute();

        $_SESSION['message'] = "Successfully followed.";
        if ($_SESSION['userType'] === 'HomeCook') {
            header("Location: /frontend/Pages/homepage_homecook.php");
            exit();
        } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
            header("Location: /frontend/Pages/homepage_professionalcook.php");
            exit();
        } else {
            echo "console.log('User type not determined.');"; 
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Follow operation failed: " . $e->getMessage();
    }
    } else {
        $_SESSION['message'] = "Invalid request.";
    }



