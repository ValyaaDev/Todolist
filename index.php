<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Todo App</title>

<link rel="stylesheet" href="assets/style.css">

</head>
<body>

<div class="hero">

    <div class="glass">

        <h1>🚀 Todo App</h1>

        <p>
            Kelola tugas harianmu dengan tampilan modern,
            cepat dan mudah digunakan.
        </p>

        <div class="hero-buttons">

            <a href="auth/login.php" class="btn-primary">
                Login
            </a>

            <a href="auth/register.php" class="btn-secondary">
                Register
            </a>

        </div>

    </div>

</div>

</body>
</html>