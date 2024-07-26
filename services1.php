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
    <title>Services</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <nav class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about1.php">About</a>
        <a href="services1.php" class="active">Services</a>
        <a href="contact1.php">Contact</a>
        <a href="profile1.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="page-content">
        <h1>Our Services</h1>
        <p>This is the Services page. Learn more about our services here.</p>
    </div>
</body>
</html>
