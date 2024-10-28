<?php
if (isset($_GET['file'])) {
    $fileName = urldecode($_GET['file']);
    $filePath = 'uploads/' . $fileName;

    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
    } else {
        $error = "File does not exist.";
    }
} else {
    $error = "No file specified.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display File</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <h2 class="my-4">File Contents</h2>

        <?php if (isset($fileContent)) { ?>
        <div class="card">
            <div class="card-body">
                <pre><?php echo htmlspecialchars($fileContent); ?></pre>
            </div>
        </div>
        <?php } else { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <a href="index.php" class="btn btn-secondary my-4">Upload Another File</a>
    </div>
</body>
</html>