<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../scripts/databaseconnection.php'; 

    global $isHomeCook, $isProChef;
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $connection->prepare("SELECT * FROM AppUser WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
     
    if ($user) {
        if ($password == $user['password']) {

            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $username;
            
            $stmtHomeCook = $connection->prepare("SELECT * FROM HomeCook WHERE UserID = ?");
            $stmtHomeCook->execute([$user['userid']]);
            $isHomeCook = $stmtHomeCook->fetch();

            $stmtProChef = $connection->prepare("SELECT * FROM ProfessionalChef WHERE UserID = ?");
            $stmtProChef->execute([$user['userid']]);
            $isProChef = $stmtProChef->fetch();

            if ($isHomeCook) {
                $_SESSION['userType'] = 'HomeCook';
                header("Location: /frontend/Pages/homepage_homecook.php");
                exit();
            } elseif ($isProChef) {
                $_SESSION['userType'] = 'ProfessionalChef';
                header("Location: /frontend/Pages/homepage_professionalcook.php");
                exit();
            } else {
                echo "User type not determined.";
            }
        } else {
            echo "<script>alert('Invalid username or password'); window.location.href='/frontend/Pages/loginpage.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='/frontend/Pages/loginpage.html';</script>";
    }
}

