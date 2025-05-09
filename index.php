<!-- filepath: c:\xampp\htdocs\crime report\index.php -->
<?php
session_start(); // Start the session to check for admin login
$conn = new mysqli('localhost', 'root', '', 'crime report');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM criminals ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('uploads/image2.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #fff;
        }
        .criminal {
            background: rgba(255, 255, 255, 0.9);
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #333;
        }
        .criminal img {
            max-width: 200px; /* Set maximum width */
            max-height: 200px; /* Set maximum height */
            height: auto;
            border-radius: 5px;
        }
        .criminal h2 {
            color: #333;
            margin: 10px 0;
        }
        .criminal p {
            color: #666;
        }
        .back-button {
            text-align: center;
            margin: 20px;
        }
        .back-button a {
            text-decoration: none;
            color: #fff;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Criminal Gallery</h1>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="criminal">
                <?php 
                $imagePath = "uploads/" . $row['photo']; // Construct the file path
                $videoPath = "uploads/" . $row['video']; // Construct the video path
                $placeholderPath = "uploads/placeholder.png"; // Path to the placeholder image
                if (file_exists($imagePath)): // Check if the file exists
                ?>
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $row['name']; ?>">
                <?php else: ?>
                    <img src="<?php echo $placeholderPath; ?>" alt="Image not available">
                    <!-- Debugging information -->
                    <p style="color: red;">Image not found: <?php echo $imagePath; ?></p>
                <?php endif; ?>
                <?php if (!empty($row['video']) && file_exists($videoPath)): // Check if the video file exists ?>
                    <video width="320" height="240" controls>
                        <source src="<?php echo $videoPath; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                <h2><?php echo $row['name']; ?></h2>
                <p>Age: <?php echo $row['age']; ?></p>
                <p>Crime: <?php echo $row['crime']; ?></p>
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                    <form action="delete_criminal.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="back-button">
        <a href="index.html">Back to Home Page</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>