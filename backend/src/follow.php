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

        $username = $_SESSION['userid'];
        // Increase the number of followings for the follower
        $updateFollowing = $connection->prepare("UPDATE userdetails SET numberoffollowing = numberoffollowing + 1 WHERE username = :username");
        $updateFollowing->bindParam(':username', $username);
        $updateFollowing->execute();

        $updateFollowers = $connection->prepare("UPDATE userdetails
        SET numberoffollowers = numberoffollowers + 1
        WHERE username IN (SELECT username FROM AppUser WHERE userid = :followedid)");
        $updateFollowers->bindParam(':followedId', $followedId);
        $updateFollowers->execute();

        // Success feedback
        $_SESSION['message'] = "Successfully followed.";
    } catch (PDOException $e) {
        // Error feedback
        $_SESSION['message'] = "Follow operation failed: " . $e->getMessage();
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}


exit;
?>
