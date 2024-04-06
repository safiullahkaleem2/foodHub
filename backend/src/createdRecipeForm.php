<?php
session_start();
require_once __DIR__ . '/../scripts/databaseconnection.php';
require_once __DIR__ . '/../src/idgenerator.php';

$recipeTitle = $_POST['recipe-title'];
$recipeDescription = $_POST['recipe-description'];

$videoDuration = $_POST['video-duration'];
$name = $_POST['video-name'];
$difficultyLevel = $_POST['difficulty-level'];
$ratingLevel = $_POST['rating-level'];
$culture = $_POST['culture'];
$category = $_POST['category'];
$servings = $_POST['servings'];
$estimatedTime = $_POST['estimated-time'];
$videourl = $_POST['video-url'];

$publishedDate = date('Y-m-d H:i:s');

$insertQueryRecipeDetails = "INSERT INTO RecipeDetails (PublishDate, Title, Description, Culture, Difficulty, Serving)
VALUES 
(:publishedDate, :recipeTitle, :recipeDescription, :culture, :difficultyLevel, :servings)";

$statementInsertRecipeDetails = $connection->prepare($insertQueryRecipeDetails);

$statementInsertRecipeDetails->bindParam(':publishedDate', $publishedDate);
$statementInsertRecipeDetails->bindParam(':recipeTitle', $recipeTitle);
$statementInsertRecipeDetails->bindParam(':recipeDescription', $recipeDescription);
$statementInsertRecipeDetails->bindParam(':culture', $culture);
$statementInsertRecipeDetails->bindParam(':difficultyLevel', $difficultyLevel);
$statementInsertRecipeDetails->bindParam(':servings', $servings);

$statementInsertRecipeDetails->execute();

$recipeID = generateID($connection);

$insertQueryRecipe = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES
(:recipeID, :publishedDate, :estimatedTime, :recipeTitle)";

$statementInsertRecipe = $connection->prepare($insertQueryRecipe);


$statementInsertRecipe->bindParam(':recipeID', $recipeID);
$statementInsertRecipe->bindParam(':publishedDate', $publishedDate);
$statementInsertRecipe->bindParam(':estimatedTime', $estimatedTime);
$statementInsertRecipe->bindParam(':recipeTitle', $recipeTitle);

$statementInsertRecipe->execute();

$userID = $_SESSION['userid'];

$insertPosts = "INSERT INTO Posts (RecipeID, UserID)
VALUES 
(:recipeID, :userID)";

$statementInsertPosts = $connection->prepare($insertPosts);

$statementInsertPosts->bindParam(':recipeID', $recipeID);
$statementInsertPosts->bindParam(':userID', $userID);

$statementInsertPosts->execute();

$selectStmt = $connection->prepare("SELECT * FROM CookingEquipmentName WHERE name = :name");


$insertStmt = $connection->prepare("INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID) VALUES (:name, :price, :category, :quality, :recipeID)");

$selectedEquipmentDetails = [];

  foreach ($_POST['equipmentList'] as $equipmentString) {
    $parts = explode(',', $equipmentString);

    // Assign parts to variables (make sure the order matches with how you concatenated them)
    $equipmentname = $parts[0];
    $equipmentprice = $parts[1];
    $equipmentcategory = $parts[2];
    $equipmentquality = $parts[3];
    $insertStmt = $connection->prepare("INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID) VALUES (:name, :price, :category, :quality, :recipeID)");
    $insertStmt->bindParam(':recipeID', $recipeID);
    $insertStmt->bindParam(':name', $equipmentname);
    $insertStmt->bindParam(':price', $equipmentprice);
    $insertStmt->bindParam(':category', $equipmentcategory);
    $insertStmt->bindParam(':quality', $equipmentquality);
    $insertStmt->execute();

  }

$insertStmt = $connection->prepare("INSERT INTO Contains (RecipeID,Name) VALUES (:recipeID,:name)");

foreach ($_POST['ingredientslist'] as $ingredient) {
  $insertStmt->bindParam(':name', $ingredient);
  $insertStmt->bindParam(':recipeID', $recipeID); 
  $insertStmt->execute();
}

$insertQuery18 = $connection->prepare("INSERT INTO Video (Name, UploadTime, RecipeID, VideoURL, Duration, Views) VALUES (:name, :uploadTime, :recipeId, :videoURL, :duration, 0)");


$uploadTime = date('Y-m-d H:i:s');


$insertQuery18->bindParam(':name', $name);
$insertQuery18->bindParam(':uploadTime', $uploadTime);
$insertQuery18->bindParam(':recipeId', $recipeID);
$insertQuery18->bindParam(':videoURL', $videourl);
$insertQuery18->bindParam(':duration', $videoDuration);


$insertQuery18->execute();

echo "<script>alert('recipe sucessfully published');</script>";
header("Location: /frontend/Pages/homepage_professionalcook.php");