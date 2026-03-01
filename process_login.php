<?php
require "config.php";

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($email && $password){

    $email = mysqli_real_escape_string($conn,$email);

    $q = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($q)==1){

        $u = mysqli_fetch_assoc($q);

        if(password_verify($password,$u['password'])){

            session_regenerate_id(true); // penting

            $_SESSION['login'] = 1;
            $_SESSION['id']    = $u['id'];
            $_SESSION['name']  = $u['username'];
            $_SESSION['email']  = $u['email'];
            $_SESSION['role']  = $u['role'];

            if($u['role']=='admin'){
                header("Location: dashboard_admin.php");
            }else{
                header("Location: beranda.php");
            }
            exit;
        }
    }
}

header("Location: login.php");
exit;