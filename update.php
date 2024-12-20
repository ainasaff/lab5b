<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['role']; // Adjusted to match the correct column name

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET name = ?, accessLevel = ? WHERE matric = ?");
    $stmt->bind_param("sss", $name, $accessLevel, $matric);

    // Execute the statement and provide feedback
    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $matric = $_GET['matric'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT matric, name, accessLevel FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="POST">
    Matric: <input type="text" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" readonly><br>
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
    Role: 
    <select name="role" required>
        <option value="Admin" <?php if ($user['accessLevel'] == 'Admin') echo 'selected'; ?>>Admin</option>
        <option value="User" <?php if ($user['accessLevel'] == 'User') echo 'selected'; ?>>User</option>
    </select><br>
    <input type="submit" value="Update">
    <a href="user_list.php">Cancel</a>
</form>
