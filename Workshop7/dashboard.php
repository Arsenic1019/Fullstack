<?php
session_start();

/* Protect page */
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

/* Handle logout */
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

/* Theme from cookie */
$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $theme ?>">
    <div class="container">
        <h1>Welcome <?= $_SESSION['student_id']; ?></h1>

        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="preference.php">Theme</a>
        </nav>

        <form method="post">
            <button type="submit" name="logout">Log out</button>
        </form>
    </div>
</body>
</html>
