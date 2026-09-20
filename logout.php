<?php
// Destroy the session and return to the login page.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];
session_destroy();

header('Location: index.php');
exit();
