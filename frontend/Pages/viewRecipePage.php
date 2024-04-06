<?php

require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';

session_start();

$recipeId = isset($_GET['recipeId']) ? $_GET['recipeId'] : null;

$recipeDetails = null;
if ($recipeId) {

    $query = "SELECT * FROM RecipeDetails JOIN Recipe ON Recipe.PublishDate = RecipeDetails.PublishDate AND Recipe.Title = RecipeDetails.Title WHERE Recipe.RecipeID = :recipeId";
    $stmt = $connection->prepare($query);

    $stmt->bindParam(':recipeId', $recipeId, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $recipeDetails = $stmt->fetch(PDO::FETCH_ASSOC);


    $query2 = "SELECT * FROM Video WHERE RecipeID = :recipeId";
    $stmt = $connection->prepare($query2);
    

    $stmt->bindParam(':recipeId', $recipeId, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $videoDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    $query3 = "SELECT * FROM ingredient JOIN contains ON ingredient.name = contains.name WHERE contains.recipeid = :recipeId2";
    $stmt = $connection->prepare($query3);
    $stmt->bindParam(':recipeId2', $recipeId, PDO::PARAM_INT);
    $stmt->execute();
        
    $ingredientdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query4 = "SELECT * 
    FROM cookingequipment c1, cookingequipmentname c2, utilizes u
    WHERE c1.price = c2.price 
    AND c1.category = c2.category
    AND c1.quality = c2.quality
    AND u.price = c2.price
    AND u.name = c2.name
    AND u.category = c2.category
    AND u.quality = c2.quality
    AND u.recipeid = :recipeId3";
    
    $stmt = $connection->prepare($query4);
    $stmt->bindParam(':recipeId3', $recipeId, PDO::PARAM_INT);
    $stmt->execute();
        
    $cookequipmentdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">

            <h2 class="card-title text-white mb-4">View Recipe</h2>

            <div class="card bg-base-content text-primary-content">
                <div class="card-body">
                    <h2 class="card-title">Recipe video</h2>

                    <iframe width="950" height="450" src= <?= htmlspecialchars($videoDetails['videourl']); ?>
                        
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>

                </div>
            </div>


            <div class="card bg-primary text-primary-content mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($recipeDetails['title']); ?></h2>
                    <p><?= htmlspecialchars($recipeDetails['description']); ?></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title">Difficulty level</h2>
                        <p><?= htmlspecialchars($recipeDetails['difficulty']); ?></p>
                    </div>
                </div>

                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title">Culture</h2>
                        <p><?= htmlspecialchars($recipeDetails['culture']); ?></p>
                    </div>
                </div>

                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title">Servings</h2>
                        <p><?= htmlspecialchars($recipeDetails['serving']); ?></p>
                    </div>
                </div>

                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title">Prep time</h2>
                        <p><?= htmlspecialchars($recipeDetails['estimatedtime']); ?></p>
                    </div>
                </div>
            </div>

            <div class="card bg-primary text-primary-content mt-6">
                <div class="card-body">
                    <h2 class="card-title">Ingredients</h2>
                    <?php 
                    foreach ($ingredientdetails as $row) : ?>
                        <div class="result-item">
                            <p>Name: <?= htmlspecialchars($row['name']); ?></p>
                            <p>Allergen Info: <?= htmlspecialchars($row['allergeninfo']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card bg-primary text-primary-content mt-6">
                <div class="card-body">
                    <h2 class="card-title">Cooking equipment</h2>
                    <?php 
                    foreach ($cookequipmentdetails as $row) : ?>
                        <div class="result-item">
                            <p>Name: <?= htmlspecialchars($row['name']); ?></p>
                            <p>Category: <?= htmlspecialchars($row['category']); ?></p>
                            <p>Price: <?= htmlspecialchars($row['price']); ?></p>
                            <p>Brand: <?= htmlspecialchars($row['brand']); ?></p>
                            <p>Quality: <?= htmlspecialchars($row['quality']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-control mt-6">
            <button onclick="redirectToHome()" class="btn btn-sm btn-primary" style="margin-top: 20px;">Home page</button>
            </div>

        </div>
    </div>
</body>


<script>
    function redirectToHome() {
        <?php
        if ($_SESSION['userType'] === 'HomeCook') {
            echo "window.location.href = '/frontend/Pages/homepage_homecook.php';";
        } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
            echo "window.location.href = '/frontend/Pages/homepage_professionalcook.php';";
        } else {
            echo "console.log('User type not determined.');"; 
        }
        ?>
    }
</script>

</html>
