<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update record</title>
</head>
<body>
    <?php
    require_once('config.php');

    // Handle delete first
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']); 
        $sql = "DELETE FROM MyGuests WHERE id=$id";
        mysqli_query($conn, $sql);
        header("Location: view.php"); // back to view
        exit();
    }

    // Handle update submission
    if (isset($_POST['update'])) {
        $id = intval($_POST['id']); 
        $name = mysqli_real_escape_string($conn, $_POST['name']); 
        $email = mysqli_real_escape_string($conn, $_POST['email']);  
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $sql = "UPDATE contact_messages SET name='$name', email='$email', phone='$phone', message='$message' WHERE id=$id";
        mysqli_query($conn, $sql);
        header("Location: view.php"); // back to view
        exit();
    }

    // Display form to edit
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 
        $result = mysqli_query($conn, "SELECT * FROM contact_messages WHERE id=$id");

        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <h2>Edit Record</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
                
                <label for="name">First Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>"> <br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"> <br>

                <label for="phone">Last Name:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>"> <br>

                <label for="message">Last Name:</label>
                <input type="text" name="message" id="message" value="<?php echo $row['message']; ?>"> <br>

                <input type="submit" name="update" value="Save">
            </form>
            <?php
        }
    } else {
        header("Location: view.php"); // If no id, back to view
        exit();
    }
    mysqli_close($conn);
    ?>
    <p><a href="view.php">View Records</a></p>
</body>
</html>