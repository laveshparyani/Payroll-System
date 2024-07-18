<?php $activePage = 'company'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Designation Details</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <style>
    /* Navigation Bar Styles */
    .navbar {
      background-color: #000;
      margin-bottom: 0;
    }

    .navbar-brand {
      margin-right: 50px;
      display: flex;
      align-items: center;
      margin-left: 20px;
    }

    .navbar-brand img {
      height: auto;
      width: auto;
      max-height: 40px;
      max-width: 150px;
      margin-right: 10px;
    }

    .navbar-toggler {
      color: #fff;
      border-color: #fff;
    }

    .navbar-toggler-icon {
      background-image: url('toggle-icon.png');
    }

    .navbar-nav .nav-link {
      color: #fff;
      margin-right: 20px;
      transition: color 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: #F8D210 !important;
      font-weight: bold;
    }

    /* Adjust space between table and navigation */
    .py-5 {
      padding-top: 20px !important;
      padding-bottom: 20px !important;
    }

    /* Table Styles */
    body {
      background-color: #fff;
    }

    table {
      color: #000;
    }

    thead {
      background-color: #000;
      color: #fff;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Pagination Styles */
    .pagination .page-link {
      color: #000;
      background-color: #fff;
      border-color: #000;
    }

    .pagination .page-item.active .page-link {
      background-color: #000;
      border-color: #000;
    }

    /* Card Styles */
    .card {
      margin-bottom: 40px;
      background-color: #f8f9fa;
      border-radius: 5px;
      padding: 20px;
    }

    .card-title {
      font-size: 20px;
      font-weight: bold;
      background-color: #000;
      color: #fff;
      padding: 10px;
      margin-bottom: 10px;
    }

    .card-text {
      font-size: 16px;
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
      .navbar-brand {
        margin-right: 0;
      }

      .navbar-brand img {
        max-width: 100px;
      }

      .navbar-nav .nav-link {
        margin-right: 0;
      }

      .navbar-collapse {
        justify-content: flex-end;
      }

      .navbar-nav {
        flex-direction: column;
        align-items: flex-end;
      }

      .navbar-nav .nav-item {
        margin-bottom: 10px;
      }

      .table-responsive {
        overflow-x: auto;
      }
    }
  </style>
</head>

<body>
  <?php include_once("navbar.php"); ?>

  <div class="container py-5">
    <?php
    // Fetch the company ID from the URL parameter
    $companyId = $_GET['company_id'];

    // Initialize the $designations array
    $designations = [];

    // Fetch data from the database
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

    // Fetch designation details for the selected company from the database
    $sqlDesignationDetails = "SELECT * FROM designation WHERE company_id = $companyId";
    $resultDesignationDetails = mysqli_query($conn, $sqlDesignationDetails);

    // Check if any designations are returned for the selected company
    if (mysqli_num_rows($resultDesignationDetails) > 0) {
      // Fetch company details from the database
      $sqlCompanyDetails = "SELECT company_name, company_address, company_mail FROM company WHERE company_id = $companyId";
      $resultCompanyDetails = mysqli_query($conn, $sqlCompanyDetails);
      $companyDetails = mysqli_fetch_assoc($resultCompanyDetails);

      // Display company details in a card
      echo '<div class="card">';
      echo '<h5 class="card-title">Company Details</h5>';
      echo '<div class="card-text"><span class="font-weight-bold"> Company Name: </span>' . $companyDetails['company_name'] . '</div>';
      echo '<div class="card-text"><span class="font-weight-bold"> Company Address: </span>' . $companyDetails['company_address'] . '</div>';
      echo '<div class="card-text"><span class="font-weight-bold"> Company Mail: </span>' . $companyDetails['company_mail'] . '</div>';
      echo '</div>';
      

      echo '<h3>DESIGNATION DETAILS</h3>';
      echo '<div class="table-responsive mt-3">';
      echo '<table id="example" class="table table-striped table-bordered custom-table">';
      echo '<thead><tr><th>Designation ID</th><th>Designation Name</th><th>Per Hour Salary</th><th>Per Month Salary</th><th>Per Hour OT Salary</th><th>Per Month OT Salary</th></tr></thead>';
      echo '<tbody>';

      // Iterate through each designation row and display the details
      while ($designationRow = mysqli_fetch_assoc($resultDesignationDetails)) {
        echo '<tr>';
        echo '<td>' . $designationRow['des_id'] . '</td>';
        echo '<td>' . $designationRow['des_name'] . '</td>';
        echo '<td>' . $designationRow['des_per_hour_sal'] . '</td>';
        echo '<td>' . $designationRow['des_per_month_sal'] . '</td>';
        echo '<td>' . $designationRow['des_per_hour_ot_sal'] . '</td>';
        echo '<td>' . $designationRow['des_per_month_ot_sal'] . '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
      echo '</div>';
    } else {
      echo '<p>No designation details found for the selected company.</p>';
    }
    ?>

  </div>

  <script>
    $(document).ready(function() {
      // Initialize the DataTable
      $('#example').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50],
        "pageLength": 10,
        "searching": true,
        "info": true,
        "language": {
          "paginate": {
            "previous": "Previous",
            "next": "Next"
          }
        }
      });
    });
  </script>
</body>

</html>