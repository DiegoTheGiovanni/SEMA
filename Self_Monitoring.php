<?php
session_start();

/* Proteksi login */
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$namaUser = $_SESSION['name'] ?? "User";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>📊 Self Monitoring</title>

    <style>
    /* RESET */
    /* RESET */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    /* BODY */
    body {
        background : #fffd6a;
        min-height: 100vh;
        display: flex;
    }

    /* SIDEBAR */
    .sidebar {
        width: 260px;
        background: #8b8201;
        color: white;
        padding: 20px;
        overflow-y: auto;
    }

    .sidebar h3 {
        text-align: center;
        margin-bottom: 15px;
    }

    /* Activity List */
    .activity {
        background: white;
        color: #333;
        padding: 10px;
        margin: 6px 0;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
        font-size: 14px;
    }

    .activity:hover {
        background: #f5ff97;
    }

    .activity.active {
        background: #f5f829;
        color: white;
    }

    /* MAIN CONTENT */
    .main {
        flex: 1;
        padding: 30px;
    }

    /* Header */
    .header {
        margin-bottom: 20px;
    }

    .header h2 {
        color: #f1fd41;
    }

    /* Container */
    .container {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

   /* Selected Item */
.item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin: 10px 0;
    padding: 12px 15px;
    background: #fced6e;
    border-radius: 10px;
    border: 1px solid #eee;
    cursor: grab;
}

.item-left {
    flex: 1;
    font-weight: 500;
    word-break: break-word;
}

.item-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.item input {
    width: 65px;
    padding: 5px;
    text-align: center;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* tombol hapus khusus item */
.item .delete-btn {
    background: #ff4d4d;
    border: none;
    color: white;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
}

/* jangan ikut style button global */
.item .delete-btn:hover {
    background: #e63939;
}

.item.dragging {
    opacity: 0.5;
    background: #ffeaf3;
}

    /* Total */
    .total {
        margin-top: 20px;
        font-weight: bold;
        font-size: 18px;
    }

    /* Button */
    .main-btn {
        margin-top: 25px;
        width: 100%;
        background: #7ED957;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 25px;
        cursor: pointer;
        transition: 0.3s;
    }

    .main-btn:hover {
        background: #6BCB4E;
    }

    /* Warning */
    .warning {
        margin-top: 15px;
        color: red;
        font-weight: bold;
        display: none;
    }

    .success {
        color: green;
        display: none;
    }
    /* TOGGLE BUTTON */
.toggle-btn {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    background: #FF5F9E !important;
    color: white;
    border: none;
    padding: 10px 12px;
    border-radius: 8px;
    z-index: 999;
    
}

/* RESPONSIVE */
@media (max-width: 768px) {

    .sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100%;
        z-index: 998;
        transition: 0.3s;
    }

    .sidebar.show {
        left: 0;
    }

    .toggle-btn {
        display: block;
    }

    body {
        flex-direction: column;
    }
}
    </style>
</head>

<body>
   <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- SIDEBAR -->
    <div class="sidebar">

       <h3>📋 Aktivitas Harian</h3>

<!-- Input Aktivitas Lainnya -->
<div style="margin-bottom:15px;">
    <input type="text" id="customActivity"
        placeholder="Tambah Aktivitas"
        style="width:100%;padding:6px;border-radius:6px;border:1px solid #ccc;">

    <button type="button" onclick="addCustomActivity()"
        style="width:100%;margin-top:5px;
        background:#7ED957;border:none;
        padding:6px;border-radius:6px;
        color:white;cursor:pointer;">
        + Tambah
    </button>
</div>

        <?php
$activities = [
"Tidur","Sholat","Mandi","Sarapan",
"Belajar di Sekolah","Istirahat","Makan Siang","Pulang Sekolah",
"Les","Mengerjakan PR","Belajar Mandiri","Bermain Game",
"Menonton TV","Main Media Sosial","Olahraga","Membaca Buku",
"Membersihkan Kamar","Membantu Orang Tua",
"Makan Malam","Ngaji","Chatting","Hobi",
"Latihan Musik","Latihan Seni","Belajar Online","Persiapan Besok"
];

foreach($activities as $act){
    echo "<div class='activity' onclick=\"addActivity('$act', this)\">$act</div>";
}
?>

    </div>


    <!-- MAIN -->
    <div class="main">

        <div class="header">
            <center><p>Halo, <?php echo $namaUser; ?> 👋 | Atur aktivitas
            harianmu</p></center>
        </div>

        <form method="POST" action="save_monit.php" id="monitorForm">
            <div class="container">

                <h3>Aktivitas Dipilih</h3>

                <div id="selected"></div>

                <div class="total">
                    Total Waktu: <span id="totalTime">0</span> Jam
                    <input type="hidden" name="activities" id="activitiesInput">
                </div>

                <div class="warning" id="warning">
                    ⚠️ Total waktu belum mencapai 24 jam!
                </div>

                <div class="success" id="success">
                    ✅ Total waktu sudah 24 jam. Silakan lanjut!
                </div>

                <button type="button" class="main-btn" onclick="checkTime()">
                    Simpan & Lanjut
                </button>

            </div>
        </form>

    </div>


    <script>
    let selectedActivities = {};
    function addCustomActivity(){

    let input = document.getElementById("customActivity");
    let name = input.value.trim();

    if(name === ""){
        alert("Nama aktivitas tidak boleh kosong!");
        return;
    }

    if(selectedActivities.hasOwnProperty(name)){
        alert("Aktivitas sudah ada!");
        return;
    }

    if(name.length > 30){
        alert("Maksimal 30 karakter!");
        return;
    }

    // Buat item baru di sidebar
    let sidebar = document.querySelector(".sidebar");

    let div = document.createElement("div");
    div.className = "activity";
    div.innerText = name;

    div.onclick = function(){
        addActivity(name, this);
    };

    sidebar.appendChild(div);

    // Auto pilih
    addActivity(name, div);

    // Reset input
    input.value = "";
}       
    /* Tambah aktivitas */
    function addActivity(name, element) {

    if (selectedActivities.hasOwnProperty(name)) return;

    selectedActivities[name] = 0;
    element.classList.add("active");

    let container = document.getElementById("selected");

    let div = document.createElement("div");
    div.className = "item";
    div.id = "item-" + name.replace(/\s/g, "");

    div.innerHTML = `
        <div class="item-left">${name}</div>

        <div class="item-right">
            <input type="number" min="0" max="24"
            name="hours[${name}]"
            value="0"
            oninput="updateTime('${name}', this.value)">

            <span>Jam</span>

            <button type="button"
            class="delete-btn"
            onclick="removeActivity('${name}')">
            Hapus
            </button>
        </div>
    `;

    container.appendChild(div);
}

function removeActivity(name){

    delete selectedActivities[name];

    let item = document.getElementById("item-" + name.replace(/\s/g, ""));
    if(item) item.remove();

    let activities = document.querySelectorAll(".activity");

    activities.forEach(act => {
        if(act.innerText === name){
            act.classList.remove("active");
        }
    });

    calculateTotal();
}

function toggleSidebar(){
    document.querySelector(".sidebar").classList.toggle("show");
}

    /* Update waktu */
    function updateTime(name, value) {

        value = parseFloat(value);

        if (value > 24) value = 24;

        selectedActivities[name] = value;

        calculateTotal();
    }

    /* Hitung total */
    function calculateTotal() {

    let total = 0;

    for (let key in selectedActivities) {
        total += parseFloat(selectedActivities[key]) || 0;
    }
    

        document.getElementById("totalTime").innerText = total;

        if (total > 24) {
            document.getElementById("warning").innerText = "⚠️ Total waktu tidak boleh lebih dari 24 jam!";
            document.getElementById("warning").style.display = "block";
            document.getElementById("success").style.display = "none";
        } else if (total === 24) {
            document.getElementById("warning").style.display = "none";
            document.getElementById("success").style.display = "block";
        } else {
            document.getElementById("warning").innerText = "⚠️ Total waktu belum mencapai 24 jam!";
            document.getElementById("warning").style.display = "block";
            document.getElementById("success").style.display = "none";
        }
    }

    function checkTime() {
       
       calculateTotal();

    let total = 0;
    let activities = {};

    for (let key in selectedActivities) {

        let val = parseFloat(selectedActivities[key]) || 0;

        total += val;

        if (val > 0) {
            activities[key] = val;
        }
    }

    total = Math.round(total * 100) / 100;

    if (total !== 24) {
        alert("⚠️ Total waktu harus tepat 24 jam!");
        return;
    }

    if (Object.keys(activities).length === 0) {
        alert("⚠️ Minimal isi 1 aktivitas!");
        return;
    }

    document.getElementById("activitiesInput").value = JSON.stringify(activities);

    document.getElementById("monitorForm").submit();
}
document.querySelector("form").addEventListener("submit", function () {
    document.getElementById("activitiesInput").value =
        JSON.stringify(activities);
});
    </script>

</body>

</html>