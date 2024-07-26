<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET firstName = ?, lastName = ?, password = ? WHERE email = ?");
    $stmt->bind_param("ssss", $firstName, $lastName, $hashed_password, $email);
    $stmt->execute();
    $stmt->close();

    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['size'] > 0) {
        $profileImage = file_get_contents($_FILES['profileImage']['tmp_name']);
        $stmt = $conn->prepare("UPDATE users SET profileImage = ? WHERE email = ?");
        $stmt->bind_param("bs", $profileImage, $email);
        $stmt->send_long_data(0, $profileImage);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: profile1.php');
    exit();
}

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
    <title>Profile</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <nav class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about1.php">About</a>
        <a href="services1.php">Services</a>
        <a href="contact1.php">Contact</a>
        <a href="profile1.php" class="active">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
    <form method="POST" action="profile1.php" enctype="multipart/form-data">
        <h2>Edit Profile</h2>
        <input type="text" name="firstName" value="<?= htmlspecialchars($firstName) ?>" required>
        <input type="text" name="lastName" value="<?= htmlspecialchars($lastName) ?>" required>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="file" name="profileImage" accept="image/*">
        <button type="submit">Save Changes</button>
    </form>
    <?php if ($profileImage): ?>
        <img src="data:image/jpeg;base64,<?= base64_encode($profileImage) ?>" alt="Profile Image" class="profile-image">
    <?php endif; ?>
</body>
</html>
