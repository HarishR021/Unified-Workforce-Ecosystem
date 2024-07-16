<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace this with your authentication logic
    // Example database query to check credentials:
    // $sql = "SELECT * FROM users WHERE username='$username'";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    // if ($row) {
    //     if (password_verify($password, $row['password'])) {
    //         $_SESSION['username'] = $username;
    //         header("Location: dashboard.php"); // Redirect to dashboard or main page
    //     } else {
    //         echo "Invalid username or password";
    //     }
    // } else {
    //     echo "User not found";
    // }

    // Example response if successful
    echo "Login successful!";
} else {
    // Redirect to login page if accessed directly
    header("Location: login.html");
    exit();
}
?>
