<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['textfile']) && $_FILES['textfile']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['textfile']['name']);

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['textfile']['tmp_name'], $uploadFile)) {
            echo "<h2>File uploaded successfully!</h2>";
            echo "<h3>Contents of the uploaded file:</h3>";
            echo "<pre>" . htmlspecialchars(file_get_contents($uploadFile)) . "</pre>";
        } else {
            echo "<h2>Error uploading file.</h2>";
        }
    } else {
        echo "<h2>No file uploaded or there was an error with the upload.</h2>";
    }
} else {
    echo "<h2>Invalid request method.</h2>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Text File</title>
</head>
<body>
    <h1>Upload a Text File</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="textfile" accept=".txt" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>