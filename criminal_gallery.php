<!-- filepath: c:\xampp\htdocs\crime report\criminal_gallery.php -->
<?php
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
    <title>Criminal Gallery</title>
</head>
<body>
    <h1>Criminal Gallery</h1>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="criminal">
            <img src="uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['name']; ?>">
            <?php if (!empty($row['video']) && file_exists("uploads/" . $row['video'])): ?>
                <video width="320" height="240" controls>
                    <source src="uploads/<?php echo $row['video']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
            <h2><?php echo $row['name']; ?></h2>
            <p>Age: <?php echo $row['age']; ?></p>
            <p>Crime: <?php echo $row['crime']; ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>

<?php
$conn->close();
?>