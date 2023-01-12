<?php
    session_start();
    if (isset($_SESSION['username'])){
        header("location:view/struktur.php");
    } else {
        header("location:login.php");
    }
?>