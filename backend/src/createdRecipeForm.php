<?php
session_start();
require_once __DIR__ . '/../scripts/databaseconnection.php';
require_once __DIR__ . '/../src/idgenerator.php';

// $connection->beginTransaction();

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
foreach ($_POST['equipmentList'] as $equipmentName) {
    $selectStmt->bindParam(':name', $equipmentName);
    $selectStmt->execute();

    $equipmentDetails = $selectStmt->fetch(PDO::FETCH_ASSOC);
    if ($equipmentDetails) {
        $selectedEquipmentDetails[] = $equipmentDetails;
    }
}

foreach ($selectedEquipmentDetails as $equipment) {
  $insertStmt->bindParam(':name', $equipment['name']);
  $insertStmt->bindParam(':price', $equipment['price']);
  $insertStmt->bindParam(':category', $equipment['category']);
  $insertStmt->bindParam(':quality', $equipment['quality']);
  $insertStmt->bindParam(':recipeID', $recipeID); 
  $insertStmt->execute();
}



$insertStmt = $connection->prepare("INSERT INTO Contains (RecipeID,Name) VALUES (:recipeID,:name)");


foreach ($_POST['ingredientslist'] as $ingredient) {
  $insertStmt->bindParam(':name', $ingredient);
  $insertStmt->bindParam(':recipeID', $recipeID); 
  $insertStmt->execute();
}

echo "<script>alert('recipe sucessfully published'); window.location.href='/frontend/Pages/homepage_professionalcook.html';</script>";

