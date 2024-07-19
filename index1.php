<?php
session_start();
include 'db_connection1.php'; // Include your database connection

// Check if user is logged in and fetch user details
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $query = "SELECT firstName, lastName, email, profileImage FROM users WHERE userId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} else {
    $user = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Website</h1>
        <?php if ($user): ?>
            <div class="profile-display">
                <p><?php echo htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']); ?></p>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                <?php if ($user['profileImage']): ?>
                    <img src="<?php echo htmlspecialchars($user['profileImage']); ?>" alt="Profile Image" class="profile-image">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </header>

    <nav class="navbar">
        <a href="index1.html">Home</a>
        <a href="about1.html">About</a>
        <a href="services1.html">Services</a>
        <a href="contact1.html">Contact</a>
        <a href="profile1.html">Profile</a>
    </nav>

    <div class="page-content slide-in">
        <h2>Welcome to our website!</h2>
        <p>Explore our services and learn more about us.</p>
    </div>
</body>
</html>
