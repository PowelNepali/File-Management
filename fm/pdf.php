<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.row {
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

h3 {
    font-size: 24px;
    margin: 0 0 20px;
}

input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

button:active {
    background-color: #0056b3;
}

    </style>
    <title>Files Upload and Download</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <h3>Upload File</h3>
                <input type="file" name="myfile" required>
                <input type="text" name="depart" placeholder="Department" required>
                <button type="submit" name="upload">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>
