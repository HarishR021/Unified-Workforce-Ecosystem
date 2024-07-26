<?php
// Remove session_start() from this file if it's already handled elsewhere.
$host = "localhost";
$user = "root";
$pass = "";
$db = "project"; // Replace with your actual database name

// Create a new mysqli connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
