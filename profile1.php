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
    <title>Profile</title>
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
    
    <div class="content">
        <h2>Your Profile</h2>
        <form method="post" action="update_profile.php" enctype="multipart/form-data">
            <div class="input-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($_SESSION['firstName']); ?>" required>
            </div>
            <div class="input-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($_SESSION['lastName']); ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
            </div>
            <div class="input-group">
                <label for="profilePic">Profile Picture:</label>
                <input type="file" name="profilePic" id="profilePic">
            </div>
            <input type="submit" class="btn" value="Update Profile">
        </form>        
    </div>
</body>
</html>
