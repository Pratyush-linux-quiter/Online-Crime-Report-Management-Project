<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connect.php';

if (!isset($_SESSION['role'])) {
    die("Error: Admin role not set in session. Please log in again.");
}

$admin_role = $_SESSION['role'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $sql = "UPDATE reports SET status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $user_id); // Changed to "ss" for two strings
    if ($stmt->execute()) {
        echo "<script>alert('Status updated successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating status!');</script>";
    }
    $stmt->close();
}

// Handle contact message deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_contact'])) {
    $contact_id = $_POST['contact_id'];
    $sql = "DELETE FROM contact_submissions WHERE id = ?"; // Changed contact_messages to contact_submissions
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $contact_id);
    if ($stmt->execute()) {
        echo "<script>alert('Contact message deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting contact message!');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel - Crime Reports</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="admin_panel.css"> <!-- Added new CSS file -->
    <style>
        .add-criminal-btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-criminal-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Admin Panel - Crime Reports</h2>
    <p>Welcome, <?php echo $_SESSION['admin']; ?> (Role: <?php echo $_SESSION['role']; ?>)</p>
    <a href="logout.php" class="logout-btn">Logout</a>
    <a href="index.html" class="home-btn">Back to Home Page</a> <!-- Added button for home page -->

    <?php if ($admin_role == 'superadmin') { ?>
        <a href="manage_admins.php" class="manage-admins-btn">Manage Admins</a>
        <a href="add_criminal.php" class="add-criminal-btn">Add Criminal</a> <!-- Moved button to add criminal -->
    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Crime Type</th>
            <th>Description</th>
            <th>Date Reported</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Location</th> <!-- Added new column for Location -->
            <?php if ($admin_role == 'superadmin') { ?><th>Action</th><?php } ?>
        </tr>

        <?php
        $sql = "SELECT * FROM reports";
        $result = $conn->query($sql);

        if (!$result) {
            die("Error fetching reports: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['crime_type']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['date_reported']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['Location']}</td>"; 
                if ($admin_role == 'superadmin') {
                    echo "<td>
                            <form method='POST' action='delete_report.php' style='display:inline;'>
                                <input type='hidden' name='report_id' value='{$row['id']}'>
                                <button type='submit' name='delete_report' class='delete-btn'>Delete</button>
                            </form>
                          </td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No reports found.</td></tr>"; 
        }
        ?>
    </table>

    <h3>Update Report Status</h3>
    <form method="POST">
        <input type="text" name="user_id" placeholder="User ID" required> <!-- Changed to text input -->
        <select name="status">
            <option value="Pending" selected>Pending</option> <!-- Set default value to Pending -->
            <option value="In Progress">In Progress</option>
            <option value="Resolved">Resolved</option>
        </select>
        <button type="submit" name="update_status">Update Status</button>
    </form>

    <h3>Contact Messages</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <?php if ($admin_role == 'superadmin') { ?><th>Action</th><?php } ?>
        </tr>

        <?php
        $sql = "SELECT * FROM contact_submissions"; // Changed contact_messages to contact_submissions
        $result = $conn->query($sql);

        if (!$result) {
            die("Error fetching contact messages: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['message']}</td>";
                echo "<td>{$row['date']}</td>";
                if ($admin_role == 'superadmin') {
                    echo "<td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='contact_id' value='{$row['id']}'>
                                <button type='submit' name='delete_contact' class='delete-btn'>Delete</button>
                            </form>
                          </td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No contact messages found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>