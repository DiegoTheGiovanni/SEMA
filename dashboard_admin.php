<?php
include "config.php";

// Cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// Cek role admin
if($_SESSION['role'] != "admin"){
    header("Location: beranda.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>

<body>

<h2>Dashboard Admin</h2>

<p>Halo, <?php echo $_SESSION['name']; ?> 👋</p>

<a href="logout.php">Logout</a>

</body>
</html>