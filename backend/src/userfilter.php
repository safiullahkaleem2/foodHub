<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';

    $age = $_POST['age'];

 // Find the amount of people for each age group for which the average number of followers of the
// users who are > 'userinput' is higher than the average number of followers 
// of all users across all age groups
    $checkStmt = $connection->prepare("SELECT u.age, COUNT(*)
                                  FROM userdetails u
                                  WHERE u.age >= :age 
                                  GROUP BY u.age
                                  HAVING AVG(numberoffollowers) >= (SELECT AVG(numberoffollowers) 
                                                                    FROM userdetails u2)");
    
    // Bind the :serving parameter in both cases
    $checkStmt->bindParam(':age', $age, PDO::PARAM_INT);
    $checkStmt->execute();
    $_SESSION['UserQueryResults'] = $checkStmt->fetchAll(PDO::FETCH_ASSOC);

    // echo json_encode($checkStmt);
    header("Location: /frontend/Pages/filterusers.php");

    







}