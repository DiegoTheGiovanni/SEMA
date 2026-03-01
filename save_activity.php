<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['activities'])){

    $_SESSION['activities'] = json_decode($_POST['activities'], true);

    header("Location: qna.php");
    exit;
}

header("Location: self_monitoring.php");