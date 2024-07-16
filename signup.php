<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Typically, you would hash the password before storing it
    // Example hash: $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Replace this with your cloud storage or database integration
    // Example database query to insert user:
    // $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    
    // Example response if successful
    echo "User registered successfully!";
} else {
    // Redirect to sign-up page if accessed directly
    header("Location: signup.html");
    exit();
}
?>
