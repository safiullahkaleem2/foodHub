<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';

    $serving = trim($_POST['text']); 
    $culture = $_POST['culture']; 
    $_SESSION['show_title'] = isset($_POST['show_title']) ? 1 : 0;
    $_SESSION['show_publishdate'] = isset($_POST['show_publishdate']) ? 1 : 0;
    $_SESSION['show_description'] = isset($_POST['show_description']) ? 1 : 0;
    $_SESSION['show_culture'] = isset($_POST['show_culture']) ? 1 : 0;
    $_SESSION['show_difficulty'] = isset($_POST['show_difficulty']) ? 1 : 0;
    $_SESSION['show_serving'] = isset($_POST['show_serving']) ? 1 : 0;
    $_SESSION['show_estimatedtime'] = isset($_POST['show_estimatedtime']) ? 1 : 0;

    if ($culture === 'any') {
        // If culture is "any", prepare a query that does not restrict by culture
        $sql = "SELECT * FROM recipedetails r
                JOIN recipe r2 ON r2.title = r.title AND r2.publishdate = r.publishdate
                WHERE r.serving >= :serving";
    } else {
        // If a specific culture is selected, include the culture condition
        $sql = "SELECT *
                FROM recipedetails r, (
                     SELECT culture 
                     FROM recipedetails 
                     GROUP BY culture
                     HAVING culture = :culture AND MIN(serving) >= :serving
                     ) c, recipe r2
                WHERE c.culture = r.culture
                AND r2.title = r.title
                AND r2.publishdate = r.publishdate";
    }
    
    $checkStmt = $connection->prepare($sql);
    
    // Bind the :serving parameter in both cases
    $checkStmt->bindParam(':serving', $serving, PDO::PARAM_INT);
    
    // Bind the :culture parameter only if it's not "any"
    if ($culture !== 'any') {
        $checkStmt->bindParam(':culture', $culture, PDO::PARAM_STR);
    }
    
    $checkStmt->execute();
        // After executing your query
        $_SESSION['queryResults'] = $checkStmt->fetchAll(PDO::FETCH_ASSOC);
        
        header("Location: /frontend/Pages/filter.php");
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

