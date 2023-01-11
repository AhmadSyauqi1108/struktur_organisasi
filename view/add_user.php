<?php
    include '../model/config.php';
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
        max-width: 600px;
        padding: 20px;
        border: 1px solid #eee;
        background: #f2f2f2;
      }

      .form label, .form input, .form textarea, .form select, .form button {
        display: block;
        width: 100%;
      }
      .form label { padding: 10px 0; }
      .form input, .form textarea, .form select { padding: 10px; }

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
      input[type=file]::file-selector-button {
      margin-right: 20px;
      border: none;
      background: #870000;
      padding: 10px 20px;
      border-radius: 10px;
      color: #fff;
      cursor: pointer;
      transition: background .2s ease-in-out;
      }

      input[type=file]::file-selector-button:hover {
      background: #870088;
      }
      </style>
    </head>
    <body>
      <div id="pgside">
          <div id="pguser">
              <i class="txt">Struktur organisasi</i>
          </div>

          <a href="struktur.php">
              <i class="ico">&#9737;</i>
              <i class="txt">Struktur</i>
          </a>
          <a href="user.php" class="current">
              <i class="ico">&#9737;</i>
              <i class="txt">User</i>
          </a>
      </div>

      <main id="pgmain">
          <h1>Add User</h1>
          <form class="form" action="../controller/controller_user.php" methode="post" enctype="multipart/form-data">
              <input type="hidden" name="action" value="save">
              <label for="user_name">User Name</label>
              <input type="text" name="user_name" required="required"/>

              <label for="pass">password</label>
              <input type="password" name="pass" required="required"/>

              <label for="user_level">User Level</label>
              <select name="user_level">
                  <option value="">--- select user level ---</option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
              </select>

              <label for="image" class="file">
                  <input type="file" name="image" required="required" accept="image/png, image/gif, image/jpeg" aria-label="choose file..">
              </label>
              <button id="Button" type="submit" formmethod="post">Save</button>
          </form>
      </main>
    </body>
</html>