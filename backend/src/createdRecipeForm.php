<?php

require_once __DIR__ . '/../scripts/databaseconnection.php';
require_once __DIR__ . '/../src/idgenerator.php';

// $connection->beginTransaction();
var_dump($_SESSION);
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

// todo: use recipeID and global (session) variable to get userID
//       and insert the tuple (recipeID, userID) to Posts relationship

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

// todo: we are going to use a pre-defined list
// todo: create a multi-select list showing the ingredients
// $equipmentlist = $_POST['ingredientslist'];
// foreach ($equipmentlist as $equipment) {
//   $query = "INSERT INTO demo (name) VALUES ('$branditems')";
//   $query_run = mysqli_query($con, $query);
// }


// todo: we are goign to use a pre-defined list.
// todo: create a multi-select list showing the equipments

$stmt = $connection->prepare("INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID) 
VALUES
(:price, :name, :category, :quality, :recipeID)");

foreach ($_POST['equipmentList'] as $equipment) {
  // Assuming $_POST['equipmentList'] contains the selected equipment names
  // You may need to adjust this depending on how you're handling form submission

  // Bind the values to the placeholders and execute the statement
  $stmt->bindParam(':name', $equipment['name']);
  $stmt->bindParam(':price', $equipment['price']);
  $stmt->bindParam(':category', $equipment['category']);
  $stmt->bindParam(':quality', $equipment['quality']);
  $stmt->bindParam(':recipeID', $recipeID);
  $stmt->execute();
}