<?php
include "config.php";

// ======= SESSION AMAN =======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ======= AMBIL USER =======
$idUser = $_SESSION['id'] ?? 0;
$namaUser = $_SESSION['name'] ?? "User";

// ======= SELF MONITORING =======
$qSelfMonit = mysqli_query($conn, "
SELECT 
    d.activity_name,
    d.hours,
    d.is_productive
FROM monitoring_sessions s
JOIN monitoring_details d ON d.session_id = s.id
WHERE s.user_id = '$idUser'
");

// ======= GOAL SETTING =======
// Cek apakah kolom created_at ada
$goalCheck = mysqli_query($conn, "SHOW COLUMNS FROM goal_settings LIKE 'created_at'");
$goalOrder = mysqli_num_rows($goalCheck) ? "ORDER BY created_at DESC" : "ORDER BY id DESC";

$qGoal = mysqli_query($conn, "
SELECT *
FROM goal_settings
WHERE user_id = '$idUser'
$goalOrder
LIMIT 1
");

$goal = mysqli_fetch_assoc($qGoal);

// ======= SELF INSTRUCTION =======
$siCheck = mysqli_query($conn, "SHOW COLUMNS FROM selfinstruction_questions LIKE 'created_at'");
$siOrder = mysqli_num_rows($siCheck) ? "ORDER BY created_at DESC" : "ORDER BY id DESC";

$qSI = mysqli_query($conn, "
SELECT *
FROM selfinstruction_questions
WHERE idUser = '$idUser'
$siOrder
LIMIT 1
");

$data = mysqli_fetch_assoc($qSI);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Self Development</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    padding:30px;
}
.container{
    max-width:900px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:10px;
}
h1{
    text-align:center;
    margin-bottom:20px;
}
.section{
    margin-bottom:25px;
}
.section-title{
    font-weight:bold;
    margin-bottom:10px;
    font-size:18px;
}
.table{
    width:100%;
    border-collapse:collapse;
}
.table th, .table td{
    border:1px solid #ccc;
    padding:8px;
    text-align:left;
}
.box{
    margin-bottom:12px;
}
.label{
    font-weight:bold;
}
.print-btn{
    margin-top:20px;
    padding:10px 20px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
@media print {
    .print-btn{display:none;}
}
</style>
</head>
<body>

<div class="container">

<h1>LAPORAN SELF DEVELOPMENT</h1>
<p><b>Nama:</b> <?= htmlspecialchars($namaUser); ?></p>
<p><b>Tanggal Laporan:</b> <?= date('d M Y'); ?></p>

<!-- ======= SELF MONITORING ======= -->
<div class="section">
<div class="section-title">1. Self Monitoring</div>
<table class="table">
<tr>
<th>Aktivitas</th>
<th>Durasi (Jam)</th>
<th>Status</th>
</tr>
<?php while($monit = mysqli_fetch_assoc($qSelfMonit)): ?>
<tr>
<td><?= htmlspecialchars($monit['activity_name']); ?></td>
<td><?= htmlspecialchars($monit['hours']); ?></td>
<td><?= ($monit['is_productive'] ?? '')=='ya' ? 'Produktif' : 'Tidak Produktif'; ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>

<!-- ======= GOAL SETTING ======= -->
<div class="section">
<div class="section-title">2. Goal Setting</div>
<?php if($goal): ?>
<div class="box"><span class="label">Aktivitas Target:</span> <?= htmlspecialchars($goal['aktivitas'] ?? '-'); ?></div>
<div class="box"><span class="label">Bentuk Aktivitas:</span> <?= htmlspecialchars($goal['bentuk_aktivitas'] ?? '-'); ?></div>
<div class="box"><span class="label">Perilaku:</span> <?= htmlspecialchars($goal['perilaku'] ?? '-'); ?></div>
<div class="box"><span class="label">Bentuk Perilaku:</span> <?= htmlspecialchars($goal['bentuk_perilaku'] ?? '-'); ?></div>
<div class="box"><span class="label">Hambatan:</span> <?= htmlspecialchars($goal['hambatan'] ?? '-'); ?></div>
<div class="box"><span class="label">Usaha:</span> <?= htmlspecialchars($goal['usaha'] ?? '-'); ?></div>

<h4>Dampak Positif</h4>
<div class="box"><span class="label">Untuk Diri:</span> <?= htmlspecialchars($goal['positif_diri'] ?? '-'); ?></div>
<div class="box"><span class="label">Untuk Keluarga:</span> <?= htmlspecialchars($goal['positif_keluarga'] ?? '-'); ?></div>
<div class="box"><span class="label">Untuk Sekolah:</span> <?= htmlspecialchars($goal['positif_sekolah'] ?? '-'); ?></div>

<h4>Dampak Negatif</h4>
<div class="box"><span class="label">Untuk Diri:</span> <?= htmlspecialchars($goal['negatif_diri'] ?? '-'); ?></div>
<div class="box"><span class="label">Untuk Keluarga:</span> <?= htmlspecialchars($goal['negatif_keluarga'] ?? '-'); ?></div>
<div class="box"><span class="label">Untuk Sekolah:</span> <?= htmlspecialchars($goal['negatif_sekolah'] ?? '-'); ?></div>

<h4>Review</h4>
<div class="box"><span class="label">Review Awal:</span> <?= htmlspecialchars($goal['review_awal'] ?? '-'); ?></div>
<div class="box"><span class="label">Review Kedua:</span> <?= htmlspecialchars($goal['review_kedua'] ?? '-'); ?></div>
<div class="box"><span class="label">Review Akhir:</span> <?= htmlspecialchars($goal['review_akhir'] ?? '-'); ?></div>

<?php else: ?>
<div class="box"><i>Belum ada goal setting.</i></div>
<?php endif; ?>
</div>

<!-- ======= SELF INSTRUCTION ======= -->
<div class="section">
<div class="section-title">3. Self Instruction</div>
<?php if($data): ?>
<div class="box"><span class="label">Pertanyaan 1:</span> <?= htmlspecialchars($data['pertanyaanPertama'] ?? '-'); ?></div>
<div class="box"><span class="label">Pertanyaan 2:</span> <?= htmlspecialchars($data['pertanyaanKedua'] ?? '-'); ?></div>
<div class="box"><span class="label">Pertanyaan 3:</span> <?= htmlspecialchars($data['pertanyaanKetiga'] ?? '-'); ?></div>
<div class="box"><span class="label">Pertanyaan 4:</span> <?= htmlspecialchars($data['pertanyaanKeempat'] ?? '-'); ?></div>
<div class="box"><span class="label">Pertanyaan 5:</span> <?= htmlspecialchars($data['pertanyaanKelima'] ?? '-'); ?></div>
<?php else: ?>
<div class="box"><i>Belum ada self instruction.</i></div>
<?php endif; ?>
</div>

<button class="print-btn" onclick="window.print()">Print / Save PDF</button>
</div>

</body>
</html>