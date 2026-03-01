<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pertanyaan Situasi</title>

    <style>
body{
    min-height:100vh;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), /* overlay */
        url('img/bgk1.png'); /* GANTI DENGAN PATH GAMBAR KAMU */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position:relative;
    overflow-x:hidden;
}


    .container {
        max-width: 700px;
        background: white;
        margin: auto;
        padding: 25px;
        border-radius: 15px;
    }

    h2 {
        color: #FF5F9E;
        text-align: center;
    }

    .question {
        margin: 20px 0;
    }

    textarea {
        width: 100%;
        height: 70px;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    button {
        width: 100%;
        padding: 12px;
        background: #FF8FB1;
        border: none;
        color: white;
        border-radius: 25px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    button:hover {
        background: #FF5F9E;
    }
    </style>
</head>

<body>

    <div class="container">

        <h2>📝 Refleksi Diri</h2>

        <form method="POST" action="save_instruction.php">

            <!-- Pertanyaan 1 -->
            <div class="question">
                <b>1. Apa masalah utama yang kamu hadapi hari ini?</b>
                <textarea name="q1" required></textarea>
            </div>

            <!-- Pertanyaan 2 -->
            <div class="question">
                <b>2. Bagaimana cara kamu mengatasinya?</b>
                <textarea name="q2" required></textarea>
            </div>

            <!-- Pertanyaan 3 -->
            <div class="question">
                <b>3. Apa yang bisa kamu perbaiki besok?</b>
                <textarea name="q3" required></textarea>
            </div>

            <!-- Pertanyaan 4 -->
            <div class="question">
                <b>4. Hal positif apa yang kamu lakukan hari ini?</b>
                <textarea name="q4" required></textarea>
            </div>

            <!-- Pertanyaan 5 -->
            <div class="question">
                <b>5. Motivasi untuk dirimu sendiri?</b>
                <textarea name="q5" required></textarea>
            </div>

            <button type="submit" name="submit">Simpan & Selesai ✅</button>

        </form>

    </div>

</body>

</html>