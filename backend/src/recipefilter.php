<?php

$recipe2 = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';

    $serving = trim($_POST['text']); 
    $culture = $_POST['culture']; 


        $checkStmt = $connection->prepare("SELECT *
                                           FROM recipedetails r, (SELECT culture 
                                           FROM recipedetails 
                                           GROUP BY culture
                                           HAVING culture = :culture
                                           AND MIN(serving) >= :serving) c 
                                           WHERE c.culture = r.culture");

        $checkStmt->bindParam(':culture', $culture, PDO::PARAM_STR);
        $checkStmt->bindParam(':serving', $serving, PDO::PARAM_INT);
        $checkStmt->execute();

        $recipe[0] = $checkStmt->fetch(PDO::FETCH_ASSOC);
        print_r($recipe[0]);

        header("Location: /frontend/Pages/homepage_homecook.php");
        // exit();
        
        // if ($isHomeCook) {
        //     $_SESSION['userType'] = 'HomeCook';
        //     header("Location: /frontend/Pages/homepage_homecook.php");
        //     exit();
        // } elseif ($isProChef) {
        //     $_SESSION['userType'] = 'ProfessionalChef';
        //     header("Location: /frontend/Pages/homepage_professionalcook.html");
        //     exit();
        // } else {
        //     echo "User type not determined.";
        // }
}

