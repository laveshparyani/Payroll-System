<?php
require 'auth.php';
require_once 'connection.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and trim the submitted employee data.
    $employeeName    = trim($_POST['employeeName'] ?? '');
    $employeeContact = trim($_POST['employeeContact'] ?? '');
    $employeeAddress = trim($_POST['employeeAddress'] ?? '');
    $employeeSalary  = $_POST['employeeSalary'] ?? '';
    $employeeCompany = $_POST['employeeCompany'] ?? '';

    if ($employeeName === '' || $employeeContact === '' || $employeeAddress === '' || $employeeSalary === '' || $employeeCompany === '') {
        $response['message'] = 'Please enter all fields.';
    } else {
        // emp_id is auto-increment, so it is not supplied here.
        $stmt = mysqli_prepare($conn, "INSERT INTO employee (emp_name, emp_contact, emp_address, emp_salary, company_id) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssdi", $employeeName, $employeeContact, $employeeAddress, $employeeSalary, $employeeCompany);

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Employee data added successfully.';
        } else {
            $response['message'] = 'Failed to add employee data. Make sure the company ID exists.';
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

echo json_encode($response);
?>
