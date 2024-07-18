<?php
require_once "connection.php";

// Define variables to store user input
$name = $email = $username = $password = $confirmPassword = "";
$error_message = "";

if (isset($_POST['submit'])) {
  // Retrieve user inputs
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];

  // Check if password and confirm password match
  if ($password !== $confirmPassword) {
    $error_message = "Password entered is invalid! Please enter the correct password.";
  } else {
    // Hash the password
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the INSERT statement
    $stmt = $conn->prepare("INSERT INTO admin (name, mail_id, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $username, $password);
    $stmt->execute();

    if ($stmt->error) {
      die("Error: " . $stmt->error);
    }

    // Redirect the user to the login page
    header("Location: index.php");
    exit();
  }

  $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Your existing CSS styles */

/* Additional styles for the signup page */
body {
  background-color: #222;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #222;
  flex-direction: column;
}

.signup-heading {
  text-align: center;
  color: #fff;
  font-family: "Innova Alt Bold", Arial, sans-serif;
  font-size: 36px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  margin-bottom: 20px;
}

.card {
  background-color: #fff;
  padding: 30px;
  border-radius: 5px;
  width: 450px;
  max-width: 100%;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: black;
  font-size: 24px;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.card .signup-form {
  margin-top: 20px;
}

.card .form-group {
  margin-bottom: 20px;
}

.card label {
  display: block;
  margin-bottom: 5px;
  color: #fff;
  font-weight: bold;
}

.card input[type="text"],
.card input[type="email"],
.card input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-family: Arial, sans-serif;
}

.card input[type="text"]::placeholder,
.card input[type="email"]::placeholder,
.card input[type="password"]::placeholder {
  color: #aaa;
}

.card .eye-icon {
  position: absolute;
  top: 456px;
  right: 535px;
  transform: translateY(-50%);
  cursor: pointer;
  height: 28px;
  width: 30px;
}

.card button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #222;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-family: Arial, sans-serif;
}

.card button:hover {
  background-color: #111;
}

.card .signup-link {
  text-align: center;
  margin-top: 20px;
  color: black;
}

.card .error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}

.card label {
    display: block;
    margin-bottom: 5px;
    color: black; /* Updated color to black */
    font-weight: bold;
  }

  </style>
</head>

<body>
  <div class="container">
  <h1 class="signup-heading">Sign Up</h1>
    <div class="card">
      <form action="signup.php" method="POST" class="signup-form">
      
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required placeholder="Enter your name" value="<?php echo $name; ?>">
        </div>

        <div class="form-group">
          <label for="email">E-Mail</label>
          <input type="email" id="email" name="email" required placeholder="Enter your email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required placeholder="Enter a username" value="<?php echo $username; ?>">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <input type="password" id="password" name="password" required placeholder="Enter a password" value="<?php echo $password; ?>">
            <img src="eye_closed.png" alt="Eye Icon" class="eye-icon" id="eye-icon">
          </div>
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
          <?php if ($error_message) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
          <?php } ?>
        </div>

        <div class="form-group">
          <button type="submit" name="submit">Sign Up</button>
        </div>
      </form>

      <div class="signup-link">Already have an account? <a href="index.php">Login</a></div>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    eyeIcon.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.src = 'eye_open.png';
      } else {
        passwordInput.type = 'password';
        eyeIcon.src = 'eye_closed.png';
      }
    });
  </script>
</body>

</html>