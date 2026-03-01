<?php
session_start();
require "config.php";

/* Proteksi login */
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$namaUser = $_SESSION['name'] ?? "";

// Ambil data user dari database (asumsi tabel users)
$user_id = $_SESSION['id'];
$result = mysqli_query($conn, "SELECT username, email, kelas, tgl_lahir FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];

    mysqli_query($conn, "UPDATE users SET username='$nama', email='$email', kelas='$kelas', tgl_lahir='$tgl_lahir' WHERE id='$user_id'");

    // update session
    $_SESSION['name'] = $nama;

    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#FFF8DC;
    padding:30px;
}

.card{
    background:white;
    max-width:600px;
    margin:auto;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.item{
    margin:15px 0;
}

.item label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

.item input{
    width:100%;
    padding:10px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:16px;
}

button{
    width:100%;
    padding:12px;
    background:#FFD700;
    border:none;
    color:#333;
    border-radius:20px;
    margin-top:20px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

button:hover{
    background:#FFC700;
}
</style>
</head>
<body>

<div class="card">
<h2>Edit Profil</h2>

<form method="POST" action="">
    <div class="item">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
    </div>

    <div class="item">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
    </div>

    <div class="item">
        <label>Kelas</label>
        <input type="text" name="kelas" value="<?= htmlspecialchars($user['kelas']); ?>" required>
    </div>

    <div class="item">
        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($user['tgl_lahir']); ?>" required>
    </div>

    <button type="submit">Simpan Perubahan</button>
</form>
</div>

</body>
</html>