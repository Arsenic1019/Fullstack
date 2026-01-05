<?php
session_start();
require 'db.php';

$message = "";

/* Handle registration */
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_students'])) {

    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];

    if ($student_id && $name && $password) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id, $name, $hashedPassword]);

            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            $message = "Student ID already exists!";
        }
    } else {
        $message = "All fields are required";
    }
}

/* Theme */
$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $theme ?>">
<div class="container">
    <h2>Register Student</h2>

    <?php if ($message): ?>
        <p class="error"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="add_students">Register</button>
    </form>
</div>
</body>
</html>
