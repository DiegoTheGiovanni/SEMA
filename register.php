<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register Lucu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg, #FFD54F, #FFF176);
    overflow: hidden;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* REGISTER BOX (sama seperti login-box) */
.register-box{
    width: 350px;
    padding: 35px;
    background: #fffde7;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
    z-index: 2;
}

.register-box h2{
    margin-bottom: 20px;
    color: #f57f17;
}

/* Input */
.register-box .form-control{
    border-radius: 15px;
    border: 2px solid #fbc02d;
}

.register-box .form-control:focus{
    border-color: #f57f17;
    box-shadow: none;
}

/* Button Daftar */
.register-btn-main{
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 20px;
    background: #fbc02d;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.register-btn-main:hover{
    background: #f57f17;
    transform: scale(1.05);
}

/* Login Link Button */
.login-btn-link{
    display: inline-block;
    margin-top: 10px;
    padding: 8px 18px;
    background: white;
    color: #f57f17;
    border: 2px solid #fbc02d;
    border-radius: 20px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

.login-btn-link:hover{
    background: #fbc02d;
    color: white;
    transform: scale(1.05);
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

<div class="register-box">
    <h2>Register</h2>

    <form action="process_register.php" method="POST">

        <input type="text" 
        name="name" 
        class="form-control mb-3" 
        placeholder="Nama" required>

        <input type="email" 
        name="email" 
        class="form-control mb-3" 
        placeholder="Email" required>

        <input type="password" 
        name="password" 
        class="form-control mb-3" 
        placeholder="Password" required>

        <input type="hidden" name="role" value="user">

        <button type="submit" class="register-btn-main">
            Daftar
        </button>

    </form>

    <p class="mt-3">Sudah punya akun?</p>
    <a href="login.php" class="login-btn-link">Login</a>

</div>

<script>
const emojis = ["🌼","✨","💛","🌻","⭐"];
const total = 120;

for(let i = 0; i < total; i++){
    let span = document.createElement("span");
    span.className = "emoji";
    span.innerText = emojis[Math.floor(Math.random() * emojis.length)];

    span.style.left = Math.random() * 100 + "vw";
    span.style.fontSize = (20 + Math.random() * 30) + "px";
    span.style.animationDuration = (4 + Math.random() * 6) + "s";
    span.style.animationDelay = Math.random() * 5 + "s";

    document.body.appendChild(span);
}
</script>

</body>
</html>