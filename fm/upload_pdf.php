<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upload PDF</title>
</head>
<body>
    <h2>Upload PDF</h2>
    <form action="upload_handler.php" method="post" enctype="multipart/form-data">
        <label for="department">Department:</label>
        <input type="text" name="department" id="department" placeholder="Enter department">
        <br>

        <label for="pdf_file">Choose a PDF file:</label>
        <input type="file" name="pdf_file" id="pdf_file"><br>

        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>
