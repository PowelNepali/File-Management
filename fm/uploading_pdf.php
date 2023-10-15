<?php
require('config.php');

if (isset($_POST['upload'])) {
    $department = $_POST['department'];
    $file = $_FILES['pdf_file'];

    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    if ($fileError === 0) {
        $uniqueFileName = uniqid('file_', true) . '.pdf'; // Ensure the file is stored with a .pdf extension
        $destination = 'uploads/' . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $destination)) {
            // File uploaded successfully; insert a record into the database
            $sql = "INSERT INTO uploaded_pdfs (department, file_name, file_path) VALUES ('$department', '$uniqueFileName', '$destination')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Error during file upload.";
    }
}
?>
