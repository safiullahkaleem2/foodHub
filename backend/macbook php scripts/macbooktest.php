
<html>
    <h1>test</h1>
    <p>123</p>
<?php
$db = new PDO('pgsql:host=localhost');
$statement = $db->prepare("SELECT datname FROM pg_database");
$statement->execute();
while ($row = $statement->fetch()) {
    echo "<p>" . htmlspecialchars($row["datname"]) . "</p>\n";
}

// Create a table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS test_table (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50),
    age INT
)";
$db->exec($createTableQuery);

// Insert dummy values into the table
$insertQuery = "INSERT INTO test_table (name, age) VALUES 
    ('John Doe', 25),
    ('Jane Smith', 30),
    ('Alice Johnson', 40)";
$db->exec($insertQuery);

// Display the contents of the dummy_table
$statement = $db->prepare("SELECT * FROM test_table");
$statement->execute();
echo "<h2>Contents of test_table:</h2>\n";
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>ID: " . $row['id'] . ", Name: " . htmlspecialchars($row['name']) . ", Age: " . $row['age'] . "</p>\n";
}

?>
</html>
