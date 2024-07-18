<?php
require_once 'connection.php';

if (isset($_GET['company_id'])) {
    $companyId = $_GET['company_id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the updated company data from the form
        $companyName = $_POST['company_name'];
        $companyAddress = $_POST['company_address'];
        $companyMail = $_POST['company_mail'];

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and execute the update statement
        $stmt = mysqli_prepare($conn, "UPDATE company SET company_name = ?, company_address = ?, company_mail = ? WHERE company_id = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $companyName, $companyAddress, $companyMail, $companyId);
        mysqli_stmt_execute($stmt);

        // Return the updated company data as a JSON response
        $response = [
            'success' => true,
            'message' => 'Company data updated successfully.',
            'company' => [
                'company_id' => $companyId,
                'company_name' => $companyName,
                'company_address' => $companyAddress,
                'company_mail' => $companyMail,
            ],
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the select statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM company WHERE company_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $companyId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the company details
    $company = mysqli_fetch_assoc($result);

    // Include the navbar.php file
    include 'navbar.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Company</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>

    <body>
        <div class="container py-5">
            <h2>Edit Company</h2>
            <form id="editCompanyForm" method="POST">
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $company['company_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="company_address">Company Address:</label>
                    <input type="text" class="form-control" name="company_address" id="company_address" value="<?php echo $company['company_address']; ?>">
                </div>
                <div class="form-group">
                    <label for="company_mail">Company Mail:</label>
                    <input type="email" class="form-control" name="company_mail" id="company_mail" value="<?php echo $company['company_mail']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

        <script>
            $(document).ready(function() {
                // Submit the form via AJAX when the Save Changes button is clicked
                $('#editCompanyForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting normally

                    // Get the form data
                    var formData = $(this).serialize();

                    // Perform an AJAX request to update the company data
                    $.ajax({
                        url: 'edit_company.php?company_id=<?php echo $companyId; ?>', // PHP script that handles the form submission
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Check if the update was successful
                            if (response.success) {
                                // Show a success message
                                Swal.fire({
                                    icon: 'success',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Redirect to the company listing page after a brief delay
                                    window.location.href = 'company.php';
                                });
                            } else {
                                // Show an error message
                                Swal.fire({
                                    icon: 'error',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            // Show an error message if the AJAX request fails
                            Swal.fire({
                                icon: 'error',
                                text: 'An error occurred while updating the company data.'
                            });
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    echo "No company found with the given ID.";
}
?>