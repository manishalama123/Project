<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
   
    <style>
       *{
    padding:0;
    margin:0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#20324A;

  }
    /* button {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    background-color: #f2961b; 
    color: #fff; 
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease; 
} */

h2{
    text-align:center;
    color:#f2961b;
    font-weight:24px;
}

/* button:hover {
  
    background-color: #e2870e;
} */
/* Style for the buttons */
#viewbtn {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    background-color: #4CAF50; /* Green */
    color: #fff; 
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease; 
}

#deletebtn {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    background-color: #f44336;
    color: #fff; 
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease; 
}

#viewbtn:hover {
    background-color: #45a049; 
}

#deletebtn:hover {
    background-color: #d32f2f;
}

#viewbtn a,
#deletebtn a {
    text-decoration: none;
    color: inherit;
}




.search-container {
    margin-bottom: 20px;
    margin-right: 60px;
    text-align: center;
}


.search-box {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    color: #333; 
}

.search-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #007bff; 
    color: #fff; 
    cursor: pointer;
}

.search-button:hover {
    background-color: #0056b3; 
}

.header {
    text-align: center;
    margin-bottom: 20px; /* Adjust as needed */
}

.logo-container {
    margin-bottom: 20px; /* Adjust as needed */
    float: left; /* Float the logo to the left */
}

.logo-container img {
    width: 100px; /* Set the width of the logo */
    height: auto; /* Maintain aspect ratio */
}
.table_wrapper{
    
    margin: 0 auto;
    overflow-x: auto;
    height:100vh;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
    padding: 20px; /* Add padding */
    margin-top: 20px; 
}

table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color:#333333;
    color: white;
}

tr:hover {
    background-color: transparent;
}

.table-container {
    width: 100%;
    padding:0;
    margin: 0 auto;
    overflow-x: auto;
}

    </style>
</head>
<body>
    
   
<div class="header">
    <div class="logo-container">
    <img src="image/logo.png">
    </div>
</div><br><br><br><br>
<div class="table-container">
    <h2>Admin Dashboard</h2><br><br>
    <div class="search-container">
    <form action="search_user.php" method="GET">
        <input type="text" name="search_query" class="search-box" placeholder="Search users...">
        <button type="submit" class="search-button">Search</button>
    </form><br>
</div>
<div class="table_wrapper">
    <h2>User Information</h2><br><br>
 <?php
       
        
            include 'connection.php';
            $sql = "SELECT * FROM `userinfo`";
            $result = mysqli_query($con, $sql);

        // Check if there are users
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan='2'>Action</th>
                    </tr>";
            
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["email"]."</td>
                        
                        <td>
                        <form action='view_profile.php' method='get'>
                        <button id='viewbtn'><a href='view_profile.php?viewid=".$row["id"]."'>View</a></button>
                        </form></td>
                        <td>
                        <form action='delete_user.php' method='post'>
                        <button id='deletebtn'><a href='delete_user.php?deleteid=".$row["id"]."'>Delete</a></button>
                        </form>

                        
                    </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        mysqli_close($con);
        ?>
</div>
       
       



</div>

       
    


    

</div>
</body>
</html>


