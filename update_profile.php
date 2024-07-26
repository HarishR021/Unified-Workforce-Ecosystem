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
?>
