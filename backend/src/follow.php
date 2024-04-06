<?php
require_once __DIR__ . '/../scripts/databaseconnection.php'; 

session_start();

// Check if the user is logged in and the follow button was pressed
if (isset($_SESSION['userid'], $_POST['follow'], $_SESSION['followid'])) {
    $followerId = (int) $_SESSION['userid'];
$followedId = (int) $_SESSION['followid'];

    var_dump($followedId);
    var_dump($followerId);
    // Attempt to insert the follow relationship
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
        // Success feedback
        $_SESSION['message'] = "Successfully followed.";
        if ($_SESSION['userType'] === 'HomeCook') {
            header("Location: /frontend/Pages/homepage_homecook.php");
            exit();
        } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
            header("Location: /frontend/Pages/homepage_professionalcook.php");
            exit();
        } else {
            echo "console.log('User type not determined.');"; // You can handle this case as needed
        }
    } catch (PDOException $e) {
        // Error feedback
        $_SESSION['message'] = "Follow operation failed: " . $e->getMessage();
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}


// exit;

