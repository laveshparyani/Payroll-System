<?php
require 'auth.php';
require_once 'connection.php';

// Delete a company (and its dependent rows) by ID, then return to the list.
if (isset($_GET['company_id'])) {
    $companyId = (int) $_GET['company_id'];

    // Remove dependent rows first, then the company (prepared statements).
    $stmt = mysqli_prepare($conn, "DELETE FROM designation WHERE company_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $companyId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($conn, "DELETE FROM employee WHERE company_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $companyId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($conn, "DELETE FROM company WHERE company_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $companyId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);
}

header('Location: company.php');
exit();
?>
