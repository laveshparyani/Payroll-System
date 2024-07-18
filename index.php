<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head> 

<style>
  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #222;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    /* flex-direction: column; To place welcome admin text above the card */
  }

  .card {
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    width: 400px;
    max-width: 100%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
    color: #000;
    font-size: 24px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
  }

  /* .glow {
    animation: glowing 2s infinite;
  } */

  @keyframes glowing {
    0% {
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    50% {
      color: #bbb;
      text-shadow: none;
    }
    100% {
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    color: #333;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .username-icon {
    position: absolute;
    top: 43.7%;
    right: 608px;
    transform: translateY(-110%);
    cursor: pointer;
    height: 19px;
    width: 20px;
  }

  .eye-icon {
    position: absolute;
    top: 55%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    height: 24px;
    width: 26px;
  }

  button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #222;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #111;
  }

  .signup-link {
    text-align: center;
    margin-top: 20px;
    color: #333;
  }

  .error-message {
    color: red;
    margin-top: 10px;
    text-align: center;
  }

  .input-group {
    position: relative;
  }

  /* Decrease the font size for the forgot password link */
  .forgot-password-link {
    font-size: 14px;
  }

  @media (max-width: 500px) {
    .eye-icon {
      top: calc(50% - 10px);
      right: 5px;
    }

    .username-icon {
      top: calc(50% - 10px);
      right: 5px;
    }
  }

</style>

<body>
  <div class="container">
    <div class="card">
      <h1 class="glow">Welcome Admin</h1><br>
        <form action="login.php" method="POST" class="login-form">
          
          <div class="form-group">
            <label for="username">Enter Username</label>
            <input type="text" id="username" name="username" required>
            <img src="user.png" alt="Mail Icon" class="username-icon" id="username-icon">
          </div>
        
          <div class="form-group">
            <label for="password">Enter Password</label>
              <div class="input-group">
                <input type="password" id="password" name="password" required>
                <img src="eye_closed.png" alt="Eye Icon" class="eye-icon" id="eye-icon">
              </div>
          </div>

          <div class="form-group">
            <a href="forgot_password.php" class="forgot-password-link">Forgot Password?</a>
          </div>
        
          <div class="form-group">
            <button type="submit" name="submit">Login</button>
          </div>
        
        </form>

        <!-- Display error message if it exists -->
        <?php if (isset($error_message)) { ?>
          <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>

        <div class="signup-link"> Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    
    </div>
  </div>

  <script>
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
    var isPasswordVisible = false;
    var eyeClosedImg = "eye_closed.png";
    var eyeOpenImg = "eye_open.png";

    eyeIcon.addEventListener("click", function() {
      isPasswordVisible = !isPasswordVisible;
      passwordInput.type = isPasswordVisible ? "text" : "password";
      eyeIcon.src = isPasswordVisible ? eyeOpenImg : eyeClosedImg;
    });
  </script>
</body>
</html>
