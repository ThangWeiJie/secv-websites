<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View message</title>
</head>
<body>
    <?php
    require_once ('config.php');
    $sql = "SELECT * FROM contact_messages";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["name"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["phone"]. "</td>
                    <td>" . $row["message"]. "</td>
                    <td>
                        <a href='update.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='update.php?delete=" . $row['id'] ."' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    ?>
</body>
</html>