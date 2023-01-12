<?php
    include '../model/config.php';
    session_start();
    if ($_SESSION['username']==""){
      header("location:../login.php");
    }
    $db = new conection();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>struktur</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <style>
    .form {
      padding: 20px;
      border: 1px solid #eee;
      background: #f2f2f2;
    }

    .form label, .form input, .form select, .form button {
      display: block;
      width: 50%;
    }
    .form label { padding: 10px 0; }
    .form input, .form select { padding: 10px; }

    input[type=button], input[type=submit], button {
      font-size: 1em;
      font-weight: 700;
      padding: 10px;
      border: 0;
      color: #fff;
      background: #870000;
      cursor: pointer;
    }
    input[type=submit] { margin-top: 20px; }
    * {
      font-family: Arial, Helvetica, sans-serif;
      box-sizing: border-box;
    }
    </style>
  </head>
  <body>
      <form class="form" action="../controller/controller_reset.php" methode="POST">
        <h1>Reset Password</h1>
        <label for="user_name">User Name</label>
        <input type="text" name="user_name" id="user_name">
        <label for="pass">New password</label>
        <input type="password" name="pass" id="pass">
        <input type="submit" value="Reset">
        <br>
        <a href="../login.php">Login</a>
    </form>
  </body>
</html>