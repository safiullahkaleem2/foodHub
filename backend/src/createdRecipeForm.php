<?php

require_once __DIR__ . '/../scripts/databaseconnection.php';
require_once __DIR__ . '/../src/idgenerator.php';

session_start();

// The global $_POST variable allows you to access the data sent with the POST method by name
// To access the data sent with the GET method, you can use $_GET
$recipeTitle = $_POST['recipe-title'];
$recipeDescription = $_POST['recipe-description'];

$videoDuration = $_POST['video-duration'];
$videoName = $_POST['video-name'];
$difficultyLevel = $_POST['difficulty-level'];
$ratingLevel = $_POST['rating-level'];
$culture = $_POST['culture'];
$category = $_POST['category'];
$servings = $_POST['servings'];
$estimatedTime = $_POST['estimated-time'];
$publishedDate = date('Y-m-d');


// Prepare the INSERT statement with placeholders
$insertQueryRecipeDetails = "INSERT INTO RecipeDetails (PublishDate, Title, Description, Culture, Difficulty, Serving)
VALUES 
(:publishedDate, :recipeTitle, :recipeDescription, :culture, :difficultyLevel, :servings)";

// Prepare the statement
$statementInsertRecipeDetails = $connection->prepare($insertQueryRecipeDetails);

// Bind parameters
$statementInsertRecipeDetails->bindParam(':publishedDate', $publishedDate);
$statementInsertRecipeDetails->bindParam(':recipeTitle', $recipeTitle);
$statementInsertRecipeDetails->bindParam(':recipeDescription', $recipeDescription);
$statementInsertRecipeDetails->bindParam(':culture', $culture);
$statementInsertRecipeDetails->bindParam(':difficultyLevel', $difficultyLevel);
$statementInsertRecipeDetails->bindParam(':servings', $servings);

// Execute the statement
$statementInsertRecipeDetails->execute();

// TODO: use Safi's getID() function to get recipeID

$recipeID = generateID($connection);

// Prepare the INSERT statement with placeholders
$insertQueryRecipe = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES
(:recipeID, :publishedDate, :estimatedTime, :recipeTitle)";

// Prepare the statement
$statementInsertRecipe = $connection->prepare($insertQueryRecipe);

// Bind parameters
$statementInsertRecipe->bindParam(':recipeID', $recipeID);
$statementInsertRecipe->bindParam(':publishedDate', $publishedDate);
$statementInsertRecipe->bindParam(':estimatedTime', $estimatedTime);
$statementInsertRecipe->bindParam(':recipeTitle', $recipeTitle);

// Execute the statement
$statementInsertRecipe->execute();


$userID = $_SESSION['userid'];

$insertPosts = "INSERT INTO Posts (RecipeID, UserID)
VALUES 
(:recipeID, :userID)";

$statementInsertPosts = $connection->prepare($insertPosts);

// Bind parameters
$statementInsertPosts->bindParam(':recipeID', $recipeID);
$statementInsertPosts->bindParam(':userID', $userID);

// Execute the statement
$statementInsertPosts->execute();


$stmt = $connection->prepare("INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID) 
VALUES
(:eqName, :price, :category, :quality, :recipeID)");


foreach ($_POST['equipmentList'] as $recipe) {
  // Split the value into an array using the comma as a delimiter
  $equipment_details = explode(',', $recipe);

  // Bind the values to the placeholders and execute the statement
  $stmt->bindParam(':eqName', $equipment_details[0]);
  $stmt->bindParam(':price', $equipment_details[1]);
  $stmt->bindParam(':category', $equipment_details[2]);
  $stmt->bindParam(':quality', $equipment_details[3]);
  $stmt->bindParam(':recipeID', $recipeID);
  $stmt->execute();
}

header("Location: ../../frontend/Pages/homepage_professionalcook.html");
exit; // Ensure that subsequent code is not executed
