<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <h3>Upload File</h3>
                <input type="file" name="myfile" required>
                <button type="submit" name="upload">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>
