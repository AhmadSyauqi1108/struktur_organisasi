<?php
    include '../model/config.php';
    $db = new conection();

    $user_name = $_GET['user_name'];
    $pass = $_GET['pass'];
    $db->cek_login($user_name,$pass);
?>