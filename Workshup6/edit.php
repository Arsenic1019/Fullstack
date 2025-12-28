<?php
include "db.php";

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (isset($_POST['update'])) {
    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course'],
        $id
    ]);
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>
    <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>
    <input type="text" name="course" value="<?= $student['course'] ?>" required><br><br>
    <button name="update">Update Student</button>
</form>
