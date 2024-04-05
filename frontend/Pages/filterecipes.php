<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en" class=" bg-base-content text-neutral-content">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="flex">
  <h3 class="text-3xl font-bold text-start text-primary-500 mb-4 pt-4 mr-4 ml-4">Filter Recipes</h3> 
  <button onclick="window.location.href = 'homepage_homecook.php'" class="btn btn-sm btn-primary" style="margin-top: 20px;">Home</button>
</div>
<div>
    <div class="dropdown dropdown-end">
    <form method="POST" action="/../backend/src/recipefilter.php">
        <div class="m-1 ml-4">
            <label class="input input-bordered flex items-center gap-2 input-xs bg-neutral">
                <input type="text" name="text" class="grow" placeholder="Enter servings amount: " style="color: white;"/>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
            </label>
        </div>
        <div class="join">

        <div class="m-1">
            <h3 for="culture" class="text-sm">Culture Type:</h3>
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
            <div class="checkboxes">
                <label><input type="checkbox" name="show_title" value="true">Title</label>
                <label><input type="checkbox" name="show_publishdate" value="true">Publish Date</label>
                <label><input type="checkbox" name="show_description" value="true">Description</label>
                <label><input type="checkbox" name="show_culture" value="true">Culture</label>
                <label><input type="checkbox" name="show_difficulty" value="true">Difficulty</label>
                <label><input type="checkbox" name="show_serving" value="true">Serving</label>
                <label><input type="checkbox" name="show_estimatedtime" value="true">Estimated Time</label>
            </div>
    </div>
    <br>
        <button type="submit" class="btn btn-sm btn-primary">Search</button>
    </form>
</div>

<style>
    .checkboxes label {
        margin-left: 5px; /* Adjust the margin as needed */
    }
</style>

<?php


if (isset($_SESSION['queryResults'])) {
    $results = $_SESSION['queryResults'];
    
    echo '<div class="results">';
    foreach ($results as $row) {
        echo '<div class="result-item">';
        

        if ($_SESSION['show_title'] == 1) {
            echo '<h5>Title: ' . htmlspecialchars($row['title']) . '</h5>';
        }
        if ($_SESSION['show_publishdate'] == 1) {
            echo '<p>Publish Date: ' . htmlspecialchars($row['publishdate']) . '</p>';
        }
        if ($_SESSION['show_description'] == 1) {
            echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
        }
        if ($_SESSION['show_culture'] == 1) {
            echo '<p>Culture: ' . htmlspecialchars($row['culture']) . '</p>';
        }

        if ($_SESSION['show_difficulty']) {
            echo '<p>Difficulty: ' . htmlspecialchars($row['difficulty']) . '</p>';
        }
        if ($_SESSION['show_serving']) {
            echo '<p>Serving: ' . htmlspecialchars($row['serving']) . '</p>';
        }

        if ($_SESSION['show_estimatedtime']) {
            echo '<p>estimated time: ' . htmlspecialchars($row['estimatedtime']) . '</p>';
        }

        
        echo '</div>';
    }
    echo '</div>';
    
    unset($_SESSION['queryResults']); 
}

?>

</body>
</html>
