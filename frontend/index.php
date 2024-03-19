
<html>
<?php

require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$connection_string = "host=" . $_ENV['DB_HOST'] .
                     " dbname=" . $_ENV['DB_NAME'] .
                     " user=" . $_ENV['DB_USER'] .
                     " password='" . $_ENV['DB_PASS'] . "'";



$db = pg_connect($connection_string);
if ($db) {
    echo "Successfully connected to PostgreSQL.\n";

     $createQuery = "DROP TABLE IF EXISTS Users; 
     CREATE TABLE Users (
         userid SERIAL,
         username VARCHAR(32) UNIQUE NOT NULL,
         password TEXT NOT NULL,
         isActive BOOLEAN NOT NULL DEFAULT TRUE,
         PRIMARY KEY (userid)
     );";


$result = pg_query($db, $createQuery);

if ($result) {
echo "Table 'Users' created successfully.<br>";


$structureQuery = "SELECT column_name, data_type, character_maximum_length,
            is_nullable, column_default 
            FROM information_schema.columns 
            WHERE table_name = 'users' 
            ORDER BY ordinal_position;";

$structureResult = pg_query($db, $structureQuery);

if ($structureResult) {
echo "<table border='1'>
     <tr>
         <th>Column Name</th>
         <th>Data Type</th>
         <th>Max Length</th>
         <th>Nullable</th>
         <th>Default Value</th>
     </tr>";

while ($row = pg_fetch_assoc($structureResult)) {
 echo "<tr>
         <td>{$row['column_name']}</td>
         <td>{$row['data_type']}</td>
         <td>{$row['character_maximum_length']}</td>
         <td>{$row['is_nullable']}</td>
         <td>{$row['column_default']}</td>
       </tr>";
}
echo "</table>";
} else {
echo "Error in executing the structure query: " . pg_last_error($db);
}

} else {
echo "Error in creating table: " . pg_last_error($db);
}

pg_close($db); 

} else {
    echo "PostgreSQL connection error.";
}
?>
</html>
