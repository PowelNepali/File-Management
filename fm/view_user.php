<?php
require_once("config.php");

if(isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $delete_query = "DELETE FROM user_form WHERE id = $id_to_delete";
    mysqli_query($conn, $delete_query);
}

$user_query = "SELECT * FROM user_form";
$user_result = mysqli_query($conn, $user_query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Users and Delete</title>
    <link rel="stylesheet" type="text/css" href="css/view_user.css">
</head>
<body>
    <h1>View Users and Delete</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($user_result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
                <td>
                    <a href="view_users.php?delete_id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
