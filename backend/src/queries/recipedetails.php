<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../scripts/databaseconnection.php';


    $sql = "SELECT Recipe.*, RecipeDetails.*
            FROM Recipe
            JOIN RecipeDetails ON Recipe.PublishDate = RecipeDetails.PublishDate AND Recipe.Title = RecipeDetails.Title";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    

    $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);


 
