// fetchEventDetails.php
<?php

$eventDetails = null;
$eventLocation = null;
$isRegistered = false;

if (isset($_SESSION['eventid'])) {
    $eventID = $_SESSION['eventid'];

    require_once __DIR__ . '/../scripts/databaseconnection.php';

    
    try {
        $stmt = $connection->prepare("SELECT * FROM EventDetails WHERE EventID = :eventid");
        $stmt->execute(['eventid' => $eventID]);
        $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    try {
        $stmt = $connection->prepare("SELECT * FROM EventLocation WHERE Category = :eventcategory AND EntryFee = :eventfee");
        $stmt->bindParam(':eventcategory', $favouriteCuisine);
        $stmt->bindParam(':eventfee', $id);
        $stmt->execute();
        $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }



    if (isset($_SESSION['userid'])) {
        $userID = $_SESSION['userid'];

        try {
            $registrationCheckSql = "SELECT COUNT(*) FROM Participates WHERE EventID = :eventid AND UserID = :userid";
            $registrationCheckStmt = $connection->prepare($registrationCheckSql);
            $registrationCheckStmt->execute([':eventid' => $eventID, ':userid' => $userID]);
            
            if ($registrationCheckStmt->fetchColumn() > 0) {
                $isRegistered = true;
            }
        } catch (PDOException $e) {
            die("Error checking registration status: " . $e->getMessage());
        }
    }
} else {
    die("Event ID not found in session.");
}
?>
