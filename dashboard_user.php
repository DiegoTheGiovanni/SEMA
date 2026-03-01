<?php
include "config.php";

if(!isset($_SESSION['login']) || $_SESSION['role']!="user"){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5 text-center">

<h2>Dashboard User</h2>
<p>Halo, <?= $_SESSION['name']; ?></p>

<a href="logout.php" class="btn btn-danger">Logout</a>

</div>

</body>
</html>