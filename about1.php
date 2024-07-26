<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <nav class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about1.php" class="active">About</a>
        <a href="services1.php">Services</a>
        <a href="contact1.php">Contact</a>
        <a href="profile1.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="page-content">
        <h1>About Us</h1>
        <p>This is the About page. Learn more about us here.</p>
    </div>
</body>
</html>
