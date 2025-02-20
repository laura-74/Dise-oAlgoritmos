<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Delete</title>
</head>
<body>
    <h1>Upload Image</h1>
    <form action="prueba.php" method="post" enctype="multipart/form-data">
        <label for="image">Select image to upload:</label>
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <h1>Delete Image</h1>
    <form action="prueba.php" method="post">
        <label for="filePath">Enter the file path to delete:</label>
        <input type="text" name="filePath" id="filePath">
        <input type="submit" value="Delete Image" name="delete">
    </form>
</body>
</html>
