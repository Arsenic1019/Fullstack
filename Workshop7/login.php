<?php
session_start();
require 'db.php';

/* Redirect if already logged in */
if (isset($_SESSION['logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

/* Login logic */
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login'])) {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT student_id, name, password FROM students WHERE student_id = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['name'] = $student['name'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Student ID or Password";
        }
    } catch (PDOException $e) {
        $error = "Database error!";
    }
}

/* Theme */
$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $theme ?>">
<div class="container">
    <h2>Student Login</h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
