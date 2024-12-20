<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    // Check if user exists
    $sql = "SELECT * FROM users WHERE matric = '$matric' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        header("Location: user_list.php");  // Redirect to user list page after login
    } else {
        echo "Invalid username or password.";
    }
    $conn->close();
}
?>

<form method="POST">
    Matric: <input type="text" name="matric" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
<a href="register.php">Register</a>
