<?php require 'auth.php'; $activePage = 'company'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company</title>

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
    // Initialize the $companies array with existing company data
    $companies = [];

    // Use the shared connection (reads config.local.php on the server)
    require_once 'connection.php';

    // Fetch data from the database
    $sql = "SELECT * FROM company";
    $result = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
      // Iterate through each company row
      while ($row = mysqli_fetch_assoc($result)) {
        $company = $row;
        $companyId = $company['company_id'];

        // Fetch designations for the current company (prepared to avoid injection)
        $stmtD = mysqli_prepare($conn, "SELECT * FROM designation WHERE company_id = ?");
        mysqli_stmt_bind_param($stmtD, "i", $companyId);
        mysqli_stmt_execute($stmtD);
        $resultDesignation = mysqli_stmt_get_result($stmtD);

        // Check if any designations are returned for the current company
        if (mysqli_num_rows($resultDesignation) > 0) {
          // Iterate through each designation row and add it to the $designations array
          while ($designationRow = mysqli_fetch_assoc($resultDesignation)) {
            $company['designations'][] = $designationRow;
          }
        } else {
          // If no designations are found, initialize an empty array for designations
          $company['designations'] = [];
        }

        $companies[] = $company;
      }
    }
    ?>

    <button type="button" class="btn btn-primary" id="addDataButton">ADD DATA</button>
    <div class="table-responsive mt-5">
      <table id="example" class="table table-striped table-bordered custom-table">
        <thead>
          <tr>
            <th>Company ID</th>
            <th>Company Name</th>
            <th>Company Address</th>
            <th>Company Mail</th>
            <th>Designation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="companyTableBody">
          <?php
          // Iterate through each company
          foreach ($companies as $company) {
            $cid = (int) $company['company_id'];
            echo '<tr>';
            echo '<td>' . htmlspecialchars($company['company_id']) . '</td>';
            echo '<td>' . htmlspecialchars($company['company_name']) . '</td>';
            echo '<td>' . htmlspecialchars($company['company_address']) . '</td>';
            echo '<td>' . htmlspecialchars($company['company_mail']) . '</td>';

            echo '<td>';
            echo '<a href="designation_details.php?company_id=' . $cid . '"><i class="fas fa-eye" style="color: #000;"></i> Check Designation Details</a>';
            echo '</td>';

            echo '<td class="action-column">';
            echo '<a href="edit_company.php?company_id=' . $cid . '"><i class="fas fa-edit" style="color: #000;"></i></a>';
            echo '<a href="delete_company.php?company_id=' . $cid . '"><i class="fas fa-trash-alt" style="color: #000;"></i></a>';
            echo '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      var table;
      var companies = <?php echo json_encode($companies); ?>;

      function initializeDataTable() {
        table = $('#example').DataTable({
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
      }

      // Initialize the DataTable
      initializeDataTable();

      // Redirect to 'company_data_entry.php' when Add Data button is clicked
      $('#addDataButton').on('click', function() {
        window.location.href = 'company_data_entry.php';
      });
    });
  </script>
</body>

</html>
