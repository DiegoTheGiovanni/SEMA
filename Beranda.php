<?php
include "config.php";

// Cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// Cek bukan admin
if($_SESSION['role'] != "user"){
    header("Location: dashboard_admin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/navbar/navbar.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Beranda</title>

<style>
@import url('<?php echo dirname($_SERVER['PHP_SELF']); ?>/navbar/navbar.css');
/* IMPORT FONT */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* FADE IN */
body{
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn{
    from{ opacity:0; transform:translateY(10px);}
    to{ opacity:1; transform:translateY(0);}
}

/* BODY BACKGROUND IMAGE */
body{
    min-height:100vh;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), /* overlay */
        url('img/wave.png'); /* GANTI DENGAN PATH GAMBAR KAMU */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position:relative;
    overflow-x:hidden;
}

<?php include 'navbar/nav.css' ?>

/* CONTENT */
.container{
    text-align:center;
    margin-top:100px;
}

/* TITLE */
.container h1{
    color:white;
    margin-bottom:10px;
    font-size:32px;
}

/* SUBTITLE */
.container p{
    color:#f1f1f1;
    font-size:16px;
    opacity:0.9;
}

/* MENU GRID 2x2 */
.menu{
    display: grid;
    grid-template-columns: repeat(2, 260px);
    gap: 30px;

    justify-content: center;
    margin: 60px auto 0;
    max-width: 600px;
}

/* MENU CARD BESAR */
.menu a{
    width: 260px;
    height: 160px;
    padding: 20px;
    border-radius: 22px;
    text-decoration: none;
    color: white;
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.25);
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    transition: all 0.35s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* ICON */
.menu span{
    font-size: 48px;
    margin-bottom: 12px;
}

/* Hover Efek */
.menu a:hover{
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.45);
}

/* MEDIA QUERY UNTUK HP / LAYAR KECIL */
@media screen and (max-width: 768px){
    .menu{
        grid-template-columns: 1fr; /* 1 kolom */
        gap: 20px;
    }
    .menu a{
        width: 90%; /* tombol melebar */
        height: 140px; /* sedikit lebih kecil */
    }
}

/* ICON */
.menu span{
    font-size: 48px; /* ikon lebih besar */
    margin-bottom: 12px;
}

/* Hover Efek */
.menu a:hover{
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.45);
}
/* Self Monitoring */
.menu a[href="self_monitoring.php"]{
    background: linear-gradient(135deg, #FFB74D, #FF8A65); /* orange pastel */
}

/* Goal Setting */
.menu a[href="goal_setting.php"]{
    background: linear-gradient(135deg, #FFD54F, #FFF176); /* kuning pastel */
    color:#F57F17;
}

/* Self Instruction */
.menu a[href="self_instruction.php"]{
    background: linear-gradient(135deg, #4DB6AC, #26A69A); /* hijau teal */
}

/* Laporan */
.menu a[href="laporan.php"]{
    background: linear-gradient(135deg, #64B5F6, #42A5F5); /* biru cerah */
}

/* Hover Efek */
.menu a:hover{
    transform:translateY(-8px) scale(1.05);
    box-shadow:0 15px 35px rgba(0,0,0,0.45);
}

/* HOVER */
.menu a:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,0.4);
}

/* ICON */
.menu span{
    font-size:38px;
    display:block;
    margin-bottom:12px;
}

</style>
</head>

<body>
<?php include "navbar/nav.php"; ?>


<!-- CONTENT -->
<div class="container">

    <!-- Welcome Title -->
    <h1 class="welcome-title">Welcome, <?= htmlspecialchars($namaUser); ?> 👋</h1>

    <!-- Subtitle Paragraph -->
    <p class="welcome-subtitle">Yuk atur kebiasaan dan tujuan hidup kamu bersama <span class="highlight">I'M SEMA ✨</span></p>

    <!-- MENU -->
    <div class="menu">

        <!-- Self Monitoring -->
        <a href="self_monitoring.php">
            <span>📊</span>
            Self Monitoring
        </a>

        <!-- Goal Setting -->
        <a href="goal_setting.php">
            <span>🎯</span>
            Goal Setting
        </a>

        <!-- Self Instruction -->
        <a href="self_instruction.php">
            <span>🧠</span>
            Self Instruction
        </a>

        <!-- Laporan -->
        <a href="laporan.php">
            <span>📄</span>
            Laporan
        </a>
    </div>

</div>

<style>
/* Welcome Title */
.welcome-title{
    font-size:50px;
    font-weight:900;
    background: linear-gradient(90deg, #FFD54F, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom:12px;
    text-shadow: 0 3px 8px rgba(0,0,0,0.2);
    animation: fadeInDown 1s ease forwards;
}

/* Subtitle */
.welcome-subtitle{
    font-size:25px;
    color:white;
    opacity:0.95;
    margin-bottom:40px;
    animation: fadeInUp 1s ease forwards;
}

.welcome-subtitle .highlight{
    font-weight:700;
    background: linear-gradient(135deg, #FFD54F, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Animations */
@keyframes fadeInDown{
    from{opacity:0; transform:translateY(-20px);}
    to{opacity:1; transform:translateY(0);}
}
@keyframes fadeInUp{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}
</style>

</body>
</html>