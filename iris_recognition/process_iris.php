<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['irisImage'])) {
    $file = $_FILES['irisImage'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    // Check for image file
    if (getimagesize($file['tmp_name']) === false) {
        die('Uploaded file is not an image.');
    }

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        echo 'Iris image uploaded successfully!';

        // Now, process the image with a Python script or other methods for iris recognition
        // For example: Run a Python script to analyze the image
        // exec("python process_iris.py " . escapeshellarg($uploadFile));
    } else {
        echo 'Error uploading the image.';
    }
} else {
    echo 'No image uploaded.';
}
?>
