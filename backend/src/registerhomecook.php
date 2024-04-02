<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    $favouriteCuisine = $_POST['favouriteCuisine'];
    $age = $_POST['Age'];

    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/idgenerator.php';


    try {

        $sql = "INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password) VALUES (0,0,:age,:username, :password)";
        $stmt = $connection->prepare($sql);


        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':age', $age);


        $stmt->execute();

        $id = generateID($connection);
        $sql = "INSERT INTO AppUser (Username, Password, UserID) VALUES (:username, :password,:UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':UserID', $id);
        $stmt->execute();
        $sql = "INSERT INTO HomeCook (FavouriteCuisine, HobbyistLevel, UserID) VALUES (:favouriteCuisine,'Amateur',:UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':favouriteCuisine', $favouriteCuisine);
        $stmt->bindParam(':UserID', $id);
        $stmt->execute();


        header('Location: /frontend/Pages/loginpage.html');

        exit;
    } catch (PDOException $e) {
        // Handle your error
        die("Error: " . $e->getMessage());
    }
} else {
    // Not a POST request, redirect to the form or display an error
    echo "Error: Form was not submitted correctly.";
}
?>
