<?php
$emp_id = $_GET['emp_id']; // Get the employee ID from the URL parameter (GET request)
// Your database connection and other necessary code to fetch and delete the employee data goes here...
// For example:
// $employee = fetchEmployeeData($emp_id); // Implement the 'fetchEmployeeData' function to fetch the data

// Perform the deletion of employee data (You should also implement error handling)
//$isDeleted = deleteEmployeeData($emp_id);

// Send the response (JSON format) to the frontend to handle the result
$response = array();
if ($isDeleted) {
    $response['success'] = true;
    $response['message'] = 'Employee data deleted successfully.';
} else {
    $response['success'] = false;
    $response['message'] = 'Failed to delete employee data.';
}

echo json_encode($response);
