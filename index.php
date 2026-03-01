<?php
$namaWeb = "I'M SEMA";
$tagline = "Self Management Habit Tracker";
$deskripsi = "I'M SEMA adalah website untuk membantu kamu mencatat, memantau, dan membangun kebiasaan sehari-hari secara mandiri.";
$tahun = date("Y");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $namaWeb; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* BODY BACKGROUND IMAGE */
body{
    min-height:100vh;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), /* overlay */
        url('img/stacks.png'); /* GANTI DENGAN PATH GAMBAR KAMU */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position:relative;
    overflow-x:hidden;
}


/* CONTAINER CARD */
.main-box{
    max-width: 900px;
    margin: 80px auto;
    padding: 40px;
    background: #fffde7;
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
    z-index: 2;
}

/* TITLE WRAPPER */
.title-wrapper{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin-bottom: 10px;
}

/* LOGO BULAT */
.logo-circle{
    width: 85px;              /* diperbesar sedikit */
    height: 85px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fbc02d;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    cursor: pointer;
}

/* HOVER EFFECT GLOW */
.logo-circle:hover{
    transform: scale(1.1);
    box-shadow: 
        0 0 15px #fbc02d,
        0 0 30px #f57f17,
        0 10px 25px rgba(0,0,0,0.3);
}

/* HEADER TITLE */
.main-title{
    color: #f57f17;
    margin: 0;
    font-weight: bold;
}

/* TAGLINE */
.tagline{
    text-align: center;
    color: #f57f17;
    font-weight: bold;
    margin-bottom: 30px;
}

/* SECTION TITLE */
.main-box h2{
    color: #f57f17;
    margin-top: 30px;
}

/* LIST STYLE */
.main-box ul{
    list-style: none;
    padding: 0;
}

.main-box ul li{
    background: white;
    border: 2px solid #fbc02d;
    margin: 10px 0;
    padding: 12px;
    border-radius: 15px;
}

/* BUTTON */
.main-btn{
    display: inline-block;
    margin-top: 25px;
    padding: 12px 30px;
    background: #fbc02d;
    color: white;
    border-radius: 20px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.main-btn:hover{
    background: #f57f17;
    transform: scale(1.08);
}

/* FOOTER */
.footer{
    text-align: center;
    margin-top: 30px;
    color: #f57f17;
    font-weight: bold;
}

/* EMOJI */
.emoji{
    position: absolute;
    top: -50px;
    animation-name: fall;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    z-index: 1;
}

@keyframes fall{
    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
    }
    100%{
        transform: translateY(110vh) rotate(360deg);
        opacity: 0;
    }
}
</style>
</head>

<body>

<div class="main-box">

    <!-- TITLE + LOGO SEJAJAR -->
    <div class="title-wrapper">
        <img src="img/logo_index.jpeg" alt="Logo" class="logo-circle">
        <h1 class="main-title"><?php echo $namaWeb; ?></h1>
    </div>

    <div class="tagline"><?php echo $tagline; ?></div>

    <h2>👋 Kenalan Yuk!</h2>
    <p><?php echo $deskripsi; ?></p>

    <h2>✨ Bisa Untuk Apa Aja?</h2>
    <ul>
        <li>📒 Mencatat kebiasaan harian</li>
        <li>📈 Melihat perkembangan diri</li>
        <li>⏰ Manajemen waktu pribadi</li>
        <li>💛 Motivasi membangun rutinitas</li>
        <li>🎯 Tracking target harian</li>
    </ul>

    <h2>🎯 Tujuannya?</h2>
    <p>
        Membantu kamu jadi lebih disiplin, konsisten,
        dan bahagia menjalani rutinitas sehari-hari 🌈
    </p>

    <h2>🚀 Mulai Sekarang!</h2>
    <p>
        Yuk bangun kebiasaan positif bersama <?php echo $namaWeb; ?> 💪✨
    </p>

    <a href="login.php" class="main-btn">🌟 Yuk Dicoba</a>

    <div class="footer">
        © <?php echo $tahun; ?> - <?php echo $namaWeb; ?> | Made by Ervi
    </div>

</div>