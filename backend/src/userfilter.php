<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';

    $age = $_POST['age'];
    $age2 = $_POST['age'];
    $age3 = $_POST['age'];

 // Find the amount of people for each age group for which the average number of followers of the
 // users who are > 'userinput' is higher than the average number of followers 
 // of all users across all age groups
    $checkStmt = $connection->prepare("SELECT u.age, COUNT(*)
                                  FROM userdetails u
                                  WHERE u.age >= :age 
                                  GROUP BY u.age
                                  HAVING AVG(numberoffollowers) >= (SELECT AVG(numberoffollowers) 
                                                                    FROM userdetails u2)");
    
    $checkStmt->bindParam(':age', $age, PDO::PARAM_INT);
    $checkStmt->execute();
    $_SESSION['UserQueryResults'] = $checkStmt->fetchAll(PDO::FETCH_ASSOC);


    // 'Find the number of users and their age that are equal to or above the user-inputted age';
    $checkStmt2 = $connection->prepare("SELECT u.age, COUNT(*)
                                  FROM userdetails u
                                  GROUP BY u.age
                                  HAVING MIN(u.age) >= :age2");
                                  
    $checkStmt2->bindParam(':age2', $age2, PDO::PARAM_INT);
    $checkStmt2->execute();
    $_SESSION['UserQueryResults2'] = $checkStmt2->fetchAll(PDO::FETCH_ASSOC);


    // Find the average number of followers and number of following user of an age group
    $checkStmt3 = $connection->prepare("SELECT u.age, AVG(u.numberoffollowers) AS numoffollowers, AVG(u.numberoffollowing) AS numoffollows
                                  FROM userdetails u
                                  WHERE u.age > :age3
                                  GROUP BY u.age");
   
    $checkStmt3->bindParam(':age3', $age3, PDO::PARAM_INT);
    $checkStmt3->execute();
    $_SESSION['UserQueryResults3'] = $checkStmt3->fetchAll(PDO::FETCH_ASSOC);

    header("Location: /frontend/Pages/filterusers.php");

    







}