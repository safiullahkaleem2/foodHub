<?php

require_once __DIR__ . '/../scripts/databaseconnection.php'; 

$connection->beginTransaction();

// The global $_POST variable allows you to access the data sent with the POST method by name
// To access the data sent with the GET method, you can use $_GET
$recipeTitle = $_POST['recipe-title'];
$recipeDescription = $_POST['recipe-description'];
$videoURL = $_POST['video-url'];
$videoDuration = $_POST['video-duration'];
$videoName = $_POST['video-name'];
$difficultyLevel = $_POST['difficulty-level'];
$ratingLevel = $_POST['rating-level'];
$culture = $_POST['culture'];
$category = $_POST['category'];
$servings = $_POST['servings'];
$estimatedTime = $_POST['estimated-time'];
$publishedDate = date('Y-m-d');


$insertQueryRecipeDetails = "INSERT INTO RecipeDetails (PublishDate, Title, Description, VideoURL, Culture, Difficulty, Serving)
VALUES 
($publishedDate, $recipeTitle, $recipeTitle, $videoURL, $culture, $difficultyLevel, $servings)";

$connection->exec($insertQueryRecipeDetails);

// TODO: use Safi's getID() function to get recipeID
$insertQueryRecipe = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES
(6, '2024-05-05', $estimatedTime, $recipeTitle)";

$connection->exec($insertQueryRecipe);

// TODO: use recipeID and global (session) variable to get userID
//       and insert the tuple (recipeID, userID) to Posts relationship


// todo: we are going to use a pre-defined list
// todo: create a multi-select list showing the ingredients
$ingredients = $_POST['ingredients'];
// Insert each ingredient into the database
foreach ($ingredients as $ingredient) {
  // Sanitize the input to prevent SQL injection
  // $cleanIngredient = mysqli_real_escape_string($connection, $ingredient);

  // Insert the ingredient into the database (example query)
  // $query = "INSERT INTO ingredients (name) VALUES ('$cleanIngredient')";
  $query = "INSERT INTO Ingredient (Name, AllergenInfo) VALUES
     ($ingredient, 'none')";

  $connection->exec($query);
  echo "<p>Inserted into Ingredient table.</p>\n";
}


// todo: we are goign to use a pre-defined list.
// todo: create a multi-select list showing the equipments

$equipments = $_POST['equipments'];
// Insert each ingredient into the database
foreach ($equipments as $equipment) {
  // Sanitize the input to prevent SQL injection
  // $cleanIngredient = mysqli_real_escape_string($connection, $ingredient);

  // Insert the ingredient into the database (example query)
  // $query = "INSERT INTO ingredients (name) VALUES ('$cleanIngredient')";
  $query = "INSERT INTO CookingEquipment (Price, Category, Quality, Brand)
  VALUES 
  (60, 'Mixers', 'Medium', 'Brand5')";

  $connection->exec($query);
  echo "<p>Inserted into Ingredient table.</p>\n";
}


