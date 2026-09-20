<?php
require 'auth.php';
require_once 'connection.php';

$emp_id = isset($_GET['emp_id']) ? (int) $_GET['emp_id'] : 0;

// Fetch the employee to edit (prepared statement).
$stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE emp_id = ?");
mysqli_stmt_bind_param($stmt, "i", $emp_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$employee = mysqli_fetch_assoc($result);

if (!$employee) {
    echo "No employee found with the given ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Data</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <?php
    include_once("navbar.php");
    ?>
    <div class="container py-5">
        <h2>Edit Employee Data</h2>
        <form id="editEmployeeForm" method="POST">
            <!-- Hidden employee id so the server knows which row to update -->
            <input type="hidden" name="emp_id" value="<?php echo (int) $employee['emp_id']; ?>">
            <!-- Display the existing employee data in the input fields -->
            <div class="form-group">
                <label for="employeeName">Employee Name:</label>
                <input type="text" class="form-control" name="employeeName" id="employeeName" value="<?php echo htmlspecialchars($employee['emp_name']); ?>">
            </div>
            <div class="form-group">
                <label for="employeeContact">Employee Contact:</label>
                <input type="text" class="form-control" name="employeeContact" id="employeeContact" value="<?php echo htmlspecialchars($employee['emp_contact']); ?>">
            </div>
            <div class="form-group">
                <label for="employeeAddress">Employee Address:</label>
                <input type="text" class="form-control" name="employeeAddress" id="employeeAddress" value="<?php echo htmlspecialchars($employee['emp_address']); ?>">
            </div>
            <div class="form-group">
                <label for="employeeSalary">Employee Salary:</label>
                <input type="text" class="form-control" name="employeeSalary" id="employeeSalary" value="<?php echo htmlspecialchars($employee['emp_salary']); ?>">
            </div>
            <div class="form-group">
                <label for="employeeCompany">Employee Company:</label>
                <input type="text" class="form-control" name="employeeCompany" id="employeeCompany" value="<?php echo htmlspecialchars($employee['company_id']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editEmployeeForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                // Perform an AJAX request to update the employee data
                $.ajax({
                    url: 'process_edit_employee.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Check if the update was successful
                        if (response.success) {
                            alert('Employee data updated successfully.');
                            window.location.href = 'employee.php';
                        } else {
                            alert('Failed to update employee data.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating employee data.');
                    }
                });
            });
        });
    </script>
</body>

</html>
