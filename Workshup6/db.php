<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connected";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
