<?php
    include '../model/config.php';
    $db = new conection();

    $user_name = $_GET['user_name'];
    $pass = $_GET['pass'];
    $db->resetPass($user_name,$pass);
?>