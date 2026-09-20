<?php
require 'auth.php';
require_once 'connection.php';

// Delete an employee by ID, then return to the employee list.
if (isset($_GET['emp_id'])) {
    $emp_id = (int) $_GET['emp_id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM employee WHERE emp_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $emp_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

header('Location: employee.php');
exit();
?>
