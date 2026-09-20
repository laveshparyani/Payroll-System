<?php
require 'auth.php';
require_once 'connection.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The edit form submits the employee id in a hidden field.
    $emp_id          = (int) ($_POST['emp_id'] ?? 0);
    $employeeName    = trim($_POST['employeeName'] ?? '');
    $employeeContact = trim($_POST['employeeContact'] ?? '');
    $employeeAddress = trim($_POST['employeeAddress'] ?? '');
    $employeeSalary  = $_POST['employeeSalary'] ?? '';
    $employeeCompany = $_POST['employeeCompany'] ?? '';

    $stmt = mysqli_prepare($conn, "UPDATE employee SET emp_name = ?, emp_contact = ?, emp_address = ?, emp_salary = ?, company_id = ? WHERE emp_id = ?");
    mysqli_stmt_bind_param($stmt, "sssdii", $employeeName, $employeeContact, $employeeAddress, $employeeSalary, $employeeCompany, $emp_id);

    if (mysqli_stmt_execute($stmt)) {
        $response['success'] = true;
        $response['message'] = 'Employee data updated successfully.';
    } else {
        $response['message'] = 'Failed to update employee data.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

echo json_encode($response);
?>
