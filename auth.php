<?php
// Session guard: include at the very top of every page that requires a
// logged-in admin. Redirects to the login page when there is no active session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}
