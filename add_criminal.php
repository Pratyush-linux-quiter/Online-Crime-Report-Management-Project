<!-- filepath: c:\xampp\htdocs\crime report\admin\add_criminal.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $age = $_POST['age'];
    $crime = $_POST['crime'];
    $photo = $_FILES['photo']['name'];
    $video = $_FILES['video']['name'] ?? ''; // Handle video upload, default to empty string if not provided
    $targetPhoto = __DIR__ . "/../uploads/" . basename($photo); // Use absolute path
    $targetVideo = __DIR__ . "/../uploads/" . basename($video); // Use absolute path

    // Ensure the target directory exists
    if (!is_dir(__DIR__ . '/../uploads')) {
        mkdir(__DIR__ . '/../uploads', 0777, true);
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'crime report');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO criminals (name, age, crime, photo, video) VALUES ('$name', '$age', '$crime', '$photo', '$video')";
    if ($conn->query($sql) === TRUE) {
        $photoUploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $targetPhoto);
        $videoUploaded = empty($video) || move_uploaded_file($_FILES['video']['tmp_name'], $targetVideo);

        if ($photoUploaded && $videoUploaded) {
            header("Location: success1.php?name=$name&age=$age&crime=$crime&photo=$photo&video=$video"); // Redirect to success1 page with details
            exit();
        } else {
            echo "Failed to upload photo or video.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Criminal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Updated background color */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            margin-bottom: 10px; /* Reduced margin-bottom */
        }
        form {
            background: #fff;
            padding: 20px; /* Reduced padding */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Reduced width */
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Added margin-top */
        }
        button:hover {
            background: #218838;
        }
        .back-button {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px; /* Increased margin-top */
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Add Criminal</h1>
    <form action="add_criminal.php" method="post" enctype="multipart/form-data"> <!-- Updated form action -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br>
        <label for="crime">Crime:</label>
        <textarea id="crime" name="crime" required></textarea><br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" required><br>
        <label for="video">Video (optional):</label>
        <input type="file" id="video" name="video"><br>
        <button type="submit">Add Criminal</button>
    </form>
    <button class="back-button" onclick="window.location.href='admin.php'">Back to Admin Page</button>
</body>
</html>