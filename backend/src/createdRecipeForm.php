<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$db = new PDO('pgsql:host=localhost; dbname=cpsc304', 'postgres', '123');

$db->beginTransaction();

// The global $_POST variable allows you to access the data sent with the POST method by name
// To access the data sent with the GET method, you can use $_GET
$recipeTitle = $_POST['recipe-title'];
$videoURL = $_POST['video-url'];
$difficultyLevel = $_POST['difficulty-level'];
$culture = $_POST['culture'];
$category = $_POST['category'];
$servings = $_POST['servings'];
$estimatedTime = $_POST['cook-time'];

$insertQueryRecipeDetails = "INSERT INTO RecipeDetails (PublishDate, Title, Description, VideoURL, Culture, Difficulty, Serving)
VALUES 
('2024-01-01', $recipeTitle, $recipeTitle, $videoURL, $culture, $difficultyLevel, $servings)";

$db->exec($insertQueryRecipeDetails);

$insertQueryRecipe = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES
(6, '2024-05-05', $estimatedTime, $recipeTitle)";

$db->exec($insertQueryRecipe);

$ingredients = $_POST['ingredients'];
// Insert each ingredient into the database
foreach ($ingredients as $ingredient) {
  // Sanitize the input to prevent SQL injection
  // $cleanIngredient = mysqli_real_escape_string($connection, $ingredient);

  // Insert the ingredient into the database (example query)
  // $query = "INSERT INTO ingredients (name) VALUES ('$cleanIngredient')";
  $query = "INSERT INTO Ingredient (Name, AllergenInfo) VALUES
     ($ingredient, 'none')";

  $db->exec($query);
  echo "<p>Inserted into Ingredient table.</p>\n";
}

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

  $db->exec($query);
  echo "<p>Inserted into Ingredient table.</p>\n";
}


