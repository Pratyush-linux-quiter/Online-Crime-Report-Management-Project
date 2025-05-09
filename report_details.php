<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_complaint'])) {
    $user_id = $_POST['user_id'];
    $crime_type = $_POST['crime_type'];
    $description = $_POST['description'];
    $date_reported = date('Y-m-d H:i:s');
    $status = 'Pending'; // Set default status to Pending

    $sql = "INSERT INTO reports (user_id, crime_type, description, date_reported, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $user_id, $crime_type, $description, $date_reported, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Complaint submitted successfully!'); window.location.href='report_details.php';</script>";
    } else {
        echo "<script>alert('Error submitting complaint!');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report Details</title>
    <link rel="stylesheet" href="styl.css"> <!-- Added new CSS file -->
</head>
<body>
    <div class="container"> <!-- Added container div -->
        <h2>Report Details</h2>

        <?php
        if (isset($_GET['user_id']) && isset($_GET['name'])) { // Changed username to name
            $user_id = $_GET['user_id'];
            $name = $_GET['name']; // Changed username to name

            if (isset($conn)) { // Check if $conn is defined
                $sql = "SELECT * FROM reports WHERE user_id = ? AND name = ?"; // Changed username to name
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $user_id, $name); // Changed username to name
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='report-details'>"; // Added report-details class
                        echo "<p>ID: {$row['id']}</p>";
                        echo "<p>Crime Type: {$row['crime_type']}</p>";
                        // Removed description field
                        echo "<p>Date Reported: {$row['date_reported']}</p>";
                        echo "<p>Status: {$row['status']}</p>";
                        // Removed location field
                        echo "</div>"; // Closed report-details div
                    }
                } else {
                    echo "<p>No report found with the given User ID and Name.</p>"; // Changed username to name
                }

                $stmt->close();
            } else {
                echo "<p>Database connection error.</p>";
            }
        }
        ?>

        <a href="index.html" class="back-btn">Back to Dashboard</a>
    </div> <!-- Closed container div -->
</body>
</html>
