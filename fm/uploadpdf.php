<?php
require('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost','root','','file-management');

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if a file was uploaded
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        $file_name = $file["name"];
        $pdf_data = file_get_contents($file["tmp_name"]);

        // Escape the binary data for safe SQL insertion
        $escapedPdfData = mysqli_real_escape_string($conn, $pdf_data);

        // Insert the PDF data into the table
        $sql = "INSERT INTO pdf_files (file_name, pdf_data) VALUES ('$file_name', '$escapedPdfData')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to the same page with a success message
            header("Location: ".$_SERVER['PHP_SELF']."?success=1");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDF Upload Form</title>
</head>
<body>
    <h2>Upload PDF</h2>
    <?php
    if (isset($_GET["success"]) && $_GET["success"] == 1) {
        echo "PDF file uploaded and stored in the database successfully.";
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="file">Choose PDF File:</label>
        <input type="file" name="file" id="file">
        <br><br>
        <input type="submit" name="submit" value="Upload PDF">
    </form>
</body>
</html>
