<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT firstName, lastName, profileImage FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $profileImage);
$stmt->fetch();
$stmt->close();
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
    <nav class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about1.php">About</a>
        <a href="services1.php">Services</a>
        <a href="contact1.php">Contact</a>
        <a href="profile1.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="user-info">
        <?php if ($profileImage): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($profileImage) ?>" alt="Profile Image" class="profile-image">
        <?php endif; ?>
        <span><?= htmlspecialchars($firstName) ?> <?= htmlspecialchars($lastName) ?></span>
        <span><?= htmlspecialchars($email) ?></span>
    </div>
    <h1>Welcome to the Homepage</h1>
</body>
</html>
