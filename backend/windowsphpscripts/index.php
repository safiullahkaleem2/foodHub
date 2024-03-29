
<html>
<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once('../scripts/scripts.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();


$connection_string = "host=" . $_ENV['DB_HOST'] .
                     " dbname=" . $_ENV['DB_NAME'] .
                     " user=" . $_ENV['DB_USER'] .
                     " password=" . $_ENV['DB_PASS'];


$db = pg_connect($connection_string);
if ($db) {
    echo "Successfully connected to PostgreSQL.\n";
    createTables($db);




   pg_close($db); 
 
}
?>
</html>