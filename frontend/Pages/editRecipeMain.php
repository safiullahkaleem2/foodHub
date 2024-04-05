<?php
require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration - FoodHub</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-base-content p-2.5 flex items-center justify-center h-full">
    <div class="card w-96 bg-neutral text-neutral-content ">
        <div class="card-body items-center text-center">
            <h2 class="card-title text-white mb-4">Choose Recipe to Edit</h2>

            <form action="./editRecipePage.php" method="POST">
                <div class="form-control">
                    <h1 class="text-white">Recipe:</h1>
                    <?php
                    // Ensure you have the user's ID in your session
                    if (!isset($_SESSION['userid'])) {
                        echo "Please log in to view your recipes.";
                    } else {
                        $userID = $_SESSION['userid'];

                        // Modified query to select only recipes uploaded by the user
                        $recipeDetailsQuery = $connection->prepare("SELECT * FROM Recipe
                            JOIN Posts ON Posts.RecipeID = Recipe.RecipeID
                            WHERE Posts.UserID = :userID");
                        $recipeDetailsQuery->bindParam(':userID', $userID, PDO::PARAM_INT);
                        $recipeDetailsQuery->execute();
                        $recipes = $recipeDetailsQuery->fetchAll(PDO::FETCH_ASSOC);

                        
                        if (count($recipes) > 0) {
                            foreach ($recipes as $recipe) {
                                ?>
                                <div style="display: flex; align-items: center;">
                                    <input required class="input-bordered" type="radio" name="edit-recipe-id"
                                        value="<?= htmlspecialchars($recipe['recipeid']); ?>">

                                    <label style="margin-left: 5px;">
                                        <?= htmlspecialchars($recipe['title']); ?>
                                    </label>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                    }
                    ?>
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Go to editor</button>
                </div>

                <div class="form-control mt-6">
                    <a href="homepage_professionalcook.html"><button type="button" class="btn btn-primary">Home
                            page</button></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
