<?php
require_once __DIR__ . '\..\..\backend\scripts\databaseconnection.php';
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
                    $recipeDetailsQuery = $connection->prepare("SELECT * 
                            FROM RecipeDetails");
                    $recipeDetailsQuery->execute();
                    $recipe = $recipeDetailsQuery->fetchAll(PDO::FETCH_ASSOC);

                    if (count($recipe) > 0) {
                        foreach ($recipe as $recipe) {
                            ?>
                            <div style="display: flex; align-items: center;">
                                <input required class="input-bordered" type="radio" name="edit-recipe-title"
                                    value="<?= $recipe['title']; ?>">

                                <label style="margin-left: 5px;">
                                    <?= $recipe['title']; ?>
                                </label>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No Record Found";
                    }
                    ?>
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Go to editor</button>
                </div>

                <div class="form-control mt-6">
                    <a href="homepage_homecook.html"><button type="button" class="btn btn-primary">Home
                            page</button></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>