<?php $namaUser = $_SESSION['name']; ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
    background:#fffde7;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.logo{
    font-family: 'Poppins', sans-serif;
    font-weight: 900;
    font-size: 26px;
    letter-spacing: 2px;
    background: linear-gradient(90deg, #fbc02d, #f57f17);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-transform: uppercase;
    transition: 0.3s ease;
    cursor: pointer;
}

/* Hover Effect */
.logo:hover{
    text-shadow: 
        0 0 10px rgba(251,192,45,0.7),
        0 0 20px rgba(245,127,23,0.6);
    transform: scale(1.05);
}

/* RIGHT SIDE */
.nav-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* USER NAME */
.profile span{
    font-weight:bold;
    color:#f57f17;
}

/* BUTTON STYLE */
.nav-btn{
    padding:8px 16px;
    border-radius:20px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
    font-size:14px;
}

/* PROFIL BUTTON */
.profil-btn{
    background:#fbc02d;
    color:white;
}

.profil-btn:hover{
    background:#f57f17;
    transform:scale(1.05);
}

/* HELP BUTTON */
.help-btn{
    background:white;
    color:#f57f17;
    border:2px solid #fbc02d;
}

.help-btn:hover{
    background:#fbc02d;
    color:white;
    transform:scale(1.05);
}

/* LOGOUT */
.logout-btn{
    color:#f57f17;
    display:flex;
    align-items:center;
    transition:0.3s;
}

.logout-btn:hover{
    transform:scale(1.2);
}
</style>

<!-- NAVBAR -->
<div class="navbar">

    <div class="logo" title="">
         I'M SEMA
    </div>

    <div class="nav-right">

        <!-- Profil Button -->
        <a href="profil.php" class="nav-btn profil-btn">
            Profil
        </a>

        <!-- Nama User -->
        <div class="profile">
            <span><?php echo $namaUser; ?></span>
        </div>

        <!-- Help Button (sekarang ke Help.php) -->
        <a href="Help.php" class="nav-btn help-btn">
            Help
        </a>

        <!-- Logout -->
        <a href="logout.php" class="logout-btn" title="Logout">
            <span class="material-icons">logout</span>
        </a>

    </div>

</div>