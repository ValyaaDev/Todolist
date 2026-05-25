<?php

include "../config/db.php";

$id = $_GET['id'];

$data =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT status
FROM tasks
WHERE id='$id'"
));

$newStatus =
$data['status']
==
'done'
?
'pending'
:
'done';

mysqli_query(
$conn,
"UPDATE tasks
SET status='$newStatus'
WHERE id='$id'"
);

header(
"Location: ../dashboard.php"
);