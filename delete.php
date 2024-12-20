<?php
// Delete user
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    // Delete query
    $sql = "DELETE FROM users WHERE matric = '$matric'";
    if ($conn->query($sql)) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    header("Location: user_list.php");  // Redirect back to the user list
}
?>
