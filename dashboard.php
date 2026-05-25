<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? '';

$sql = "SELECT * FROM tasks
        WHERE user_id='$user_id'
        AND task LIKE '%$search%'";

if ($filter == "done") {
    $sql .= " AND status='done'";
}

if ($filter == "pending") {
    $sql .= " AND status='pending'";
}

$sql .= " ORDER BY id DESC";

$tasks = mysqli_query($conn, $sql);

$total = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total
        FROM tasks
        WHERE user_id='$user_id'"
    )
);

$done = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total
        FROM tasks
        WHERE user_id='$user_id'
        AND status='done'"
    )
);

$pending = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total
        FROM tasks
        WHERE user_id='$user_id'
        AND status='pending'"
    )
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet"
href="assets/style.css">

</head>
<body>

<div class="container">

<nav class="navbar">

<div class="logo">
🚀 Todo Dashboard
</div>

<a
href="auth/logout.php"
class="logout-btn">
Logout
</a>

</nav>

<h1>My Tasks</h1>

<div class="stats">

<div class="card">
<h2><?= $total['total']; ?></h2>
<p>Total Tasks</p>
</div>

<div class="card">
<h2><?= $done['total']; ?></h2>
<p>Completed</p>
</div>

<div class="card">
<h2><?= $pending['total']; ?></h2>
<p>Pending</p>
</div>

</div>

<div class="glass form-box">

<form
action="task/add.php"
method="POST">

<input
type="text"
name="task"
placeholder="Tambah tugas..."
required>

<input
type="date"
name="deadline">

<button>
Tambah
</button>

</form>

</div>

<div class="glass search-box">

<form method="GET">

<input
type="text"
name="search"
placeholder="Cari tugas...">

<select
name="filter">

<option value="">
Semua
</option>

<option value="done">
Selesai
</option>

<option value="pending">
Pending
</option>

</select>

<button>
Cari
</button>

</form>

</div>

<div class="task-list">

<?php while($row =
mysqli_fetch_assoc($tasks)): ?>

<div class="task-card">

<div>

<h3 class="<?=
$row['status']=='done'
?
'done'
:
''
?>">

<?= htmlspecialchars(
$row['task']
); ?>

</h3>

<p>

Deadline :

<?= $row['deadline']
?: '-' ?>

</p>

</div>

<div class="actions">

<a
class="success"
href="task/toggle.php?id=
<?= $row['id']; ?>">
✓
</a>

<a
class="info"
href="task/edit.php?id=
<?= $row['id']; ?>">
Edit
</a>

<a
class="danger"
onclick="
return confirm(
'Hapus tugas?'
)"
href="task/delete.php?id=
<?= $row['id']; ?>">
Delete
</a>

</div>

</div>

<?php endwhile; ?>

</div>

</div>

<script src="assets/script.js"></script>

</body>
</html>