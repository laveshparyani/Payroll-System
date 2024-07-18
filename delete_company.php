<?php
// Check if the company ID is provided
if (isset($_GET['company_id'])) {
  $companyId = $_GET['company_id'];

  // Perform the necessary delete operations on the database using the provided company ID

  // Create a connection to the database
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

  // Delete the designations related to the company
  $sqlDeleteDesignations = "DELETE FROM designation WHERE company_id = $companyId";
  if (mysqli_query($conn, $sqlDeleteDesignations)) {
    // Designations deleted successfully

    // Now delete the company
    $sqlDeleteCompany = "DELETE FROM company WHERE company_id = $companyId";
    if (mysqli_query($conn, $sqlDeleteCompany)) {
      // Company deleted successfully

      // Redirect to the company listing page after the delete
      header('Location: company.php');
      exit();
    } else {
      echo "Error deleting company: " . mysqli_error($conn);
    }
  } else {
    echo "Error deleting designations: " . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
} else {
  // Redirect to the company listing page if the company ID is not provided
  header('Location: company.php');
  exit();
}
?>