<?php
if (isset($_POST['submit'])) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file'];
        $fileName = basename($file['name']);
        $fileTmpPath = $file['tmp_name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if ($fileExtension === 'txt') {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $newFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $newFilePath)) {
                $success = "File successfully uploaded.";
                header("Location: display.php?file=" . urlencode($fileName));
                exit();
            } else {
                $error = "There was an error moving the file.";
            }
        } else {
            $error = "Only text (.txt) files are allowed.";
        }
    } else {
        $error = "No file uploaded or there was an error during upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <h2 class="my-4">Upload Result</h2>

        <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <a href="index.php" class="btn btn-secondary">Go Back</a>
    </div>
</body>
</html>