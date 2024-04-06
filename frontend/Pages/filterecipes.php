<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en" class=" bg-base-content text-neutral-content">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Registration - FoodHub</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>


<style>
    .checkboxes label {
        margin-left: 5px; /* Adjust the margin as needed */
    }
</style>

</head>
<body>

<div class="ml-4">
    <div class="flex">
    <h3 class="text-3xl font-bold text-start text-primary-500 mb-4 pt-4 mr-4 ml-4">Filter Recipes</h3> 
    <button onclick="redirectToHome()" class="btn btn-sm btn-primary" style="margin-top: 20px;">Home</button>
    </div>
        <div class="dropdown dropdown-end">
        <form method="POST" action="/../backend/src/recipefilter.php">
            <div class="m-1">
                <label class="input input-bordered flex items-center gap-2 input-xs bg-neutral">
                    <input type="text" name="text" class="grow" placeholder="Servings" style="color: white;"/>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                </label>
            </div>
            <div class="join">

            <div class="m-1">
                <label for="culture" class="text-sm">Culture Type:</label>
                <select id="culture" name="culture" class="select select-bordered w-full max-w-xs" style="color: black;">
                    <option value="Chinese">Chinese</option>
                    <option value="American">American</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Mexican">Mexican</option>
                    <option value="Mediterranean">Mediterranean</option>
                    <option value="Swiss">Swiss</option>
                    <option value="Indian">Indian</option>
                    <option value="French">French</option>
                    <option value="Asian Fusion">Asian Fusion</option>
                    <option value="Thai">Thai</option>
                    <option value="Caribbean">Caribbean</option>
                    <option value="Italian">Italian</option>
                    <option value="any">Any</option>
                    
                </select>
            </div>

</div>

        </div>

        <br>
        <button type="submit" name="search_button" class="btn btn-sm btn-primary" style="color: black;">Search</button>
        </form>

        <form method="POST" action="/../backend/src/recipefilter.php">
 
    <div class="checkboxes">
    <label><input type="checkbox" name="show_title" value="true">Title</label>
    <label><input type="checkbox" name="show_publishdate" value="true">Publish Date</label>
    <label><input type="checkbox" name="show_description" value="true">Description</label>
    <label><input type="checkbox" name="show_culture" value="true">Culture</label>
    <label><input type="checkbox" name="show_difficulty" value="true">Difficulty</label>
    <label><input type="checkbox" name="show_serving" value="true">Serving</label>
    <label><input type="checkbox" name="show_estimatedtime" value="true">Estimated Time</label>
</div>

<div class="join">
            <button type="submit" name="project_query_button" class="btn btn-sm btn-primary style="color: black;"">Search By fields</button>
            <br>

        </div>

        <!-- <br>
        <button type="submit" name="project_query_button" class="btn btn-sm btn-primary">Search By fields</button> -->

    </form>

    <form method="POST" action="/../backend/src/recipefilter.php">
    <div class="dynamic-conditions">
        <div class="condition" data-id="0">
            <select name="conditions[0][field]" class="select select-bordered">
                <option value="title">Title</option>
                <option value="publishdate">Publish Date</option>
                <option value="description">Description</option>
                <option value="culture">Culture</option>
                <option value="difficulty">Difficulty</option>
                <option value="serving">Serving</option>
                <option value="estimatedtime">Estimated Time</option>
            
            </select>
            <span>=</span>
            <input type="text" name="conditions[0][value]" placeholder="" class="input input-bordered">
            
        </div>
    </div>
    <div>
        <button type="button" onclick="addCondition()" class="btn btn-success">+ Add Condition</button>
    </div>
    <div class="mt-2">
        <button type="submit" name="dynamic_condition_search" class="btn btn-primary">Search with Conditions</button>
    </div>
</form>

<script>
let conditionCount = 0;

function addCondition() {
    conditionCount++;
    const conditionHTML = `
        <div class="condition" data-id="${conditionCount}">
            <select name="conditions[${conditionCount}][field]" class="select select-bordered">
            <option value="title">Title</option>
                <option value="publishdate">Publish Date</option>
                <option value="description">Description</option>
                <option value="culture">Culture</option>
                <option value="difficulty">Difficulty</option>
                <option value="serving">Serving</option>
                <option value="estimatedtime">Estimated Time</option>

            </select>
            <span>=</span>
            <input type="text" name="conditions[${conditionCount}][value]" placeholder="Value" class="input input-bordered">
            <select name="conditions[${conditionCount}][logic]" class="select select-bordered">
                <option value="AND">AND</option>
                <option value="OR">OR</option>
            </select>
            <button type="button" class="btn btn-error" onclick="removeCondition(${conditionCount})">Delete</button>
        </div>`;
    document.querySelector('.dynamic-conditions').insertAdjacentHTML('beforeend', conditionHTML);
}

function removeCondition(id) {
    const conditionElement = document.querySelector(`.condition[data-id="${id}"]`);
    if (conditionElement) {
        conditionElement.remove();
    }
}
</script>    </div>
<?php


if (isset($_SESSION['queryResults'])) {
    $results = $_SESSION['queryResults'];
    
    echo '<div class="results">';
    foreach ($results as $row) {
        echo '<div class="result-item">';
        


            echo '<h5>Title: ' . htmlspecialchars($row['title']) . '</h5>';
        
            echo '<p>Publish Date: ' . htmlspecialchars($row['publishdate']) . '</p>';
            echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
            echo '<p>Culture: ' . htmlspecialchars($row['culture']) . '</p>';


            echo '<p>Difficulty: ' . htmlspecialchars($row['difficulty']) . '</p>';
            echo '<p>Serving: ' . htmlspecialchars($row['serving']) . '</p>';

            echo '<p>estimated time: ' . htmlspecialchars($row['estimatedtime']) . '</p>';
            echo "<a href='viewRecipePage.php?recipeId=" . urlencode($row['recipeid']) . "' class='btn btn-primary'>View Recipe</a>";        
            echo '</div>';
    }
    
    echo '</div>';
    
    unset($_SESSION['queryResults']); 
}


if (isset($_SESSION['selectionresults'])) {
    $results = $_SESSION['selectionresults'];
    
    echo '<div class="results">';
    foreach ($results as $row) {
    echo "<div>";
    foreach ($row as $key => $value) {
        echo "<p><strong>$key:</strong> $value</p>";
    }
    echo "</div>";
}
    
    echo '</div>';
    
    unset($_SESSION['selectionresults']); 
}


?>

<script>
    function redirectToHome() {
        <?php
        if ($_SESSION['userType'] === 'HomeCook') {
            echo "window.location.href = '/frontend/Pages/homepage_homecook.php';";
        } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
            echo "window.location.href = '/frontend/Pages/homepage_professionalcook.php';";
        } else {
            echo "console.log('User type not determined.');"; // You can handle this case as needed
        }
        ?>
    }
</script>

</body>
</html>
