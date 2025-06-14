<?php
require_once("config.php");

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS asg3_db";
if(mysqli_query($conn, $sql)) {
    echo "Database created successfully.";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$db_name = "asg3_db";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>