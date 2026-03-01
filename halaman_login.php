<?php
include "config.php";

if(isset($_SESSION['login'])){
    if($_SESSION['role']=="admin"){
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_user.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container text-center mt-5">
    <h2>Welcome</h2>
    <a href="login.php" class="btn btn-primary">Login</a>
    <a href="register.php" class="btn btn-success">Register</a>
</div>

</body>
</html>