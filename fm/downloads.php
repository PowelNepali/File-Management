<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
   <link rel="stylesheet" type="text/css" href="css/downloads.css">
    <title>Download Files</title>
</head>
<body>
    <table>
        <thead>
            <th>ID</th>
            <th>Filename</th>
            <th>Size (in KB)</th>
            <th>Department</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
        require('config.php');

        $sql = "SELECT * FROM files";
        $result = mysqli_query($conn, $sql);
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($files as $file) {
            $id = $file['id'];
            $filename = $file['name'];
            $size = floor($file['size'] / 1024) . ' KB';
            $downloads = $file['downloads'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $filename; ?></td>
                <td><?php echo $size; ?></td>
                <td><?php echo $file['department']; ?></td>
                <td><a href="download.php?id=<?php echo $id; ?>">Download</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</body>
</html>
