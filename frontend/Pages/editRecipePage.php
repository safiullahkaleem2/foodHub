<?php
require_once __DIR__ . '\..\..\backend\scripts\databaseconnection.php';
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
            <h2 class="card-title text-white mb-4">Edit Recipe</h2>
            <form>
                <?php
                $editRecipeTitle = $_POST['edit-recipe-title'];
                $recipeQuery = $connection->prepare("SELECT * 
                FROM RecipeDetails WHERE Title = :editRecipeTitle");
                $recipeQuery->bindParam(':editRecipeTitle', $editRecipeTitle);
                $recipeQuery->execute();
                
                $recipe = $recipeQuery->fetchAll(PDO::FETCH_ASSOC);
                $firstRecipe = $recipe[0];
                // $recipe = $recipes;
                $recipeTitle = $firstRecipe['title'];
                $recipeDescription = $firstRecipe['description'];
                $recipeCulture = $firstRecipe['culture'];
                $recipeDifficulty = $firstRecipe['difficulty'];
                $recipeServing = $firstRecipe['serving'];
                

                ?>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe title</span>
                    </label>
                    <input class='text-zinc-950 input input-bordered' type="text" class="text-zinc-950 input input-bordered" value="<?= htmlspecialchars($recipeTitle) ?>">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe description</span>
                    </label>
                    <textarea required name="recipe-description"
                        class="input input-bordered text-zinc-950 h-32 resize-none"><?= htmlspecialchars($recipeDescription) ?></textarea>
                </div>

                <!-- <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe Video</span>
                    </label>
                    <input type="text" placeholder="Enter link to recipe video" class="input input-bordered">
                </div> -->

                <div class="form-control">
                    <label class="label" for="difficulty-level">
                        <span class="label-text text-white">Choose a difficulty level</span>
                    </label>
                    <select class="input input-bordered text-zinc-950" name="difficulty-level" id="difficulty-level">
                        <option value="expert" <?php if ($recipeDifficulty === 'Expert') echo 'selected'; ?> >Expert</option>
                        <option value="difficult" <?php if ($recipeDifficulty === 'Difficult') echo 'selected'; ?>>Difficult</option>
                        <option value="intermediate" <?php if ($recipeDifficulty === 'Intermediate') echo 'selected'; ?>>Intermediate</option>
                        <option value="easy" <?php if ($recipeDifficulty === 'Beginner') echo 'selected'; ?>>Beginner</option>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Culture</span>
                    </label>
                    <input type="text" value="<?= htmlspecialchars($recipeCulture) ?>" class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Category</span>
                    </label>
                    <input type="text" placeholder="Enter Category" class="input input-bordered">
                </div>

                <div class="form-control">
                    <label class="label" for="rating-level">
                        <span class="label-text text-white">Choose a rating level</span>
                    </label>
                    <select class="input input-bordered text-zinc-950" name="rating-level" id="rating-level">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Servings</span>
                    </label>
                    <input type="number" value="<?= htmlspecialchars($recipeServing) ?>" class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Prep time</span>
                    </label>
                    <input type="number" placeholder="Enter estimated prep time" class="input input-bordered">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Cook time</span>
                    </label>
                    <input type="number" placeholder="Enter estimated cook time" class="input input-bordered">
                </div>


                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>