<?php
// session_start();
require_once __DIR__ . '/../../scripts/databaseconnection.php';
require_once __DIR__ . '/../idgenerator.php';



var_dump($_POST);
$editRecipeTitle = $_POST['edit-recipe-title'];
echo $editRecipeTitle;
echo $editRecipePublishDate;
$editRecipeDescription = $_POST['edit-recipe-description'];
$editDifficultyLevel = $_POST['edit-difficulty-level'];
$editRatingLevel = $_POST['edit-rating-level'];
$editCulture = $_POST['edit-recipe-culture'];
$editServings = $_POST['edit-recipe-servings'];
$editEstimatedTime = $_POST['edit-estimated-time'];

// Update the recipeDetails

$updateQuery = $connection->prepare("
    UPDATE RecipeDetails
    SET Description = :newDescription,
        Culture = :newCulture,
        Difficulty = :newDifficulty,
        Serving = :newServing
    WHERE PublishDate = :publishDateValue AND Title = :titleValue
");

$updateQuery->bindParam(':newDescription', $editRecipeDescription);
$updateQuery->bindParam(':newCulture', $editCulture);
$updateQuery->bindParam(':newDifficulty', $editDifficultyLevel);
$updateQuery->bindParam(':newServing', $editServings);
$updateQuery->bindParam(':publishDateValue', $editRecipePublishDate);
$updateQuery->bindParam(':titleValue', $editRecipeTitle);

if ($updateQuery->execute()) {
    echo "Recipe details updated successfully.";
} else {
    echo "Error updating recipe details.";
}


echo "<script>alert('recipe sucessfully published'); </script>";
header("Location: /frontend/Pages/homepage_professionalcook.php");