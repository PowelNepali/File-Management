<?php
require_once('config.php'); // Include your database connection

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Run a DELETE query to remove the image from the database
    $delete_query = "DELETE FROM items WHERE id = $delete_id";
    if ($conn->query($delete_query) === TRUE) {
        // Delete the associated image file from the 'uploads' folder
        $get_image_query = "SELECT image FROM items WHERE id = $delete_id";
        $result = $conn->query($get_image_query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_to_delete = $row['image'];
            unlink("uploads/" . $image_to_delete);
        }
        // Redirect back to the display page after deleting
        header('Location: deleteimg.php');
        exit;
    }
}
?>
