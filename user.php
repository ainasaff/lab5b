<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

// Select data from the users table
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Matric</th><th>Name</th><th>Role</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['matric'] . "</td><td>" . $row['name'] . "</td><td>" . $row['role'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
$conn->close();
?>
