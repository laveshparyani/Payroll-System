<?php
require_once "connection.php";

if (isset($_POST['submit'])) { 
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    if ($stmt->error) {
        die("Error: " . $stmt->error);
    }    

    // Get the result of the SELECT query
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Username and password are correct
        // Redirect the user to home.php
        header("Location: home.php");
        exit();
    } else {
        // Username or password is invalid
        $error_message = "Username or Password is invalid! Please enter your details again.";
        header("Location: index.php");
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
