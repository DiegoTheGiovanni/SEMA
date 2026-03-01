<?php
include "config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != "user"){
    header("Location: dashboard_admin.php");
    exit;
}

if(isset($_POST['submit'])){

$user_id = $_SESSION['id'];

$aktivitas = mysqli_real_escape_string($conn, $_POST['aktivitas']);
$bentuk1 = mysqli_real_escape_string($conn, $_POST['bentuk1']);
$perilaku = mysqli_real_escape_string($conn, $_POST['perilaku']);
$bentuk2 = mysqli_real_escape_string($conn, $_POST['bentuk2']);
$hambatan = mysqli_real_escape_string($conn, $_POST['hambatan']);
$usaha = mysqli_real_escape_string($conn, $_POST['usaha']);

$positif_diri = mysqli_real_escape_string($conn, $_POST['positif_diri']);
$positif_keluarga = mysqli_real_escape_string($conn, $_POST['positif_keluarga']);
$positif_sekolah = mysqli_real_escape_string($conn, $_POST['positif_sekolah']);

$negatif_diri = mysqli_real_escape_string($conn, $_POST['negatif_diri']);
$negatif_keluarga = mysqli_real_escape_string($conn, $_POST['negatif_keluarga']);
$negatif_sekolah = mysqli_real_escape_string($conn, $_POST['negatif_sekolah']);

$review_awal = mysqli_real_escape_string($conn, $_POST['review_awal']);
$review_kedua = mysqli_real_escape_string($conn, $_POST['review_kedua']);
$review_akhir = mysqli_real_escape_string($conn, $_POST['review_akhir']);

mysqli_query($conn, "
INSERT INTO goal_settings (
user_id,
aktivitas,
bentuk_aktivitas,
perilaku,
bentuk_perilaku,
hambatan,
usaha,
positif_diri,
positif_keluarga,
positif_sekolah,
negatif_diri,
negatif_keluarga,
negatif_sekolah,
review_awal,
review_kedua,
review_akhir
) VALUES (
'$user_id',
'$aktivitas',
'$bentuk1',
'$perilaku',
'$bentuk2',
'$hambatan',
'$usaha',
'$positif_diri',
'$positif_keluarga',
'$positif_sekolah',
'$negatif_diri',
'$negatif_keluarga',
'$negatif_sekolah',
'$review_awal',
'$review_kedua',
'$review_akhir'
)
");

header("Location: goal_setting.php?success=1");
exit;
}

if(isset($_GET['success'])){
echo "<script>alert('Goal berhasil disimpan');
      window.location.href='beranda.php';
      </script>";
}

$namaUser = $_SESSION['namaUser'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/navbar/navbar.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Goal Setting</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background: 
        linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.35)), /* overlay gelap */
        url('img/bgk4.png'); /* path gambar */

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    min-height:100vh;
    position:relative;
    overflow-x:hidden;
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn{
    from{ opacity:0; transform:translateY(10px);}
    to{ opacity:1; transform:translateY(0);}
}

/* CONTAINER UTAMA */
.container{
    max-width:900px;
    margin:120px auto 50px;
    background: rgba(194, 197, 2, 0.75);
    backdrop-filter: blur(15px);
    padding:40px;
    border-radius:25px;
    box-shadow:0 10px 35px rgba(255, 191, 0, 0.83);
}

/* JUDUL */
.container h2{
    color:#B08900;
    margin-bottom:25px;
}

/* LABEL */
label{
    display:block;
    margin:15px 0 8px;
    color:#7A6500;
    font-weight:500;
}

/* INPUT & TEXTAREA */
textarea, select{
    width:100%;
    padding:12px;
    border-radius:12px;
    border:1px solid #dddddd;
    font-size:14px;
    resize:vertical;
    background:white;
}

textarea{
    min-height:70px;
}

/* BUTTON */
button{
    margin-top:25px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:30px;
    background:#FFE066;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(255,193,7,0.3);
}

button:hover{
    background:#FFD54F;
    transform:translateY(-3px);
}
</style>
</head>

<body>
<div class="container">
    <h2>Goal Setting</h2>

    <form method="POST" action="">

        <label><strong>1. Aktivitas yang perlu diubah</strong></label>
        <textarea name="aktivitas"></textarea>

        <label>Bentuk Perubahan</label>
        <textarea name="bentuk1"></textarea>

        <label><strong>2. Perilaku / kondisi yang perlu diubah</strong></label>
        <textarea name="perilaku"></textarea>

        <label>Bentuk Perubahan</label>
        <textarea name="bentuk2"></textarea>

        <label><strong>3. Hambatan yang perlu dikelola</strong></label>
        <textarea name="hambatan"></textarea>

        <label>Usaha yang perlu dilakukan</label>
        <textarea name="usaha"></textarea>

        <label><strong>4. Konsekuensi Positif</strong></label>
        <label>Dari diri:</label>
        <textarea name="positif_diri"></textarea>

        <label>Dari keluarga:</label>
        <textarea name="positif_keluarga"></textarea>

        <label>Dari sekolah:</label>
        <textarea name="positif_sekolah"></textarea>

        <label><strong>5. Konsekuensi Negatif</strong></label>
        <label>Dari diri:</label>
        <textarea name="negatif_diri"></textarea>

        <label>Dari keluarga:</label>
        <textarea name="negatif_keluarga"></textarea>

        <label>Dari sekolah:</label>
        <textarea name="negatif_sekolah"></textarea>

        <label><strong>6. Review</strong></label>

        <label>Review Awal:</label>
        <select name="review_awal">
            <option value="">-- Pilih --</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
            <option value="Kurang">Kurang</option>
        </select>

        <label>Review Kedua:</label>
        <select name="review_kedua">
            <option value="">-- Pilih --</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
            <option value="Kurang">Kurang</option>
        </select>

        <label>Review Akhir:</label>
        <select name="review_akhir">
            <option value="">-- Pilih --</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
            <option value="Kurang">Kurang</option>
        </select>

        <button type="submit" name="submit">Simpan Goal</button>

    </form>
</div>

</body>
</html>