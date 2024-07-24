<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection1.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$userId = $_SESSION['userId'];

$profilePic = null;
if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0) {
    $profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);
}

$sql = "UPDATE users SET firstName=?, lastName=?, email=?, profile=? WHERE ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssbi", $firstName, $lastName, $email, $profilePic, $userId);

if ($stmt->execute()) {
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;
    header("Location: profile.php?success=1");
} else {
    header("Location: profile.php?error=1");
}

$stmt->close();
$conn->close();
?>
