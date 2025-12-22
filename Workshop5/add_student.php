<?php
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name   = trim($_POST["name"]);
        $email  = trim($_POST["email"]);
        $skills = trim($_POST["skills"]);
        
        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required.";
        }

        if (empty($skills)) {
            $errors[] = "Skills are required.";
        }

        if (!empty($errors)) {
            throw new Exception("Validation failed.");
        }

        $skillsArray = explode(",", $skills);
        $skillsArray = array_map("trim", $skillsArray);

        $skillsString = implode(" , ", $skillsArray);

        $file = fopen("data/students.txt", "a");
        if (!$file) {
            throw new Exception("Unable to open file.");
        }
        
        $record = "Name: $name, Email: $email, Skills: $skillsString" . PHP_EOL;
        fwrite($file, $record);
        fclose($file);

        $success = "Student added successfully!";

    } catch (Exception $e) {
        if (empty($errors)) {
            $errors[] = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Student</title>
</head>
<body>

<?php include "includes/header.php"; ?>

<h2>Add Student Information</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($success): ?>
    <p><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Skills (comma-separated):</label><br>
    <input type="text" name="skills" placeholder=""><br><br>

    <button type="submit">Add Student</button>
</form>

<?php include "includes/footer.php"; ?>

</body>
</html>