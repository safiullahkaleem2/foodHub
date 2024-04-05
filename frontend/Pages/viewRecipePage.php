<?php

require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';


$recipeId = isset($_GET['recipeId']) ? $_GET['recipeId'] : null;

$recipeDetails = null;
if ($recipeId) {

    $query = "SELECT * FROM RecipeDetails JOIN Recipe ON Recipe.PublishDate = RecipeDetails.PublishDate AND Recipe.Title = RecipeDetails.Title WHERE Recipe.RecipeID = :recipeId";
    $stmt = $connection->prepare($query);
    

    $stmt->bindParam(':recipeId', $recipeId, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $recipeDetails = $stmt->fetch(PDO::FETCH_ASSOC);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe - FoodHub</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-content p-2.5 flex items-center justify-center h-full">
    <div class="card bg-neutral text-neutral-content ">
        <div class="card-body items-center text-center">
            <h2 class="card-title text-white mb-4">View Recipe</h2>

            <div class="card bg-primary text-primary-content">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($recipeDetails['title']); ?></h2>
                    <p><?= htmlspecialchars($recipeDetails['description']); ?></p>
                </div>
            </div>


            <div class="card w-96 bg-primary text-primary-content">
                <div class="card-body">
                    <h2 class="card-title">Difficulty level</h2>
                    <p><?= htmlspecialchars($recipeDetails['difficulty']); ?></p>
                </div>
            </div>

            <div class="form-control mt-6">
                <a href="homepage_homecook.php"><button type="button" class="btn btn-primary">Home page</button></a>
            </div>
        </div>
    </div>
</body>
</html>
