<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    echo "<h3>Hashed Password:</h3>";
    echo "<p>$hashed_password</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generate Bcrypt Hash</title>
</head>
<body>
    <h2>Enter Password to Hash</h2>
    <form method="POST">
        <input type="text" name="password" placeholder="Enter Password" required>
        <button type="submit">Generate Hash</button>
    </form>
</body>
</html>