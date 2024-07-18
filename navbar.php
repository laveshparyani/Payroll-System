<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <style>
        /* Navigation Bar Styles */
        .navbar {
            background-color: #000;
            margin-bottom: 0; /* Remove margin-bottom to eliminate space above navbar */
        }

        .navbar-brand {
            margin-right: 50px;
            display: flex;
            align-items: center;
            margin-left: 20px; /* Add left margin as per your preference */
        }

        .navbar-brand img {
            height: auto;
            width: auto;
            max-height: 40px; /* Set the maximum height as per your preference */
            max-width: 150px; /* Set the maximum width as per your preference */
            margin-right: 10px;
        }

        .navbar-toggler {
            color: red;
            border-color: red;
        }

        .navbar-toggler-icon {
            background-image: url('toggle-icon.png');
        }

        .navbar-nav .nav-link {
            color: red;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: red !important;
            font-weight: bold;
        }

        /* Adjust space between table and navigation */
        .py-5 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* Responsive Styles */
        @media (max-width: 767px) {
            .navbar-brand {
                margin-right: 0;
            }

            .navbar-brand img {
                max-width: 100px; /* Adjust the maximum width for mobile view */
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
        }

        .py-5 {
            padding-top: 50px !important;
            padding-bottom: 20px !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="asset/logo.png" alt="Company Logo">
            ISB Security
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo ($activePage == 'home') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/home.php">Home</a>
                </li>
                <li class="nav-item <?php echo ($activePage == 'company') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/company.php">Company</a>
                </li>
                <li class="nav-item <?php echo ($activePage == 'employee') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/employee.php">Employee</a>
                </li>
                <li class="nav-item <?php echo ($activePage == 'payment') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/payment.php">Payment</a>
                </li>
                <li class="nav-item <?php echo ($activePage == 'settings') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/settings.php">Setting</a>
                </li>
                <li class="nav-item <?php echo ($activePage == 'logout') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/payroll_system/index.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>
