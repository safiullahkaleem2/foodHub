<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $age = $_POST['age'];
    $restaurantAffiliation = $_POST['restaurantAffiliation'];
    $restaurantLocation = $_POST['restaurantLocation'];
    $certification = $_POST['certification'];

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


        $sql = "SELECT COUNT(*) FROM ProfessionalChefSkill WHERE RestaurantAffiliation = :affiliation AND RestaurantLocation = :location AND Certification = :certification";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':affiliation' => $restaurantAffiliation, ':location' => $restaurantLocation, ':certification' => $certification]);
        
        if ($stmt->fetchColumn() > 0) {

            echo "<script>alert('A certification for this location and affiliation already exists.'); window.location.href='/frontend/Pages/mainRegistrationpage.html';</script>";
            exit;
        } 


        $sql = "INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password) VALUES (0,0,:age,:username, :password)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':age', $age);
        $stmt->execute();

       
        $id = generateID($connection);

        $sql = "INSERT INTO AppUser (Username, Password, UserID) VALUES (:username, :password, :UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':UserID', $id);
        $stmt->execute();

        
        

        $sql ="INSERT INTO ProfessionalChefSkill (RestaurantAffiliation, RestaurantLocation, Certification) VALUES (:RestaurantAffiliation,:RestaurantLocation, :Certification)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':Certification', $certification);
        $stmt->bindParam(':RestaurantLocation', $restaurantLocation);
        $stmt->bindParam(':RestaurantAffiliation', $restaurantAffiliation);
        $stmt->execute();

        $sql ="INSERT INTO ProfessionalChef (RestaurantAffiliation, RestaurantLocation, UserID) VALUES (:RestaurantAffiliation,:RestaurantLocation, :UserID)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':UserID', $id);
        $stmt->bindParam(':RestaurantLocation', $restaurantLocation);
        $stmt->bindParam(':RestaurantAffiliation', $restaurantAffiliation);
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
