<?php
  require_once __DIR__ . '/../scripts/databaseconnection.php';
function generateID($connection) {
    $idExists = true;
    $uniqueID = 0;

    while ($idExists) {
        $uniqueID = mt_rand(0, 9999); 


        $query = "
            SELECT EXISTS (
                SELECT 1 FROM Review WHERE ReviewID = ?
                UNION ALL
                SELECT 1 FROM AppUser WHERE UserID = ?
                UNION ALL
                SELECT 1 FROM Recipe WHERE RecipeID = ?
                UNION ALL
                SELECT 1 FROM EventDetails WHERE  EventID = ?
            ) AS idExists
        ";

        $stmt = $connection->prepare($query);

        $stmt->execute([$uniqueID, $uniqueID, $uniqueID, $uniqueID]);

        $exists = $stmt->fetchColumn();
        $idExists = (bool)$exists;
    }

    return $uniqueID;
}
