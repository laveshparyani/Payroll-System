<?php
require 'auth.php';
require_once 'connection.php';

$activePage = 'company';
$errorMessage = '';

// Handle the submitted company + designations.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cname'])) {
    $cname    = trim($_POST['cname']);
    $caddress = trim($_POST['caddress']);
    $cmail    = trim($_POST['cmail']);

    if ($cname === '' || $caddress === '' || $cmail === '') {
        $errorMessage = 'Please fill in all company fields.';
    } else {
        // Insert the company (company_id is auto-increment).
        $stmt = mysqli_prepare($conn, "INSERT INTO company (company_name, company_address, company_mail) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $cname, $caddress, $cmail);

        if (mysqli_stmt_execute($stmt)) {
            $newCompanyId = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);

            // Insert each designation row for this company.
            $names = $_POST['desname'] ?? [];
            $ph    = $_POST['perhour'] ?? [];
            $pm    = $_POST['permonth'] ?? [];
            $pho   = $_POST['perhourot'] ?? [];
            $pmo   = $_POST['permonthot'] ?? [];

            $dstmt = mysqli_prepare($conn, "INSERT INTO designation (designation_name, per_hour_salary, per_month_salary, per_hour_ot_salary, per_month_ot_salary, company_id) VALUES (?, ?, ?, ?, ?, ?)");
            for ($i = 0; $i < count($names); $i++) {
                if (trim($names[$i]) === '') {
                    continue;
                }
                $dName = $names[$i];
                $dPh   = $ph[$i]  ?? 0;
                $dPm   = $pm[$i]  ?? 0;
                $dPho  = $pho[$i] ?? 0;
                $dPmo  = $pmo[$i] ?? 0;
                mysqli_stmt_bind_param($dstmt, "sddddi", $dName, $dPh, $dPm, $dPho, $dPmo, $newCompanyId);
                mysqli_stmt_execute($dstmt);
            }
            mysqli_stmt_close($dstmt);
            mysqli_close($conn);

            header('Location: company.php');
            exit();
        } else {
            $errorMessage = 'Failed to add company.';
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Data Entry</title>
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

        .company-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .designation-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .designation-card h5 {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #dc3545;
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
        <div class="company-card">
            <h2 class="text-center">COMPANY DATA ENTRY</h2>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
            <?php endif; ?>

            <form method="POST" action="company_data_entry.php">
                <h5>Company Details</h5>
                <div class="form-group">
                    <label for="cname">Company Name</label>
                    <input type="text" id="cname" name="cname" class="form-control" placeholder="Enter company name" required>
                </div>

                <div class="form-group">
                    <label for="caddress">Company Address</label>
                    <input type="text" id="caddress" name="caddress" class="form-control" placeholder="Enter company address" required>
                </div>

                <div class="form-group">
                    <label for="cmail">Company Email</label>
                    <input type="email" id="cmail" name="cmail" class="form-control" placeholder="Enter Gmail address" required>
                </div>
            </div>

            <div id="designationContainer">
                <div class="designation-card">
                    <h5>Designation Details</h5>
                    <div class="form-group">
                        <label for="desname">Designation</label>
                        <input type="text" id="desname" name="desname[]" class="form-control" placeholder="Enter designation" required>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="perhour">Per Hour Salary</label>
                            <input type="number" id="perhour" name="perhour[]" class="form-control" placeholder="Enter per hour salary" required>
                        </div>
                        <div class="col">
                            <label for="permonth">Per Month Salary</label>
                            <input type="number" id="permonth" name="permonth[]" class="form-control" placeholder="Enter per month salary" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="perhourot">Per Hour OT Salary</label>
                            <input type="number" id="perhourot" name="perhourot[]" class="form-control" placeholder="Enter per hour OT salary" required>
                        </div>
                        <div class="col">
                            <label for="permonthot">Per Month OT Salary</label>
                            <input type="number" id="permonthot" name="permonthot[]" class="form-control" placeholder="Enter per month OT salary" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="addDesignation()"><i class="fas fa-plus"></i> Add Designation</button>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                <button type="button" class="btn btn-danger" onclick="clearForm()"><i class="fas fa-times"></i> Clear Form</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addDesignation() {
            const container = document.getElementById('designationContainer');
            const designationIndex = container.childElementCount + 1;

            const designationCard = document.createElement('div');
            designationCard.classList.add('designation-card');
            designationCard.innerHTML = `
                <h5>Designation Details</h5>
                <div class="form-group">
                    <label for="desname">Designation</label>
                    <input type="text" id="desname" name="desname[]" class="form-control" placeholder="Enter designation" required>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="perhour">Per Hour Salary</label>
                        <input type="number" id="perhour" name="perhour[]" class="form-control" placeholder="Enter per hour salary" required>
                    </div>
                    <div class="col">
                        <label for="permonth">Per Month Salary</label>
                        <input type="number" id="permonth" name="permonth[]" class="form-control" placeholder="Enter per month salary" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="perhourot">Per Hour OT Salary</label>
                        <input type="number" id="perhourot" name="perhourot[]" class="form-control" placeholder="Enter per hour OT salary" required>
                    </div>
                    <div class="col">
                        <label for="permonthot">Per Month OT Salary</label>
                        <input type="number" id="permonthot" name="permonthot[]" class="form-control" placeholder="Enter per month OT salary" required>
                    </div>
                </div>
            `;

            container.appendChild(designationCard);
        }

        function clearForm() {
            const container = document.getElementById('designationContainer');
            container.innerHTML = '';
        }
    </script>
</body>
</html>
