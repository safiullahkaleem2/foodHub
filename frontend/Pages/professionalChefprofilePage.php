<?php
require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';
session_start();

    $profileUserId = $_GET['userId'];

    $stmt = $connection->prepare("SELECT * 
                                    FROM userdetails u, professionalchef p, appuser a, professionalchefskill p2
                                    WHERE a.username = u.username 
                                    AND a.password = u.password 
                                    AND a.userid = p.userid 
                                    AND a.userid = :userid
                                    AND p2.restaurantaffiliation = p.RestaurantAffiliation 
                                    AND p2.restaurantlocation = p.restaurantlocation");
    $stmt->bindParam(':userid', $profileUserId);
    $_SESSION['followid'] = $profileUserId;

    $stmt->execute();
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta viewport="width=device-width, initial-scale=1.0">
    <title>User Profile - FoodHub</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-content flex items-center justify-center min-h-screen">
    <div class="card bg-neutral text-neutral-content shadow-xl">
        <div class="card-body items-center text-center">
            <h2 class="card-title text-white mb-4">User Profile</h2>
            <div class="mb-2">
                <div class="font-bold text-lg text-white">Username:</div>
                <span class="text-white"><?= htmlspecialchars($userDetails['username'] ?? 'N/A'); ?></span>
            </div>

            <div class="mb-2">
                <div class="font-bold text-lg text-white">Number of Followers:</div>
                <span class="text-white"><?= htmlspecialchars($userDetails['numberoffollowers'] ?? 'N/A'); ?></span>
            </div>


            <div class="mb-2">
                <div class="font-bold text-lg text-white">Number of Followings</div>
                <span class="text-white"><?= htmlspecialchars($userDetails['numberoffollowing'] ?? 'N/A'); ?></span>
            </div>

            
            <div class="mb-2">
                <div class="font-bold text-lg text-white">Age: </div>
                <span class="text-white"><?= htmlspecialchars($userDetails['age'] ?? 'N/A'); ?></span>
            </div>

            <div class="mb-2">
                <div class="font-bold text-lg text-white">Restaurant Location: </div>
                <span class="text-white"><?= htmlspecialchars($userDetails['restaurantlocation'] ?? 'N/A'); ?></span>
            </div>
            <div class="mb-2">
                <div class="font-bold text-lg text-white">Restaurant Affiliation: </div>
                <span class="text-white"><?= htmlspecialchars($userDetails['restaurantaffiliation'] ?? 'N/A'); ?></span>
            </div>

            <div class="mb-2">
                <div class="font-bold text-lg text-white">Certification: </div>
                <span class="text-white"><?= htmlspecialchars($userDetails['certification'] ?? 'N/A'); ?></span>
            </div>

            <div class="form-control mt-6">
                <form action="/../backend/src/follow.php" method="post">
                    <button type="submit" name="follow" class="btn btn-primary">Follow</button>
                </form>
            </div>
            <div class="form-control mt-6">
                <button onclick="redirectToHome()" class="btn btn-sm btn-primary" style="margin-top: 20px;">Home</button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function redirectToHome() {
        <?php
        if ($_SESSION['userType'] === 'HomeCook') {
            echo "window.location.href = '/frontend/Pages/homepage_homecook.php';";
        } elseif ($_SESSION['userType'] === 'ProfessionalChef') {
            echo "window.location.href = '/frontend/Pages/homepage_professionalcook.php';";
        } else {
            echo "console.log('User type not determined.');"; 
        }
        ?>
    }
</script>

</html>
