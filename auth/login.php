<?php

session_start();

include "../config/db.php";

$error = "";

if(isset($_POST['login'])){

    $username =
    trim($_POST['username']);

    $password =
    $_POST['password'];

    $query =
    mysqli_query(
        $conn,
        "SELECT *
        FROM users
        WHERE username='$username'"
    );

    if(
    mysqli_num_rows($query) > 0
    ){

        $user =
        mysqli_fetch_assoc(
        $query
        );

        if(
        password_verify(
        $password,
        $user['password']
        )
        ){

            $_SESSION['user_id']
            =
            $user['id'];

            header(
            "Location: ../dashboard.php"
            );

            exit;

        }else{

            $error =
            "Password salah.";
        }

    }else{

        $error =
        "User tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link rel="stylesheet"
href="../assets/style.css">

</head>
<body>

<div class="auth-container">

<div class="glass auth-card">

<h2>🔐 Login</h2>

<?php if($error): ?>

<p class="error">
<?= $error ?>
</p>

<?php endif; ?>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
name="login">

Login

</button>

</form>

<p>

Belum punya akun?

<a href="register.php">
Register
</a>

</p>

</div>

</div>

</body>
</html>