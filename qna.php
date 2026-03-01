<?php
require "config.php";

/* Proteksi login */
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$session_id = $_SESSION['monitor_session_id'] ?? 0;
$namaUser = $_SESSION['name'] ?? "User";

/* Ambil aktivitas dari DB menggunakan session_id */
$activities = [];
if($session_id){
    $stmt = $conn->prepare("
        SELECT id, activity_name, hours 
        FROM monitoring_details
        WHERE session_id = ?
    ");
    $stmt->bind_param("i", $session_id);
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = $res->fetch_assoc()){
        $activities[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Evaluasi Aktivitas</title>
<style>
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

.card{
    background:white;
    max-width:600px;
    margin:auto;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.item{
    margin:20px 0;
    padding:10px;
    border-bottom:1px solid #eee;
}

.item b{
    display:block;
    margin-bottom:8px;
}

label{
    margin-right:15px;
}

button{
    width:100%;
    padding:12px;
    background:#7ED957;
    border:none;
    color:white;
    border-radius:20px;
    margin-top:20px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#6BCB4E;
}

.error-message{
    background:#ffe5e5;
    color:#c00000;
    padding:12px;
    border-radius:8px;
    margin:20px 0;
    font-weight:500;
}
</style>
</head>

<body>
<div class="card">
<h2>📋 Evaluasi Aktivitas</h2>
<p>Halo, <?= htmlspecialchars($namaUser); ?> 👋</p>
<p>Silakan tentukan apakah aktivitas berikut produktif atau tidak.</p>

<?php if(empty($activities)): ?>
    <div class="error-message">
        Belum ada aktivitas untuk hari ini.
    </div>
<?php else: ?>
<form method="POST" action="save_answer.php">

<?php foreach($activities as $row): ?>
<div class="item">
<input type="hidden" name="detail_id[]" value="<?= $row['id']; ?>">
<b><?= htmlspecialchars($row['activity_name']); ?> (<?= $row['hours']; ?> jam)</b>

<label>
    <input type="radio" name="answer[<?= $row['id']; ?>]" value="ya" required>
    Produktif
</label>

<label>
    <input type="radio" name="answer[<?= $row['id']; ?>]" value="tidak">
    Tidak Produktif
</label>
</div>
<?php endforeach; ?>

<button type="submit">Next ➡️</button>
</form>
<?php endif; ?>

</div>
</body>
</html>