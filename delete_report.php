<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin']) || $_SESSION['role'] != 'superadmin') {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_report'])) {
    $report_id = $_POST['report_id'];
    $sql = "DELETE FROM reports WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $report_id);
    if ($stmt->execute()) {
        echo "<script>alert('Report deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting report!');</script>";
    }
    $stmt->close();
} else {
    header("Location: admin.php");
}
?>