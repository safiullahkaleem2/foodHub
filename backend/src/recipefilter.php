<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';
    if (isset($_POST['search_button'])) {

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

        $sql = "SELECT * FROM recipedetails r
                JOIN recipe r2 ON r2.title = r.title AND r2.publishdate = r.publishdate
                WHERE r.serving >= :serving";
    } else {

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
    

    $checkStmt->bindParam(':serving', $serving, PDO::PARAM_INT);
    

    if ($culture !== 'any') {
        $checkStmt->bindParam(':culture', $culture, PDO::PARAM_STR);
    }
    
    $checkStmt->execute();
        $_SESSION['queryResults'] = $checkStmt->fetchAll(PDO::FETCH_ASSOC);
        
<<<<<<< HEAD
        header("Location: /frontend/Pages/filter.php");
    }


    if (isset($_POST['project_query_button'])) {

        $selectedColumns = [];
        $columnMap = [
    '   show_title' => 'r.title',
        'show_publishdate' => 'r.publishdate',
        'show_description' => 'r.description',
        'show_culture' => 'r.culture',
        'show_difficulty' => 'r.difficulty',
        'show_serving' => 'r.serving',
        'show_estimatedtime' => 'r2.estimatedtime',
        ];


        foreach ($columnMap as $checkboxName => $columnName) {
            if (isset($_POST[$checkboxName]) && $_POST[$checkboxName] == 'true') {
                $selectedColumns[] = $columnName;
            }
        }

        $selectedColumnsString = implode(', ', $selectedColumns);

        $sql = "SELECT $selectedColumnsString FROM RecipeDetails r JOIN Recipe r2 ON r2.title = r.title AND r2.publishdate = r.publishdate";
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $_SESSION['selectionresults'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

=======
        header("Location: /frontend/Pages/filterecipes.php");
        // exit();
>>>>>>> ba020772818499d573847e1d631621280a6ee7ab
        
        header("Location: /frontend/Pages/filter.php");



    }

}

