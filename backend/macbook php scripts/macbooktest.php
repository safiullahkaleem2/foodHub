
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
// $createTableQuery = "CREATE TABLE IF NOT EXISTS test_table (
//     id SERIAL PRIMARY KEY,
//     FavouriteCuisine VARCHAR(30),
//     NumberofFollowers Integer DEFAULT 0,
//     name VARCHAR(50),
//     age INT
// )";
// $db->exec($createTableQuery);

// // Insert dummy values into the table
// $insertQuery = "INSERT INTO test_table (FavouriteCuisine, NumberofFollowers ,name, age) VALUES 
//     ('test1', 3, 'John Doe', 25),
//     ('test2', 4,'Jane Smith', 30),
//     ('test3', 6,'Alice Johnson', 40)";
// $db->exec($insertQuery);

// // Display the contents of the test_table
// $statement = $db->prepare("SELECT * FROM test_table");
// $statement->execute();
// echo "<h2>Contents of test_table:</h2>\n";
// while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//     echo "<p>ID: " . $row['id'] . ", FavouriteCuisine: " . htmlspecialchars($row['FavouriteCuisine']) . ", Name: " . htmlspecialchars($row['name']) . ", Age: " . $row['age'] . "</p>\n";
// }


$createTableQuery = "CREATE TABLE IF NOT EXISTS HomeCookDetails (
    FavouriteCuisine VARCHAR(30),
    NumberofFollowers Integer DEFAULT 0,
    NumberofFollowing Integer DEFAULT 0,
    Age Integer NOT NULL,
    Username VARCHAR(30),
    Password VARCHAR(30),
    PRIMARY KEY (Username, Password)
)";

$db->exec($createTableQuery);

$insertQuery = "INSERT INTO HomeCookDetails (FavouriteCuisine, NumberofFollowers, NumberofFollowing, Age, Username, Password)
VALUES
('Italian', 100, 50, 25, 'user1', 'password1'),
('Mexican', 200, 75, 30, 'user2', 'password2'),
('Japanese', 150, 60, 28, 'user3', 'password3')";

$db->exec($insertQuery);

// Display the contents of the HomeCookDetails table
$statement = $db->prepare("SELECT * FROM HomeCookDetails");
$statement->execute();
echo "<h2>Contents of HomeCookDetails table:</h2>\n";
echo "<table border='1'>\n";
echo "<tr><th>Favourite Cuisine</th><th>Number of Followers</th><th>Number of Following</th><th>Age</th><th>Username</th><th>Password</th></tr>\n";
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["FavouriteCuisine"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["NumberofFollowers"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["NumberofFollowing"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["Age"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["Password"]) . "</td>";
    echo "</tr>\n";
}
echo "</table>\n";


?>
</html>
