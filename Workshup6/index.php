<?php
include "db.php";
$stmt = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>

    <!-- LINK CSS HERE -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2>Simple CRUD Application</h2>
    <nav>
        <a href="index.php">Home</a> |
        <a href="add.php">Add Student</a>
    </nav>
</header>

<div class="container">

    <a href="add.php" class="add-link">+ Add New Student</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $stmt->fetch()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['course'] ?></td>
            <td class="actions">
                <a href="edit.php?id=<?= $row['id'] ?>" class="edit">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" class="delete"
                   onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

<footer>
    © 2025 Student List
</footer>

</body>
</html>
