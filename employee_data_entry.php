    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Employee Data</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            body {
                background-color: #f0f0f0;
            }

            .container {
                max-width: 800px;
                margin: 20px auto;
            }

            .employee-card {
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .employee-card h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .btn-primary {
                background-color: #007bff;
                border: none;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
    <?php
            include_once("navbar.php");
        ?>  
        <div class="container">
            <div class="employee-card">
                <h2>Add Employee Data</h2>
                <form id="addEmployeeForm" method="POST">
                    <div class="form-group">
                        <label for="employeeName">Employee Name</label>
                        <input type="text" class="form-control" name="employeeName" id="employeeName">
                    </div>
                    <div class="form-group">
                        <label for="employeeContact">Employee Contact</label>
                        <input type="text" class="form-control" name="employeeContact" id="employeeContact">
                    </div>
                    <div class="form-group">
                        <label for="employeeAddress">Employee Address</label>
                        <input type="text" class="form-control" name="employeeAddress" id="employeeAddress">
                    </div>
                    <div class="form-group">
                        <label for="employeeSalary">Employee Salary</label>
                        <input type="text" class="form-control" name="employeeSalary" id="employeeSalary">
                    </div>
                    <div class="form-group">
                        <label for="employeeCompany">Employee Company</label>
                        <input type="text" class="form-control" name="employeeCompany" id="employeeCompany">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Employee Data</button>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#addEmployeeForm').on('submit', function(event) {
                    event.preventDefault();
                    var formData = $(this).serialize();

                    // Perform an AJAX request to add the employee data
                    $.ajax({
                        url: 'process_add_employee.php',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Check if the addition was successful
                            if (response.success) {
                                alert('Employee data added successfully.');
                                window.location.href = 'employee.php';
                            } else {
                                alert('Failed to add employee data.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while adding employee data.');
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
