
<?php
require_once("config.php");

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;

    // Check if the image already exists in the database
    $sql = "SELECT id FROM image WHERE filename = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $filename);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $msg = "Image already exists in the database.";
    } else {
        // Insert the image into the database
        $sql = "INSERT INTO image (filename) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $filename);

        if (mysqli_stmt_execute($stmt)) {
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully!";
            } else {
                $msg = "Failed to move the uploaded image.";
            }
        } else {
            $msg = "Failed to insert image into the database: " . mysqli_error($conn);
        }
    }
}

if (isset($_POST['delete'])) {
    $imageId = $_POST['image_id'];
    $filename = $_POST['filename'];

    // Delete the image file from the server
    $fileToDelete = "./image/" . $filename;
    if (file_exists($fileToDelete)) {
        if (unlink($fileToDelete)) {
            // Delete the image record from the database
            $sql = "DELETE FROM image WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $imageId);

            if (mysqli_stmt_execute($stmt)) {
                $msg = "Image deleted successfully!";
            } else {
                $msg = "Failed to delete image from the database: " . mysqli_error($conn);
            }
        } else {
            $msg = "Failed to delete the image file from the server.";
        }
    } else {
        $msg = "Image file not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
        .image-container img {
            max-width: 200px; /* Adjust the maximum width as needed */
            max-height: 200px; /* Adjust the maximum height as needed */
        }
    </style>
</head>
<body>
    <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
        <p><?php echo $msg; ?></p>
    </div>
    <div id="display-image">
        <?php
        $query = "SELECT * FROM image";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="image-container">
                <img src="./image/<?php echo $data['filename']; ?>">
                <form method="POST" action="">
                    <input type="hidden" name="image_id" value="<?php echo $data['id']; ?>">
                    <input type="hidden" name="filename" value="<?php echo $data['filename']; ?>">
                    <button class="btn btn-danger" type="submit" name="delete">Delete</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>
