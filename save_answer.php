<?php
session_start();
require "config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $answers = $_POST['answer'] ?? [];

    if(empty($answers)){
        die("Jawaban tidak ditemukan");
    }

    foreach($answers as $detail_id => $value){

        $detail_id = (int)$detail_id;
        $value = mysqli_real_escape_string($conn, $value);

        mysqli_query($conn, "
        UPDATE monitoring_details
        SET is_productive = '$value'
        WHERE id = '$detail_id'
        ");
    }

    header("Location: saran.php");
    exit;
}
?>