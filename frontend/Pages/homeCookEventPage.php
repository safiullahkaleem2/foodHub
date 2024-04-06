<?php

require_once __DIR__ . '/../../backend/scripts/databaseconnection.php';
$isRegistered = false;
session_start();


        $eventID = $_GET['eventid'];    
            $stmt = $connection->prepare("SELECT * FROM EventDetails e, eventlocation e1 WHERE EventID = :eventid AND e.category = e1.category AND e.entryfee = e1.entryfee");
            $stmt->execute(['eventid' => $eventID]);
            $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);    
               
            $userID = $_SESSION['userid'];
    
                $registrationCheckSql = "SELECT COUNT(*) FROM Participates WHERE EventID = :eventid AND UserID = :userid";
                $registrationCheckStmt = $connection->prepare($registrationCheckSql);
                $registrationCheckStmt->execute([':eventid' => $eventID, ':userid' => $userID]);
                
                if ($registrationCheckStmt->fetchColumn() > 0) {
                    $isRegistered = true;
                }
    
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
<body class="bg-base-content flex items-center justify-center h-screen">
    <?php if ($eventDetails): ?>
        <div class="card w-96 bg-neutral text-neutral-content shadow-xl">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-white">Event Details</h2>
           
                <div class="mb-2">
                    <span class="font-semibold text-white">Date:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['date']); ?></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-white">Location:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['location']); ?></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-white">Category:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['category']); ?></span>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-white">Entry Fee:</span>
                    <span class="text-white">$<?= htmlspecialchars($eventDetails['entryfee']); ?></span>
                </div>
                <div class="form-control mt-6">
                    
                        <button type="button" class="btn btn-primary" onclick="location.href='/../backend/src/event.php?eventid=<?= htmlspecialchars($eventID) ?>'">Register Now</button>
                
                </div>
                <button onclick="redirectToHome()" class="btn btn-sm btn-primary" style="margin-top: 20px;">Home</button>
            </div>
        </div>

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

    <?php else: ?>
        <div class="text-white">Event details not found.</div>
    <?php endif; ?>
</body>
</html>
