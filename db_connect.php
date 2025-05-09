<?php
$conn = new mysqli('localhost', 'root', '', 'crime report');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>