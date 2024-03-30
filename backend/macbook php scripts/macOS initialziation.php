<?php

require_once('backend/scripts/scripts.php');

$db = new PDO('pgsql:host=localhost');

$db->beginTransaction();
$createQuery($db);
$db->commit()



$statement = $db->prepare("SELECT datname FROM pg_database");
$statement->execute();
while ($row = $statement->fetch()) {
    echo "<p>" . htmlspecialchars($row["datname"]) . "</p>\n";
}


?>