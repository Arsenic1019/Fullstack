<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileupload'])) {
    try {
        $file = $_FILES['fileupload'];

        if ($file['error'] !== 0) {
            throw new Exception("File upload error.");
        }

        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];

        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Invalid file type.");
        }

        $maxSize = 2 * 1024 * 1024; 
        if ($file['size'] > $maxSize) {
            throw new Exception("File size must be 2MB or less.");
        }

        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $cleanName = preg_replace("/[^a-zA-Z0-9_-]/", "", $originalName);
        $fileName = $cleanName . "_" . time() . "." . $ext;

        $destination = $uploadDir . $fileName;
        move_uploaded_file($file['tmp_name'], $destination);

        $message = "Portfolio uploaded successfully!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upload Portfolio</title>
</head>
<body>

<?php include "includes/header.php"; ?>

<h2>Upload Portfolio</h2>

<p><?= htmlspecialchars($message) ?></p>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="fileupload" accept=".pdf,.jpg,.png" required>
    <button type="submit">Upload Portfolio</button>
</form>

<?php include "includes/footer.php"; ?>

</body>
</html>