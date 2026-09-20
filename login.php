<?php
session_start();
require_once "connection.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Look up the admin by username only, then verify the hashed password.
    $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($row && password_verify($password, $row['password'])) {
        // Credentials are valid: start an authenticated session.
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: home.php");
        exit();
    }

    // Invalid credentials: flash an error and return to the login page.
    $_SESSION['login_error'] = "Username or Password is invalid! Please enter your details again.";
    header("Location: index.php");
    exit();
}

$conn->close();
?>
