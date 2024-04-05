<?php
// session_start();
require_once __DIR__ . '/../../scripts/databaseconnection.php';
require_once __DIR__ . '/../idgenerator.php';
require_once __DIR__ . '/../../../frontend/Pages/editRecipePage.php';


// The global $_POST variable allows you to access the data sent with the POST method by name
// To access the data sent with the GET method, you can use $_GET
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

// $recipeID = generateID($connection);

// $insertQueryRecipe = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
// VALUES
// (:recipeID, :publishedDate, :estimatedTime, :recipeTitle)";

// $statementInsertRecipe = $connection->prepare($insertQueryRecipe);


// $statementInsertRecipe->bindParam(':recipeID', $recipeID);
// $statementInsertRecipe->bindParam(':publishedDate', $publishedDate);
// $statementInsertRecipe->bindParam(':estimatedTime', $estimatedTime);
// $statementInsertRecipe->bindParam(':recipeTitle', $recipeTitle);

// $statementInsertRecipe->execute();



// $userID = $_SESSION['userid'];

// $insertPosts = "INSERT INTO Posts (RecipeID, UserID)
// VALUES 
// (:recipeID, :userID)";

// $statementInsertPosts = $connection->prepare($insertPosts);


// $statementInsertPosts->bindParam(':recipeID', $recipeID);
// $statementInsertPosts->bindParam(':userID', $userID);


// $statementInsertPosts->execute();



// $selectStmt = $connection->prepare("SELECT * FROM CookingEquipmentName WHERE name = :name");


// $insertStmt = $connection->prepare("INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID) VALUES (:name, :price, :category, :quality, :recipeID)");


// $selectedEquipmentDetails = [];
// foreach ($_POST['equipmentList'] as $equipmentName) {
//     $selectStmt->bindParam(':name', $equipmentName);
//     $selectStmt->execute();

//     $equipmentDetails = $selectStmt->fetch(PDO::FETCH_ASSOC);
//     if ($equipmentDetails) {
//         $selectedEquipmentDetails[] = $equipmentDetails;
//     }
// }

// foreach ($selectedEquipmentDetails as $equipment) {
//     $insertStmt->bindParam(':name', $equipment['name']);
//     $insertStmt->bindParam(':price', $equipment['price']);
//     $insertStmt->bindParam(':category', $equipment['category']);
//     $insertStmt->bindParam(':quality', $equipment['quality']);
//     $insertStmt->bindParam(':recipeID', $recipeID);
//     $insertStmt->execute();
// }



// $insertStmt = $connection->prepare("INSERT INTO Contains (RecipeID,Name) VALUES (:recipeID,:name)");


// foreach ($_POST['ingredientslist'] as $ingredient) {
//     $insertStmt->bindParam(':name', $ingredient);
//     $insertStmt->bindParam(':recipeID', $recipeID);
//     $insertStmt->execute();
// }

// echo "<script>alert('recipe sucessfully published'); window.location.href='/frontend/Pages/homepage_professionalcook.html';</script>";
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<script>alert('recipe sucessfully published'); </script>";