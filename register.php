<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    // Insert data into the users table
    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    if ($conn->query($sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<form method="POST">
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role" required>
        <option value="student">Please select</option>
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
    </select><br>
    <input type="submit" value="Submit">
</form>
