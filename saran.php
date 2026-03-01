<?php
require "config.php";

// Pastikan session tidak double
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Proteksi login */
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

/* Pastikan session monitoring ada */
if(!isset($_SESSION['monitor_session_id'])){
    header("Location: beranda.php");
    exit;
}

$session_id = $_SESSION['monitor_session_id'];
$namaUser = $_SESSION['name'] ?? "User";

/* Ambil aktivitas dari DB */
$stmt = $conn->prepare("
    SELECT activity_name, hours, is_productive
    FROM monitoring_details
    WHERE session_id = ?
");
$stmt->bind_param("i", $session_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: beranda.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Saran Aktivitas</title>
<style>
/* BODY BACKGROUND IMAGE */
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
    max-width:700px;
    margin:auto;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

p.activity{
    margin:20px 0;
    padding:15px;
    background:#f9f9f9;
    border-radius:10px;
}

.good{color:green; font-weight:600;}
.bad{color:red; font-weight:600;}
.warning{color:orange; font-weight:600;}

button{
    width:100%;
    padding:12px;
    background:#FF8FB1;
    border:none;
    color:white;
    border-radius:20px;
    margin-top:20px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#FF6F91;
}
hr{
    border:none;
    border-bottom:1px solid #ddd;
    margin:15px 0;
}
</style>
</head>
<body>

<div class="card">
<h2>💡 Saran Untukmu</h2>
<p>Hai, <?= htmlspecialchars($namaUser) ?> 👋</p>
<hr>

<?php while($item = $result->fetch_assoc()): 

$name = $item['activity_name'];
$hours = $item['hours'];
$productivity = $item['is_productive'];

// Tentukan saran berdasarkan aktivitas
$saranList = [
    "Tidur" => "Tidur yang cukup sangat penting untuk kesehatan dan konsentrasi. Usahakan tidur antara 7-9 jam setiap malam.",
    "Sholat" => "Waktu ideal: ±5-10 menit per waktu sholat (±25-50 menit per hari). Lakukan dengan khusyuk dan tepat waktu.",
    "Mandi" => "Waktu ideal: 10-20 menit per sesi (1-2 kali sehari). Menjaga kebersihan tubuh penting untuk kesehatan.",
    "Sarapan" => "Waktu ideal: 15-30 menit. Sarapan bergizi membantu meningkatkan energi dan fokus di pagi hari.",
    "Belajar di Sekolah" => "Waktu ideal: 6-8 jam (sesuai jam sekolah). Manfaatkan waktu belajar dengan fokus dan aktif.",
    "Istirahat" => "Waktu ideal: 15-60 menit. Istirahat singkat membantu memulihkan energi dan menjaga produktivitas.",
    "Makan Siang" => "Waktu ideal: 20-30 menit. Konsumsi makanan seimbang agar stamina tetap terjaga.",
    "Pulang Sekolah" => "Waktu ideal: 15-60 menit (tergantung jarak). Gunakan waktu ini untuk relaksasi ringan.",
    "Les" => "Waktu ideal: 1-2 jam. Ikuti dengan fokus agar materi semakin dipahami.",
    "Mengerjakan PR" => "Waktu ideal: 1-2 jam. Kerjakan secara bertahap agar tidak menumpuk.",
    "Belajar Mandiri" => "Waktu ideal: 30-90 menit. Belajar rutin membantu meningkatkan pemahaman jangka panjang.",
    "Bermain Game" => "Waktu ideal: 30-60 menit. Batasi waktu agar tidak mengganggu kewajiban lainnya.",
    "Menonton TV" => "Waktu ideal: 30-60 menit. Gunakan sebagai hiburan, hindari berlebihan.",
    "Main Media Sosial" => "Waktu ideal: 30-60 menit. Gunakan secara bijak dan hindari scrolling tanpa tujuan.",
    "Olahraga" => "Waktu ideal: 30-60 menit. Olahraga rutin membantu menjaga kesehatan fisik dan mental.",
    "Membaca Buku" => "Waktu ideal: 20-45 menit. Membaca rutin meningkatkan wawasan dan konsentrasi.",
    "Membersihkan Kamar" => "Waktu ideal: 15-30 menit. Kebersihan kamar meningkatkan kenyamanan dan fokus.",
    "Membantu Orang Tua" => "Waktu ideal: 15-60 menit. Melatih tanggung jawab dan kepedulian dalam keluarga.",
    "Makan Malam" => "Waktu ideal: 20-30 menit. Hindari makan terlalu larut agar kualitas tidur tetap baik.",
    "Ngaji" => "Waktu ideal: 20-60 menit. Konsistensi lebih penting daripada durasi panjang.",
    "Chatting" => "Waktu ideal: 15-45 menit. Jaga komunikasi tanpa mengganggu aktivitas utama.",
    "Hobi" => "Waktu ideal: 30-90 menit. Hobi membantu menjaga keseimbangan mental.",
    "Latihan Musik" => "Waktu ideal: 30-60 menit. Latihan rutin meningkatkan kemampuan secara signifikan.",
    "Latihan Seni" => "Waktu ideal: 30-60 menit. Konsistensi latihan membantu mengembangkan kreativitas.",
    "Belajar Online" => "Waktu ideal: 30-120 menit. Pastikan fokus dan minim distraksi.",
    "Persiapan Besok" => "Waktu ideal: 15-30 menit sebelum tidur. Membantu hari esok lebih terorganisir."
];

$saran = $saranList[$name] ?? "Atur aktivitas ini secara seimbang dengan estimasi waktu yang proporsional agar tidak mengganggu aktivitas utama.";

?>

<p class="activity">
<b><?= htmlspecialchars($name) ?> (<?= $hours ?> jam)</b><br>

<?php if($productivity === "ya"): ?>
    <span class="good">Sudah produktif 👍</span><br>
<?php else: ?>
    <span class="bad">Belum produktif ⚠️</span><br>
<?php endif; ?>

<?= $saran ?>
</p>
<?php endwhile; ?>

<form action="beranda.php">
<button type="submit">Done ✅</button>
</form>

</div>
</body>
</html>