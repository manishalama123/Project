<?php
include 'connection.php';

if (isset($_POST['login'])) {
  $admin_name = $_POST['admin_name'];
  $admin_password = $_POST['admin_password'];

  // Query to fetch admin data
  $sql = "SELECT * FROM `admin_info` WHERE admin_name='$admin_name'";

  // Execute the query
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) == 1) {
      // Fetch the admin data
      $row = mysqli_fetch_assoc($result);

      // Verify the password
      if (password_verify($admin_password, $row['admin_password'])) { // Use password_verify to compare hashed passwords
         
          session_start();
          $_SESSION['admin_name'] = $admin_name;
          header('Location: admin.php'); 
          exit();
      } else {
         
          die(mysqli_error($con));
      }
  }

  mysqli_close($con);
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
        <input type="admin_name" id="name" name="admin_name" placeholder="admin_name" style="background-image: url('image/email.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;">
        <span id="admin_nameError" class="error"></span>
      </div>
      <div class="form-group">
        <label for="admin_password"></label>
        <input type="admin_password" id="admin_password" name="admin_password" placeholder="admin_password" style="background-image: url('image/key.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;" >
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
