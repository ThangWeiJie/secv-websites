<?php
// Database connection
require_once ('config.php'); 

// Process form submission
if(isset($_POST['submit'])) {
    // Collect and sanitize inputs
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $message = trim($_POST["message"] ?? '');
    $errors = [];

    if (empty($name)) {
        $errors[] = "Please enter your name.";
    } elseif (!preg_match("/^[A-Za-z @,.'\/-]+$/", $name)) {
        $errors[] = "Your name contains invalid characters.";
    }

    if (empty($email)) {
        $errors[] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Please enter your phone number.";
    } elseif (!preg_match("/^01\d-\d{7,8}$/", $phone)) {
        $errors[] = "Phone must follow the format 01X-XXXXXXX or 01X-XXXXXXXX.";
    }

    if (empty($message)) {
        $errors[] = "Please enter your message.";
    }
    echo "<h2>";
    echo empty($errors) ? "Thanks for your message!" : "Oops... There are input errors.";
    echo "</h2>";

    if (!empty($errors)) {
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<a href="javascript:history.back()">[Back]</a>';
    } else{
        // Prepare and execute SQL insert
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        if ($stmt->execute()) {
            echo "<h2>✅ Message sent successfully!</h2>";
            echo "<a href='asg3.html'>← Back to Homepage</a>";
        } else {
            echo "<h2>❌ Error: " . $stmt->error . "</h2>";
        }
        $stmt->close();
    }
}else {
    echo "<p>No form submitted.</p>";
}

mysqli_close($conn);
?>
