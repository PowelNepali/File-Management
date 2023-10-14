<?php
require('config.php');

// Create the "uploads" directory if it doesn't exist
if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

if (isset($_POST['upload'])) {
    $file = $_FILES['myfile'];

    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Allow only specific file types (e.g., PDF, ZIP, DOCX)
    $allowedExtensions = ['pdf', 'zip', 'docx'];
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($fileExtension, $allowedExtensions)) {
        if ($fileError === 0) {
            if ($fileSize <= 1000000000000) { // 1 TB
                $uniqueFileName = uniqid('file_', true) . '.' . $fileExtension;
                $destination = 'uploads/' . $uniqueFileName;

                if (move_uploaded_file($fileTmpName, $destination)) {
                    // File uploaded successfully; insert record into the database
                    $sql = "INSERT INTO files (name, size, downloads) VALUES ('$uniqueFileName', $fileSize, 0)";
                    if (mysqli_query($conn, $sql)) {
                        echo "File uploaded successfully.";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                echo "File is too large (maximum size: 1 TB).";
            }
        } else {
            echo "Error during file upload.";
        }
    } else {
        echo "Invalid file type. Allowed types: PDF, ZIP, DOCX.";
    }
}
?>
