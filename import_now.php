<?php
// Script to import SQL file directly using MySQLi

$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db   = getenv('MYSQLDATABASE') ?: 'pepadun';
$port = getenv('MYSQLPORT') ?: 3306;

echo "Connecting to: $host:$port (DB: $db)<br>";

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

echo "Connected successfully!<br>";

$sql_file = __DIR__ . '/pepadun.sql';
if (!file_exists($sql_file)) {
    die("Error: pepadun.sql not found at $sql_file");
}

echo "Found SQL file. Importing...<br>";

$sql = file_get_contents($sql_file);

if ($mysqli->multi_query($sql)) {
    do {
        // Store first result set
        if ($result = $mysqli->store_result()) {
            $result->free();
        }
        // print divider
    } while ($mysqli->more_results() && $mysqli->next_result());
    
    echo "<h3>Database Import Finished Successfully!</h3>";
    echo "<br><b>Please check your app now!</b>";
} else {
    echo "Error during import: " . $mysqli->error;
}

$mysqli->close();
