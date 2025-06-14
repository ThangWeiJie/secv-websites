<?php
require_once ('config.php');
     
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(30),
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if(mysqli_query($conn, $sql)) {
    echo "Table contact_messages created successfully.";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>