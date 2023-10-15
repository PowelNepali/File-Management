<?php
require_once("config.php");

// Query the database to retrieve image data
$sql = "SELECT id, filename FROM image";
$result = mysqli_query($conn, $sql);

// Check if there are any images in the database
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Download Images</h2>";

    while ($row = mysqli_fetch_assoc($result)) {
        $imageId = $row['id'];
        $filename = $row['filename'];

        echo "<div>";
        echo "<img src='./image/$filename' alt='$filename' style='max-width: 400px; max-height: 400px;'>";
        echo "<a href='download_img.php?id=$imageId'>Download</a>";
        echo "</div>";
    }
} else {
    echo "No images available for download.";
}
?>
