<?php
include 'connect.php';

if (isset($_POST['signIn'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch user details
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start session
        session_start();
        $_SESSION['email'] = $user['email'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        header("Location: homepage.php");
        exit();
    } else {
        // Incorrect email or password
        echo "Incorrect Email or Password";
    }
}
?>
