<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);

        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
            echo "File successfully uploaded.";
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file was uploaded or an error occurred.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="profilePic" required>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
