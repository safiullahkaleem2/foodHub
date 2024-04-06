<?php
session_start();
require_once __DIR__ . '/../../scripts/databaseconnection.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $recipeId = $_SESSION['recipeId']; // Ensure you have a hidden input in your form that sends this ID
    $editRecipeDescription = $_POST['edit-recipe-description'];
    $editDifficultyLevel = $_POST['edit-difficulty-level'];
    $editCulture = $_POST['edit-recipe-culture'];
    $editServings = $_POST['edit-recipe-servings'];
    $editEstimatedTime = $_POST['edit-estimated-time'];
    var_dump($_POST);

    $updateRecipeDetails = $connection->prepare("
    UPDATE RecipeDetails
    SET Description = :description, 
        Culture = :culture, 
        Difficulty = :difficulty, 
        Serving = :serving
    FROM Recipe 
    WHERE RecipeDetails.PublishDate = Recipe.PublishDate 
    AND RecipeDetails.Title = Recipe.Title 
    AND Recipe.RecipeID = :recipeId
");

$updateRecipeDetails->execute([
    ':description' => $editRecipeDescription,
    ':culture' => $editCulture,
    ':difficulty' => $editDifficultyLevel,
    ':serving' => $editServings,
    ':recipeId' => $recipeId
]);

        // Update Recipe for Estimated Time
        $updateRecipe = $connection->prepare("UPDATE Recipe SET EstimatedTime = :estimatedTime WHERE RecipeID = :recipeId");
        $updateRecipe->execute([
            ':estimatedTime' => $editEstimatedTime,
            ':recipeId' => $recipeId
        ]);

        // Redirect with a success message
        $_SESSION['message'] = 'Recipe updated successfully.';
        header('Location: /frontend/Pages/homepage_professionalcook.php');
      
    } 
 


