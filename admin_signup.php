<?php
include 'connection.php';

session_start();

if (isset($_POST['submit'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    if (!empty($admin_name) && !empty($admin_password)) {
        // Hash the admin password before storing it in the database
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert admin data into the admin_info table
        $stmt = $con->prepare("INSERT INTO admin_info (admin_name, admin_password) VALUES (?, ?)");
        $stmt->bind_param("ss", $admin_name, $hashed_password);

        if ($stmt->execute()) {
            // Admin signup successful
            $_SESSION['admin_name'] = $admin_name;
            header('Location: admin.php');
            exit();
        } else{
            die(mysqli_error($con));

        }}}
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
        height:500px;
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
<form name="signup" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
    <h2>Admin Sign Up</h2><br><br>

    <div class="form-group">
        <label for="admin_name">Admin Name:</label>
        <span id="adminNameError" class="error"></span>
        <input type="text" id="admin_name" name="admin_name">
    </div>
   
    <div class="form-group">
        <label for="admin_password">Password:</label>
        <span id="adminPasswordError" class="error"></span>
        <input type="password" id="admin_password" name="admin_password">
    </div>

    <div class="form-group">
        <label for="repassword">Confirm Password:</label>
        <span id="repasswordError" class="error"></span>
        <input type="password" id="repassword" name="repassword">
    </div>

    <div class="btn-container">
        <button type="submit" name="submit" class="btn">Sign Up</button>
    </div><br><br>

    <div class="form-group">
        <a href="admin_login.php">Already have an account?Login</a>
    </div>
</form>

<script>
    function toggleTerms() {
        var termsContainer = document.getElementById("terms-message-container");
        termsContainer.style.display = (termsContainer.style.display === "none") ? "block" : "none";
    }
</script>

<script>
    function validateForm() {
        var admin_name = document.getElementById("admin_name").value;
        var admin_password = document.getElementById("admin_password").value;
        var repassword = document.getElementById("repassword").value;       
        
        var isValid = true;
    
        // Validate Name
        if (name.trim() == '') {
            document.getElementById("adminNameError").textContent = 'Please enter your name';
            isValid = false;
        } else if (name.length < 8) {
            document.getElementById("adminNameError").textContent = 'Name should be at least 8 characters long';
            isValid = false;
        } else {
            document.getElementById("adminNameError").textContent = '';
        }
    
    
        // Validate Password
        if (password.trim() == '') {
            document.getElementById("adminPasswordErrorr").textContent = 'Please enter your password';
            isValid = false;
        } else {
            document.getElementById("adminPasswordError").textContent = '';
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
        
        return isValid; // Return the validation result
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