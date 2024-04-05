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

<div class="join flex flex-col items-center space-y-8 pt-4">
    <h1 class="text-5xl font-bold text-primary-500">HALL OF FAME</h1>
    <br>
</div>
<h2 class="text-3xl font-bold text-primary-500 mb-4">Users Who Have Participated Every Single Event:</h2>

<?php

if (isset($_SESSION['EventsQueryResults'])) {
    $userresults = $_SESSION['EventsQueryResults'];
    
    echo '<div class="results">';
    foreach ($userresults as $row) {
        echo '<div class="result-item">';
        echo 'Name: ' . ucfirst(htmlspecialchars($row['username'])) . ', ';
        echo 'Number Of Following: ' . htmlspecialchars($row['numberoffollowing']). ', '; // Using "\n" for a newline
        echo 'Number Of Followers: ' . htmlspecialchars($row['numberoffollowers']). ', '; // Using "\n" for a newline
        echo 'Age: ' . htmlspecialchars($row['age']) . "\n"; // Using "\n" for a newline
        echo '</div>';
    }
    echo '</div>';
    
    unset($_SESSION['UserQueryResults']); 
}

?>
<br>
<button onclick="window.location.href = 'homepage_homecook.php'" class="btn btn-sm btn-primary">Home</button>
</body>
</html>
