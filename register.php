<?php
include 'connect.php';

if (isset($_POST['signUp'])) {
    // Retrieve form data
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the query to check if the email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "Email Address Already Exists!";
    } else {
        // Insert new user into the database
        $insertQuery = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

        if ($insertQuery->execute()) {
            // Start session and store user details
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            header("Location: index.php");
            exit();
        } else {
            // Error inserting user
            echo "Error: " . $conn->error;
        }
    }
}

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
