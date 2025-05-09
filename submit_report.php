<?php
include 'db_connect.php'; // Database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $crime_type = $conn->real_escape_string($_POST['crime_type']);
    $description = $conn->real_escape_string($_POST['description']);
    $Location = isset($_POST['Location']) ? $conn->real_escape_string($_POST['Location']) : ''; // Check if Location is set

    // Convert crime type to a short code
    $crime_codes = [
        "Cyber Crime" => "CYB",
        "Robbery" => "ROB",
        "Assault" => "ASS",
        "Fraud" => "FRD",
        "Other" => "OTH"
    ];

    $crime_prefix = isset($crime_codes[$crime_type]) ? $crime_codes[$crime_type] : "GEN";

    // Count existing users with the same crime prefix
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE crime_type = '$crime_type'");
    if (!$result) {
        die("Error executing query: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    $user_number = $row['count'] + 1;

    // Generate User ID (e.g., CYB001, ROB002)
    $user_id = $crime_prefix . str_pad($user_number, 3, '0', STR_PAD_LEFT);

    // Insert user into users table
    $sql_user = "INSERT INTO users (user_id, name, email, phone, crime_type, Location) 
                 VALUES ('$user_id', '$name', '$email', '$phone', '$crime_type', '$Location')"; // Ensure column name matches database

    if ($conn->query($sql_user) === TRUE) {
        // Fetch the newly inserted user_id from the users table
        $get_user_id = $conn->query("SELECT user_id FROM users WHERE email='$email' AND phone='$phone' ORDER BY date_reported DESC LIMIT 1");
        if (!$get_user_id) {
            die("Error executing query: " . $conn->error);
        }
        $user_data = $get_user_id->fetch_assoc();
        $real_user_id = $user_data['user_id'];

        // Insert report with retrieved user_id
        $sql_report = "INSERT INTO reports (user_id, name, email, phone, crime_type, description, Location) 
                       VALUES ('$real_user_id', '$name', '$email', '$phone', '$crime_type', '$description', '$Location')"; // Ensure column name matches database
        
        if ($conn->query($sql_report) === TRUE) {
            header("Location: success.php?user_id=$real_user_id&name=$name&crime_type=$crime_type");
            exit();
        } else {
            echo "Error inserting report: " . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $conn->error;
    }

    $conn->close();
}
?>