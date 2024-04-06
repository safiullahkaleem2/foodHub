<!DOCTYPE html>
<html lang="en" class="bg-base-content text-neutral-content">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
</head>

<div>User successfully deleted. Redirecting to login page...</div>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php'; 
    
    $user_username = $_SESSION['user_username'];
    $user_password = $_SESSION['user_password'];

    $delete = $connection->prepare("DELETE FROM userdetails 
                                    WHERE username = :username 
                                    AND password = :password");

    $delete->bindParam(':username', $user_username, PDO::PARAM_STR);
    $delete->bindParam(':password', $user_password, PDO::PARAM_STR);
    $delete->execute();

    // Redirect after 5 seconds
    header('Refresh: 3; URL=/frontend/Pages/loginpage.html');
    exit;
}


