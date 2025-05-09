<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Track Report</title>
    <link rel="stylesheet" href="new_style.css"> <!-- Changed to new_style.css -->
</head>
<body>
    <h2>Track Your Report</h2>
    <form method="GET" action="report_details.php"> <!-- Changed action to report_details.php -->
        <input type="text" name="user_id" placeholder="User ID" required>
        <input type="text" name="name" placeholder="Name" required> <!-- Changed username to name -->
        <!-- Removed report_id input field -->
        <button type="submit">Track</button>
    </form>

    <a href="index.html" class="back-btn">Back to Homepage</a>
</body>
</html>