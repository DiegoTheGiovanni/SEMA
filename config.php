<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

$host = "localhost"; // ganti dari 127.0.0.1
$user = "root";
$pass = "";          // kosongkan password
$db   = "login_system";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>