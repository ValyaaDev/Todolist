<?php
session_start();

include "../config/db.php";

$error = "";

if(isset($_POST['register'])){

    $username =
    trim($_POST['username']);

    $password =
    $_POST['password'];

    $check =
    mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE username='$username'"
    );

    if(mysqli_num_rows($check) > 0){

        $error =
        "Username sudah digunakan.";

    }else{

        $hash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        mysqli_query(
            $conn,
            "INSERT INTO users
            (username,password)
            VALUES
            ('$username','$hash')"
        );

        header(
        "Location: login.php"
        );

        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link rel="stylesheet"
href="../assets/style.css">

</head>
<body>

<div class="auth-container">

<div class="glass auth-card">

<h2>📝 Register</h2>

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
name="register">

Register

</button>

</form>

<p>

Sudah punya akun?

<a href="login.php">
Login
</a>

</p>

</div>

</div>

</body>
</html>