<?php
include "config.php";

// ======= SESSION AMAN =======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil data user
$idUser = $_SESSION['id'] ?? 0;
$namaUser = $_SESSION['name'] ?? "Bu Ervi";
$noHp = $_SESSION['phone'] ?? "62+ 822-7574-9108"; // pastikan session phone tersedia
$foto = $_SESSION['photo'] ?? "img/Profile.jpeg"; // ganti default jika belum ada
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>
<style>
body {
    min-height: 100vh;

    /* Background */
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
        url('img/wave.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    /* Center container */
    display: flex;
    justify-content: center; /* tengah horizontal */
    align-items: center;     /* tengah vertikal */

    position: relative;
    overflow-x: hidden;

    margin: 0; /* hilangkan margin default */
}

.container {
    text-align: center;
    background: rgba(255, 255, 255, 0.9);
    padding: 40px 30px;
    border-radius: 25px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    max-width: 350px;
}

.profile-img {
    width: 160px;
    height: 220px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #FFD54F;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    margin-bottom: 20px;
}

h2 {
    font-size: 24px;
    color: #FF8A65;
    margin-bottom: 8px;
}

p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 30px;
    background: linear-gradient(135deg, #FFD54F, #FFB74D);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}
</style>
</head>
<body>

<div class="container">
    <img src="<?= htmlspecialchars($foto); ?>" alt="Foto Profil" class="profile-img">
    <h2><?= htmlspecialchars($namaUser); ?></h2>
    <p>📞 <?= htmlspecialchars($noHp); ?></p>
    <a href="beranda.php" class="btn">← Kembali ke Beranda</a>
</div>

</body>
</html>