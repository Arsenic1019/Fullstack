<?php 
include "includes/header.php";

$filePath = "data/students.txt";

if (!file_exists($filePath)) {
    echo "<p>No students found.</p>";
    include 'includes/footer.php';
    exit;
}

$lines = file($filePath);
foreach ($lines as $line) {
    echo htmlspecialchars($line) . "<br>";
}

include "includes/footer.php";
?>