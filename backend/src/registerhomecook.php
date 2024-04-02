<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // User's plaintext password
    $favouriteCuisine = $_POST['favouriteCuisine'];
    $age = $_POST['Age'];

    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/idgenerator.php';

    try {
        $checkUserSql = "SELECT * FROM AppUser WHERE Username = :username";
        $checkStmt = $connection->prepare($checkUserSql);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();
        if ($checkStmt->fetch()) {
            echo "<script>alert('Username already exists.'); window.location.href='/frontend/Pages/mainRegistrationpage.html';</script>";
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password) VALUES (0,0,:age,:username, :password)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword); 
        $stmt->bindParam(':age', $age);
        $stmt->execute();

       
        $id = generateID($connection);

        $sql = "INSERT INTO AppUser (Username, Password, UserID) VALUES (:username, :password, :UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword); 
        $stmt->bindParam(':UserID', $id);
        $stmt->execute();


        $sql = "INSERT INTO HomeCook (FavouriteCuisine, HobbyistLevel, UserID) VALUES (:favouriteCuisine, 'Amateur', :UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':favouriteCuisine', $favouriteCuisine);
        $stmt->bindParam(':UserID', $id);
        $stmt->execute();

        echo "<script>alert('Registration successful. You will be redirected to the login page.'); window.location.href='/frontend/Pages/loginpage.html';</script>";
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "Error: Form was not submitted correctly.";
}
?>
