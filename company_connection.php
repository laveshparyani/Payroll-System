<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$companies = [];

// When user presses ok... data should get stored in database
if (isset($_POST['ok'])) {
    $id=$_POST['cid'];
    $name=$_POST['cname'];
    $address=$_POST['caddress'];
    $mail=$_POST['cmail'];

    // Escape the values to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $address = mysqli_real_escape_string($conn, $address);
    $mail = mysqli_real_escape_string($conn, $mail);

    // Check if the company ID already exists
    $checkQuery = "SELECT * FROM company WHERE company_id = $id";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // The company ID already exists, display an error message
        $errorMessage = "The company ID you have entered is already assigned to a company named \"$name\".";
    } else {
        // The company ID is unique, insert the new record
        $insertQuery = "INSERT INTO `company` (company_id, company_name, company_address, company_mail) VALUES ($id, '$name', '$address', '$mail')";
    }

    $stmt = "INSERT INTO `company` (company_id, company_name, company_address, company_mail) VALUES ($id, '$name', '$address', '$mail')";
    $result = mysqli_query($conn,$stmt);
}

// Retrieve existing company data from the database
$sql = "SELECT * FROM company";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row;
    }
}

// Close the database connection
$conn->close();
?>