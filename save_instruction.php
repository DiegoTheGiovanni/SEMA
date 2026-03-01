<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['submit'])){

    require "config.php";

    $idUser = $_SESSION['id'];

    $q1 = mysqli_real_escape_string($conn, $_POST['q1']);
    $q2 = mysqli_real_escape_string($conn, $_POST['q2']);
    $q3 = mysqli_real_escape_string($conn, $_POST['q3']);
    $q4 = mysqli_real_escape_string($conn, $_POST['q4']);
    $q5 = mysqli_real_escape_string($conn, $_POST['q5']);

    $query = "INSERT INTO selfinstruction_questions 
              (idUser, pertanyaanPertama, pertanyaanKedua, pertanyaanKetiga, pertanyaanKeempat, pertanyaanKelima) 
              VALUES 
              ('$idUser', '$q1', '$q2', '$q3', '$q4', '$q5')";

    $q = mysqli_query($conn, $query);

    if($q){
        echo "<script>
            alert('Refleksi berhasil disimpan');
            window.location.href='Beranda.php';
        </script>";
        exit;
    } else {
        echo "Gagal menyimpan instruksi.";
    }

} else {
    header("Location: self_instruction.php");
    exit;
}