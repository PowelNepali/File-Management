<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <a href="uploadimg.php">Back</a>
    </header>
</body>
</html>


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
    }
}

// Query the database to fetch the uploaded images
$query = "SELECT * FROM items";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<h2>Uploaded Images</h2>';
    echo '<table cellpadding="10">';
    echo '<tr>';
    echo '<th>Image</th>';
    echo '<th>Title</th>';
    echo '<th>Delete</th>'; // Add a "Delete" column header
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td><img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '" width="300"></td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td><a href="delete.php?delete_id=' . $row['id'] . '">Delete</a></td>'; // Add Delete link
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No images have been uploaded yet.';
}
?>
