<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    
    $conn = mysqli_connect($db_host, $db_user, $db_pass);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
