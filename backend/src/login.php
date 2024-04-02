<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require_once __DIR__ . '/../scripts/databaseconnection.php'; 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $connection->prepare("SELECT * FROM AppUser WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    // echo var_dump($user);

    if ($user) {

        if ($password == $user['password']) {
            
            $_SESSION['userid'] = $user['userid']; 
            $_SESSION['username'] = $username;
<<<<<<< HEAD
        
=======
            // echo $_SESSION[userid];
>>>>>>> b0450e7bd1a70ad753b227e8abaa81a32ad20ea5
        $stmtHomeCook = $connection->prepare("SELECT * FROM HomeCook WHERE UserID = ?");
        $stmtHomeCook->execute([$user['userid']]);
        $isHomeCook = $stmtHomeCook->fetch();


        $stmtProChef = $connection->prepare("SELECT * FROM ProfessionalChef WHERE UserID = ?");
        $stmtProChef->execute([$user['userid']]);
        $isProChef = $stmtProChef->fetch();
    if  ($isHomeCook) {
        $_SESSION['userType'] = 'HomeCook';
        
       header("Location: /frontend/Pages/homepage_homecook.html");
        exit();
        } elseif ($isProChef) {
        $_SESSION['userType'] = 'ProfessionalChef';

       header("Location: /frontend/Pages/homepage_professionalcook.html");
        exit();
} 
    else {
        echo "User type not determined.";
        }


        } else {
           
            echo "Invalid username or password.";
        }
    } else {
        // need to have it show invalid user name pass
        echo "Invalid username or password.";
    }
}

