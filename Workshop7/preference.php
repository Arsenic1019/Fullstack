<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST["theme"])) {
    setcookie("theme", $_POST["theme"], time() + (86400 * 30), "/");
    header("Location: dashboard.php");
    exit();
}
$theme = $_COOKIE["theme"] ?? "light";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Theme Preference</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $theme ?>">
<div class="container">
    <h2>Select Theme</h2>

    <form method="post">
        <button type="submit" name="theme" value="light">🌞 Light Mode</button>
        <br><br>
        <button type="submit" name="theme" value="dark">🌙 Dark Mode</button>
    </form>
</div>
</body>
</html>
