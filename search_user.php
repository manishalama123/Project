<?php
include 'connection.php';
if (isset($_GET['search_query'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['search_query']);

    $sql = "SELECT * FROM userinfo WHERE name LIKE '%$search_query%'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Display the search results
    if (mysqli_num_rows($result) > 0) {
        // Output data of each user
        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "No results found.";
    }

    // Free result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($con);
?>
