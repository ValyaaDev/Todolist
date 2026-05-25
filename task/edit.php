<?php

include "../config/db.php";

$id = $_GET['id'];

if(isset($_POST['update'])){

$task =
$_POST['task'];

$deadline =
$_POST['deadline'];

mysqli_query(
$conn,
"UPDATE tasks
SET task='$task',
deadline='$deadline'
WHERE id='$id'"
);

header(
"Location: ../dashboard.php"
);
}

$data =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT *
FROM tasks
WHERE id='$id'"
));
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Task</title>

<link rel="stylesheet"
href="../assets/style.css">

</head>
<body>

<div class="auth-container">

<div class="glass auth-card">

<h2>Edit Task</h2>

<form method="POST">

<input
type="text"
name="task"
value="<?= $data['task']; ?>"
required>

<input
type="date"
name="deadline"
value="<?= $data['deadline']; ?>">

<button
name="update">
Update
</button>

</form>

</div>

</div>

</body>
</html>