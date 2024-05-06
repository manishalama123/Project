<?php

include 'connection.php';
session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $sql = "SELECT * FROM `userinfo` WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists, display error message
        echo '<script>alert("Email already exists. Please use a different email.");</script>';
    } else {
        // Email does not exist, insert new user data into the userinfo table
        $sql = "INSERT INTO `userinfo` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($con, $sql)) {
            // Sign up successful, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            header('Location: index.html');
            exit();
        } else {
            echo '<script>alert("Failed to sign up. Please try again.");</script>';
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #20324A;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 600px;
        height:600px;
        display: flex;
        flex-direction: column;
        color:#656363;
        
    }
    .error {
    color: red;
    font-size: 12px;
    display: inline-block;
    margin-left: 10px;
    float:right;
  }
    h2{
    text-align: center;
    margin-bottom: 20px;
    color: #f2961b;
    font-weight: 100;
    }
    /* Add this style to position the terms message container */
#terms-message-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    max-width: 80%; /* Adjust the width as needed */
    z-index: 999; /* Ensure it's above other elements */
}

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #7a7979;
        border-radius: 10px;
        box-sizing: border-box;
    }

    input[type="checkbox"] {
        margin-right: 5px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .btn-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn {
        padding: 10px;
        border: none;
        border-radius: 30px;
        background-color: #f2961b;
        color:black;
        font-size: 16px;
        cursor: pointer;
        width: 150px;
    }

    .btn:hover {
        background-color: transparent;
        border:2px solid #f2961b;
    }
    .form-group:last-child {
        margin-bottom: 0;
        text-align: center; 
    }

    .form-group:last-child a {
        display: inline-block; 
        margin-top: 10px; 
        font-size: 14px;
        font-weight:100;
        margin-left: 5px;
        color:#f2961b;
        text-decoration: none; 
    }

    .form-group:last-child a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<form name="signup" method="post" onsubmit="return validateForm()">
    <h2>Sign Up</h2>

    <div class="form-group">
        <label for="name">Name:</label>
        <span id="nameError" class="error"></span>
        <input type="text" id="name" name="name">
        <br>
</div>
    
    <div class="form-group">
        <label for="email">Email:</label><span id="emailError" class="error"></span><br>
        <input type="email" id="email" name="email">
        
    </div><br>

    <div class="form-group">
        <label for="password">Password:</label><span id="passwordError" class="error"></span><br>
        <input type="password" id="password" name="password">
        
    </div><br>
    <div class="form-group">
        <label for="repassword">Confirm Password:</label> <span id="repasswordError" class="error"></span><br>
        <input type="password" id="repassword" name="repassword">
       
    </div> <br>
   
    <div class="btn-container">
        <button type="submit" name ="submit" id="submit" class="btn">Sign Up</button>
    </div><span id="nameError" class="error"></span><br>

    <div class="form-group">
        <a href="admin_login.php">Already have an account?Login</a>
    </div>
</form>
<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        
        
       
        
    
        var isValid = true;
    
        // Validate Name
        if (name.trim() == '') {
            document.getElementById("nameError").textContent = 'Please enter your name';
            isValid = false;
        } else if (name.length < 8) {
            document.getElementById("nameError").textContent = 'Name should be at least 8 characters long';
            isValid = false;
        } else {
            document.getElementById("nameError").textContent = '';
        }
    
        
    
        // Validate Email
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailPattern)) {
            document.getElementById("emailError").textContent = 'Please enter a valid email address';
            isValid = false;
        } else {
            document.getElementById("emailError").textContent = '';
        }
    
        // Validate Password
        if (password.trim() == '') {
            document.getElementById("passwordError").textContent = 'Please enter your password';
            isValid = false;
        } else {
            document.getElementById("passwordError").textContent = '';
        }
    
        if (repassword.trim() == '') {
            document.getElementById("repasswordError").textContent = 'Please confirm your password';
            isValid = false;
        } else if (password != repassword) {
            document.getElementById("repasswordError").textContent = 'Passwords do not match';
            isValid = false;
        } else {
            document.getElementById("repasswordError").textContent = '';
        }
        
        return isValid;
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        const signupForm = document.getElementById('signupForm');

        // Add event listener to the form for form submission
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Call the validateForm function to validate the form inputs
            if (validateForm()) {
                // If the form is valid, submit the form
                signupForm.submit();
            }
        });
    });
</script>

</body>
</html>
