<?php
include "config.php";

$name     = mysqli_real_escape_string($conn, $_POST['name']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role     = "user";

/* Cek email */
$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($cek) > 0){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Email Sudah Terdaftar</title>
<style>
body{
    margin:0;
    height:100vh;
    background: linear-gradient(135deg, #FFD54F, #FFF176);
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: Arial, sans-serif;
    overflow:hidden;
}
.box{
    background:#fffde7;
    padding:40px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    position:relative;
    z-index:2;
}
.box h2{
    color:#f57f17;
}
.btn-custom{
    display:inline-block;
    margin-top:20px;
    padding:10px 25px;
    background:#fbc02d;
    color:white;
    text-decoration:none;
    border-radius:20px;
    font-weight:bold;
    transition:0.3s;
}
.btn-custom:hover{
    background:#f57f17;
    transform:scale(1.08);
}
.emoji{
    position:absolute;
    top:-50px;
    animation:fall linear infinite;
    z-index:1;
}
@keyframes fall{
    0%{transform:translateY(0) rotate(0deg);opacity:1;}
    100%{transform:translateY(110vh) rotate(360deg);opacity:0;}
}
</style>
</head>
<body>

<div class="box">
    <h2>⚠ Email Sudah Terdaftar</h2>
    <p>Gunakan email lain atau login ke akunmu.</p>
    <a href="register.php" class="btn-custom">Kembali</a>
</div>

<script>
const emojis = ["🌼","✨","💛","🌻","⭐"];
for(let i=0;i<80;i++){
    let span=document.createElement("span");
    span.className="emoji";
    span.innerText=emojis[Math.floor(Math.random()*emojis.length)];
    span.style.left=Math.random()*100+"vw";
    span.style.fontSize=(20+Math.random()*30)+"px";
    span.style.animationDuration=(4+Math.random()*6)+"s";
    span.style.animationDelay=Math.random()*5+"s";
    document.body.appendChild(span);
}
</script>

</body>
</html>
<?php
exit;
}

/* Simpan */
$query = "INSERT INTO users (username,email,password,role)
          VALUES ('$name','$email','$password','$role')";

if(mysqli_query($conn,$query)){
    header("Location: login.php");
    exit;
}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gagal Mendaftar</title>
<style>
body{
    margin:0;
    height:100vh;
    background: linear-gradient(135deg, #FFD54F, #FFF176);
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: Arial, sans-serif;
}
.box{
    background:#fffde7;
    padding:40px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}
.box h2{
    color:#f57f17;
}
</style>
</head>
<body>
<div class="box">
    <h2>❌ Gagal Mendaftar</h2>
    <p>Terjadi kesalahan saat menyimpan data.</p>
</div>
</body>
</html>
<?php
}
?>