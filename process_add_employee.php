<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the employee data from the POST request
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $employeeContact = $_POST['employeeContact'];
    $employeeAddress = $_POST['employeeAddress'];
    $employeeSalary = $_POST['employeeSalary'];
    $employeeCompany = $_POST['employeeCompany'];

    // Perform necessary validation on the input data (e.g., check for empty fields)
    if (empty($employeeId) || empty($employeeName) || empty($employeeContact) || empty($employeeAddress) || empty($employeeSalary) || empty($employeeCompany)) {
        $response['success'] = false;
        $response['message'] = 'Please enter all fields.';
    } else {
        // Your database connection and insert query code goes here...
        // For example:
        $conn = mysqli_connect("localhost", "root", "", "Payroll");
        $query = "INSERT INTO employee (emp_id, emp_name, emp_contact, emp_address, emp_salary, company_id) VALUES ('$employeeId', '$employeeName', '$employeeContact', '$employeeAddress', '$employeeSalary', '$employeeCompany')";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Employee data added successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to add employee data.';
        }
    }

    // Send the response (JSON format) to the frontend to handle the result
    echo json_encode($response);
}
