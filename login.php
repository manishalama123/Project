<?php
// Include the connection file
include 'connection.php';

// Start the session
session_start();

if (isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data based on the provided email
    $sql = "SELECT * FROM `userinfo` WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password == $row['password']) {
            // Login successful
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name']; // Store user's name in session
            header('Location: index.html'); // Redirect to chat page or any other page
            exit();
        } else {
            // Invalid password
            echo '<script>alert("Failed to login. Invalid password.");</script>';
        }
    } else {
        // Invalid email address or user not found
        echo '<script>alert("Failed to login. Invalid email address or user not found.");</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>

<link rel="stylesheet" href="login.css">
</head>
<body>
<!-- <header>
  <nav>
    <div class="logo">
      <img src="logo.png" alt="Logo">
    </div>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#">Contact</a></li>
     
    </ul>
  </nav>
</header> -->
<div class="container">

  <div class="signup-container">
    <img src="image/mitralogo.png" alt="error" >
    <h2>Don't have an account?</h2>
    <button id="signup-btn"><a href="signup.php">Sign Up<a></button>
  </div>
  <div class="login-container">
    <h2>Login</h2><br><br>
    <form method="post">
    <div class="form-group">
       <img src="image/manh.png" alt="error" >
      </div><br><br>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Email" style="background-image: url('image/email.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;">
        <span id="emailError" class="error"></span>
      </div>
      <div class="form-group">
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="Password" style="background-image: url('image/key.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;" >
        <span id="passwordError" class="error"></span>
      </div><br><br>
      <!-- <div class="form-group">
        <a href="#" class="forgetpassword.html">Forgot Password?</a>
      </div> -->
      <button type="submit" name="login" class="login-button">Login</button>
      
    </form>
  </div>
</div>

</body>
</html>
