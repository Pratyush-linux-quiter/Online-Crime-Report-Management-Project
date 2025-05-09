<?php
session_start();
include 'db_connect.php';

// Ensure only Super Admins can access this page
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'superadmin') {
    echo "<script>alert('Access Denied: Only Super Admins can manage admins!'); window.location.href='admin.php';</script>";
    exit();
}

// Handle adding a new admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $role = $_POST['role'];

    $sql = "INSERT INTO admin (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    
    if ($stmt->execute()) {
        echo "<script>alert('Admin added successfully!'); window.location.href='manage_admins.php';</script>";
    } else {
        echo "<script>alert('Error adding admin!');</script>";
    }
    $stmt->close();
}

// Handle deleting an admin
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM admin WHERE id = $id");
    echo "<script>alert('Admin deleted successfully!'); window.location.href='manage_admins.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Admins</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <h2>Manage Admins</h2>
    <a href="admin.php" class="back-btn">Back to Dashboard</a>
    
    <h3>Add New Admin</h3>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="superadmin">Super Admin</option>
            <option value="moderator">Moderator</option>
        </select>
        <button type="submit">Add Admin</button>
    </form>

    <h3>Existing Admins</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM admin";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><a href='manage_admins.php?delete={$row['id']}' class='delete-btn'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>