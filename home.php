<?php $activePage = 'home'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
        body {
            background-color: #f5f5f5;
        }

        .container {
            padding: 40px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            color: #000;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #000;
            color: #fff;
            font-weight: bold;
            padding: 12px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-text {
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: #000;
            color: #fff;
        }

        .btn-custom:hover {
            color: red;
        }
        
        /* Styles specific to the cards */
        .card-container {
            margin-bottom: 20px;
        }

        .card-container .card-header {
            background-color: #000;
            color: #fff;
            font-weight: bold;
            padding: 12px 20px;
        }

        .card-container .card-body {
            padding: 20px;
        }

        .card-container .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-container .card-text {
            margin-bottom: 15px;
        }

        .card-container .btn-custom {
            background-color: #000;
            color: #fff;
        }

        .card-container .btn-custom:hover {
            color: red;
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container">
        <div class="row">
        <div class="col-md-6">
                <div class="card-container">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Company Management</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Manage your company's information.</p>
                            <a href="http://localhost/payroll_system/company.php" class="btn btn-custom">Go to Company Management</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-container">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Employee Management</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Manage your company's employees.</p>
                            <a href="http://localhost/payroll_system/employee.php" class="btn btn-custom">Go to Employee Management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
