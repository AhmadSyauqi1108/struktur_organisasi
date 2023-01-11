<?php
    include 'model/config.php';
    $db = new conection();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Pure HTML CSS Admin Template</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="stylesheet" href="../style/admin.css">
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
      <form class="form" action="controller/controller_login.php" methode="POST">
        <h1>Login</h1>
        <label for="user_name">User Name</label>
        <input type="text" name="user_name" id="user_name">
        <label for="pass">password</label>
        <input type="password" name="pass" id="pass">
        <input type="submit" value="Login">
    </form>
</body>
</html>