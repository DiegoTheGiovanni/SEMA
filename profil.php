<?php
include "config.php";

// ======= SESSION AMAN =======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ======= AMBIL USER =======
$idUser = $_SESSION['id'] ?? 0;
$namaUser = $_SESSION['name'] ?? "User";

// Pastikan kolom 'username' ada di tabel users
$colCheck = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'username'");
if(mysqli_num_rows($colCheck) > 0){
    $query = "SELECT * FROM users WHERE username = '".mysqli_real_escape_string($conn, $_SESSION['username'] ?? '')."'";
}else{
    // Jika 'username' tidak ada, pakai 'id' untuk ambil data
    $query = "SELECT * FROM users WHERE id = '$idUser'";
}

$result = mysqli_query($conn, $query);

$userData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil</title>
<style>
/* BODY BACKGROUND IMAGE */
body{
    min-height:100vh;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), /* overlay */
        url('img/bgk3.png'); /* GANTI DENGAN PATH GAMBAR KAMU */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position:relative;
    overflow-x:hidden;
}

.container{
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
h2{
    text-align:center;
    margin-bottom: 25px;
    color: #FBC02D;
}
.box{
    margin-bottom: 15px;
}
.label{
    font-weight:bold;
}

/* Tombol Kembali */
.back-btn{
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    background: #FFF176; /* kuning pastel */
    color: #F57F17;
    font-weight: bold;
    text-decoration: none;
    border-radius: 25px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.back-btn:hover{
    background: #FBC02D; /* lebih kontras saat hover */
    color: white;
    transform: translateY(-3px);
}
</style>
</head>
<body>
<div class="container">
<h2>Profil Pengguna</h2>

<div class="box"><span class="label">Nama:</span> <?= htmlspecialchars($userData['name'] ?? $namaUser); ?></div>
<div class="box"><span class="label">Email:</span> <?= htmlspecialchars($userData['email'] ?? '-'); ?></div>
<div class="box"><span class="label">Username:</span> <?= htmlspecialchars($userData['username'] ?? '-'); ?></div>

<!-- Tombol Kembali -->
<a href="beranda.php" class="back-btn">← Kembali ke Beranda</a>

</div>
</body>
</html>