<?php
$emp_id = $_GET['emp_id']; // Get the employee ID from the URL parameter (GET request)

// Your database connection and other necessary code to fetch the employee data goes here...
// For example:
// $employee = fetchEmployeeData($emp_id); // Implement the 'fetchEmployeeData' function to fetch the data
// Ensure that the $employee variable is populated with the employee data before proceeding.

// Example code:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Payroll";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute the select statement to fetch employee data
$stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE emp_id = ?");
mysqli_stmt_bind_param($stmt, "i", $emp_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the employee details
$employee = mysqli_fetch_assoc($result);

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
            <!-- Display the existing employee data in the input fields -->
            <div class="form-group">
                <label for="employeeName">Employee Name:</label>
                <input type="text" class="form-control" name="employeeName" id="employeeName" value="<?php echo $employee['emp_name']; ?>">
            </div>
            <div class="form-group">
                <label for="employeeContact">Employee Contact:</label>
                <input type="text" class="form-control" name="employeeContact" id="employeeContact" value="<?php echo $employee['emp_contact']; ?>">
            </div>
            <div class="form-group">
                <label for="employeeAddress">Employee Address:</label>
                <input type="text" class="form-control" name="employeeAddress" id="employeeAddress" value="<?php echo $employee['emp_address']; ?>">
            </div>
            <div class="form-group">
                <label for="employeeSalary">Employee Salary:</label>
                <input type="text" class="form-control" name="employeeSalary" id="employeeSalary" value="<?php echo $employee['emp_salary']; ?>">
            </div>
            <div class="form-group">
                <label for="employeeCompany">Employee Company:</label>
                <input type="text" class="form-control" name="employeeCompany" id="employeeCompany" value="<?php echo $employee['company_id']; ?>">
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
