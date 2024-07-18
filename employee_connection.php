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

$employees = [];

// When user presses ok... data should get stored in database
if (isset($_POST['ok'])) {
    $id=$_POST['eid'];
    $name=$_POST['ename'];
    $contact=$_POST['econtact'];
    $address=$_POST['eaddress'];
    $salary=$_POST['esalary'];
    $company=$_POST['ecompany'];

    // $name="'".$name."'";
    // $address="'".$address."'";
    // $mail="'".$mail."'";

    $stmt = "INSERT INTO `employee` (emp_id, emp_name, emp_contact, emp_address, emp_salary, company_id) VALUES ($id, '$name', '$contact', '$address', '$salary', '$company')";

    $result = mysqli_query($conn,$stmt);
}

// Retrieve existing company data from the database
$sql_e = "SELECT * FROM employee";
$result_e = $conn->query($sql_e);

if ($result_e->num_rows > 0) {
    while ($row = $result_e->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Close the database connection
$conn->close();
?>