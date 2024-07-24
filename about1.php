<?php
session_start();

// Redirect to login if the session is not set
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
    <title>About</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['firstName']); ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>

    <nav class="main-nav">
        <a href="homepage.php" class="nav-item">Home</a>
        <a href="about1.php" class="nav-item">About</a>
        <a href="services1.php" class="nav-item">Services</a>
        <a href="contact1.php" class="nav-item">Contact</a>
        <a href="profile1.php" class="nav-item">Profile</a>
    </nav>
    
    <div class="content about-content">
        <h2>About Us</h2>
        <p>This page contains information about our organization. Learn more about our mission and vision here.</p>
    </div>    
</body>
</html>
