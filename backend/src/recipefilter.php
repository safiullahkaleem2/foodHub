<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php';
    require_once __DIR__ . '/queries/queryfunctions.php';
    if (isset($_POST['search_button'])) {
    
        if (isset($_POST['text'])) {

    $serving = trim($_POST['text']); 
    $culture = $_POST['culture']; 
    
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
        
        header("Location: /frontend/Pages/filterecipes.php");
    }

}




    if (isset($_POST['project_query_button'])) {

        $selectedColumns = [];
        $columnMap = [
        'show_title' => 'r.title',
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

        
        header("Location: /frontend/Pages/filterecipes.php");


    }

    if (isset($_POST['dynamic_condition_search'])) {

        if (isset($_POST['dynamic_condition_search'])) {
            $conditions = $_POST['conditions'] ?? [];
            $sqlConditions = [];
            $params = [];
        

            foreach ($conditions as $index => $condition) {

                $field = $condition['field'];

                $tableAlias = 'r'; 
                if (in_array($field, ['publishdate', 'estimatedtime'])) { 
                    $tableAlias = 'r2';
                }
                $fieldWithAlias = "$tableAlias.$field";
        
                $value = $condition['value'];
                $logic = $index > 0 ? $condition['logic'] : ''; 
        
                $sqlConditions[] = "$logic $fieldWithAlias = :value$index";
                $params[":value$index"] = $value;
            }
        
            $sqlConditionStr = implode(' ', $sqlConditions);
            $sql = "SELECT * FROM RecipeDetails r JOIN Recipe r2 ON r2.title = r.title AND r2.publishdate = r.publishdate WHERE $sqlConditionStr";
        

                $stmt = $connection->prepare($sql);
            
                foreach ($params as $param => $value) {
                    $stmt->bindValue($param, $value);
                }
                $stmt->execute();

                $_SESSION['queryResults'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                header("Location: /frontend/Pages/filterecipes.php");
                

            }

    }

}




