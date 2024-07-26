<?php
session_start();
include 'connect.php'; // Include database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Store user information in the session
        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['first_name'] = $user['firstName'];
        $_SESSION['last_name'] = $user['lastName'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['profile_image'] = $user['profileImage'];
        header("Location: homepage.php"); // Redirect to homepage
    } else {
        echo "Invalid email or password.";
    }
}
?>
