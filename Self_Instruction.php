<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$namaUser = $_SESSION['name'] ?? "User";

// Daftar video
$videos = [
    "videos/video1.mp4",
    "videos/video2.mp4",
    "videos/video3.mp4",
    "videos/video4.mp4",
];

// Acak urutan video
shuffle($videos);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Self Instruction</title>

<style>
/* BODY BACKGROUND IMAGE */
body{
    min-height:100vh;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), /* overlay */
        url('img/bgk2.png'); /* GANTI DENGAN PATH GAMBAR KAMU */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position:relative;
    overflow-x:hidden;
}

.container{
    max-width: 800px;
    background: white;
    margin: auto;
    padding: 25px;
    border-radius: 25px;
    text-align: center;
}

h2{
    color: #FF5F9E;
}

/* Grid untuk video biasa */
.video-grid{
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin: 20px 0;
}

.video-box{
    width: 300px;        /* Lebar kotak video */
    height: 180px;       /* Tinggi kotak video */
    border-radius: 15px; /* Sudut tumpul */
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    display: flex;
    justify-content: center;
    align-items: center;
}

.video-box video{
    width: 100%;
    height: 100%;
    object-fit: cover;   /* Pastikan video memenuhi kotak */
    border-radius: 15px; /* Sesuai sudut kotak */
}

button{
    width: 100%;
    padding: 12px;
    background: #7ED957;
    border: none;
    color: white;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 15px;
}

button:hover{
    background: #6BCB4E;
}
</style>    
</head>

<body>

<div class="container">

<h2>🧠 Self Instruction</h2>

<p>Halo, <b><?= $namaUser ?></b> 👋  
Tonton video berikut untuk membangun motivasimu.</p>

<div class="video-grid">
<?php foreach($videos as $video): ?>
    <div class="video-box">
        <video controls>
            <source src="<?= $video ?>" type="video/mp4">
        </video>
    </div>
<?php endforeach; ?>
</div>

<form action="questions.php">
    <button type="submit">Next ➡️</button>
</form>

</div>

</body>
</html>