<?php

session_start();

include "../config/db.php";

$user_id =
$_SESSION['user_id'];

$task =
$_POST['task'];

$deadline =
$_POST['deadline'];

mysqli_query(
$conn,
"INSERT INTO tasks
(user_id,task,deadline)
VALUES
('$user_id',
'$task',
'$deadline')"
);

header(
"Location: ../dashboard.php"
);