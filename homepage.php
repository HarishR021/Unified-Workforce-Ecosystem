<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['firstName']); ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>
    <nav>
        <a href="homepage.php">Home</a>
        <a href="about1.html">About</a>
        <a href="services1.html">Services</a>
        <a href="contact1.html">Contact</a>
        <a href="profile1.html">Profile</a>
    </nav>
    <div class="content">
        <p>Here is the content of the homepage.</p>
    </div>
</body>
</html>
