<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Payroll";

// Environment-specific overrides (not committed to git). Present on the
// hosting server, absent locally, so local development keeps the defaults above.
if (file_exists(__DIR__ . '/config.local.php')) {
    include __DIR__ . '/config.local.php';
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Close the database connection
// $conn->close();
?>