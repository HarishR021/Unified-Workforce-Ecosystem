<?php
// Update Profile Script

session_start();
include 'db_connection1.php'; // Include your database connection

if (!isset($_SESSION['userId'])) {
    echo "User not logged in.";
    exit();
}

$userId = $_SESSION['userId']; // Assume user ID is stored in session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // Handle file upload
    $imagePath = null;
    if (!empty($_FILES['profileImage']['name'])) {
        $uploadsDir = 'uploads/';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true); // Create the directory if it does not exist
        }
        
        $imageName = basename($_FILES['profileImage']['name']);
        $imageTmpName = $_FILES['profileImage']['tmp_name'];
        $imagePath = $uploadsDir . $imageName;
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            if (!move_uploaded_file($imageTmpName, $imagePath)) {
                echo "Failed to move uploaded file.";
                exit();
            }

            // Update user profile image in database
            $query = "UPDATE users SET firstName=?, lastName=?, email=?, password=?, profile=? WHERE userId=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssi', $firstName, $lastName, $email, $password, $imagePath, $userId);
        } else {
            echo "Invalid file type.";
            exit();
        }
    } else {
        // Update user profile without changing the image
        $query = "UPDATE users SET firstName=?, lastName=?, email=?, password=? WHERE userId=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $firstName, $lastName, $email, $password, $userId);
    }

    if ($stmt->execute()) {
        // Update session data
        $_SESSION['user'] = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'profileImage' => $imagePath ?? $_SESSION['user']['profileImage']
        ];
        
        echo "Profile updated successfully";
        header('Location: index1.html'); // Redirect to home page
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
