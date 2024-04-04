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
    <div class="card w-auto bg-neutral text-neutral-content ">
        <div class="card-body items-center text-center">
            <h2 class="card-title text-white mb-4">Create Recipe</h2>
            <form action="/../backend/src/createdRecipeForm.php" method="post">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe title</span>
                    </label>
                    <input required type="text" name="recipe-title" placeholder="Enter recipe title"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe description</span>
                    </label>
                    <textarea required name="recipe-description" placeholder="Enter recipe description"
                        class="input input-bordered text-zinc-950 h-32 resize-none"></textarea>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe Video</span>
                    </label>
                    <input required type="url" name="video-url" placeholder="Enter link to recipe video"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe Video Duration (in minutes)</span>
                    </label>
                    <input required type="number" step="1" name="video-duration" placeholder="Enter duration in minutes"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Recipe Video Name</span>
                    </label>
                    <input required type="text" name="video-name" placeholder="Enter video name"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label" for="difficulty-level">
                        <span class="label-text text-white">Choose a difficulty level</span>
                    </label>
                    <select class="input input-bordered text-zinc-950" name="difficulty-level" id="difficulty-level">
                        <option value="expert">Expert</option>
                        <option value="difficult">Difficult</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="easy">Beginner</option>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Culture</span>
                    </label>
                    <input required type="text" name="culture" placeholder="Enter culture"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Category</span>
                    </label>
                    <input required type="text" name="category" placeholder="Enter Category"
                        class="input input-bordered text-zinc-950">
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
                    <input required type="number" name="servings" placeholder="Enter total servings"
                        class="input input-bordered text-zinc-950">
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Estimated time</span>
                    </label>
                    <input required type="number" name="estimated-time" placeholder="Enter estimated cook time"
                        class="input input-bordered text-zinc-950">
                </div>


                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Ingredients</span>
                    </label>
                    <?php
                    $ingredientQuery = $connection->prepare("SELECT * 
                            FROM Ingredient");
                    $ingredientQuery->execute();
                    $ingredients = $ingredientQuery->fetchAll(PDO::FETCH_ASSOC);

                    if (count($ingredients) > 0) {
                        foreach ($ingredients as $ingredient) {
                            ?>
                            <div style="display: flex; align-items: center;">
                                <input class="input-bordered" type="checkbox" name="ingredientslist[]"
                                    value="<?= $ingredient['name']; ?>" />
                                <label style="margin-left: 5px;">
                                    <?= $ingredient['name'] . ' (Allergen Info: ' . $ingredient['allergeninfo'] . ')'; ?>
                                </label>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No Record Found";
                    }
                    ?>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-white">Cooking Equipment</span>
                    </label>
                    <?php
                    $equipmentQuery = $connection->prepare("SELECT * 
                            FROM CookingEquipmentName");
                    $equipmentQuery->execute();
                    $equipments = $equipmentQuery->fetchAll(PDO::FETCH_ASSOC);

                    if (count($equipments) > 0) {
                        foreach ($equipments as $equipment) {
                            ?>
                            <div style="display: flex; align-items: center;">
                                <input class="input-bordered" type="checkbox" name="equipmentList[]"
                                    value="<?= $equipment['name']; ?>" />
                                <label style="margin-left: 5px;">
                                    <?= ' Name: ' . $equipment['name'] . ', Price: ' . $equipment['price'] . ', Category: ' . $equipment['category'] . ', Quality: ' . $equipment['quality']; ?>    
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
                    <button type="submit" class="btn btn-primary">Publish new recipe</button>
                </div>
                <div class="form-control mt-6">
                    <button type="reset" class="btn btn-primary">Reset form</button>
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