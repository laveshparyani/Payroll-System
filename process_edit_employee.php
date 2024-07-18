<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated employee data from the form
    $employeeName = $_POST['employeeName'];
    $employeeContact = $_POST['employeeContact'];
    $employeeAddress = $_POST['employeeAddress'];
    $employeeSalary = $_POST['employeeSalary'];
    $employeeCompany = $_POST['employeeCompany'];

    // Assuming you have already included the database connection code here...

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($conn, "UPDATE employee SET emp_name = ?, emp_contact = ?, emp_address = ?, emp_salary = ?, company_id = ? WHERE emp_id = ?");
    mysqli_stmt_bind_param($stmt, "ssssii", $employeeName, $employeeContact, $employeeAddress, $employeeSalary, $employeeCompany, $emp_id);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        $response = [
            'success' => true,
            'message' => 'Employee data updated successfully.'
        ];
    } else {
        // Update failed
        $response = [
            'success' => false,
            'message' => 'Failed to update employee data.'
        ];
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
