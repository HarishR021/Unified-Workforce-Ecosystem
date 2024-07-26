<?php
session_start();
include 'db_connection1.php'; // Ensure this file contains the connection to your database

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables with empty strings
    $firstName = $lastName = $email = $password = $mobile = $address = $company = "";

    // Retrieve form data if set
    if (isset($_POST['firstName'])) {
        $firstName = trim($_POST['firstName']);
    }
    if (isset($_POST['lastName'])) {
        $lastName = trim($_POST['lastName']);
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    }
    if (isset($_POST['mobile'])) {
        $mobile = trim($_POST['mobile']);
    }
    if (isset($_POST['address'])) {
        $address = trim($_POST['address']);
    }
    if (isset($_POST['company'])) {
        $company = trim($_POST['company']);
    }

    // Check for empty fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($mobile) || empty($address) || empty($company)) {
        echo "Please fill in all fields.";
    } else {
        // Proceed with form processing, e.g., save to database
        // Note: Ensure proper validation and sanitization before inserting into the database

        // Example SQL to insert user into database
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, mobile, address, company) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $email, $password, $mobile, $address, $company);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!-- Example HTML Form -->
<form method="post" action="register.php">
    <div class="input-group">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required>
    </div>
    <div class="input-group">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required>
    </div>
    <div class="input-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div class="input-group">
        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" id="mobile" required>
    </div>
    <div class="input-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
    </div>
    <div class="input-group">
        <label for="company">Company:</label>
        <input type="text" name="company" id="company" required>
    </div>
    <input type="submit" value="Register">
</form>
