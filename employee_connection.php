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

$employees = [];

// Retrieve existing employee data from the database
$sql_e = "SELECT * FROM employee";
$result_e = $conn->query($sql_e);

if ($result_e && $result_e->num_rows > 0) {
    while ($row = $result_e->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Close the database connection
$conn->close();
?>
