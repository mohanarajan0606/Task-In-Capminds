<?php
$conn = new mysqli("localhost", "root", "", "task");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
