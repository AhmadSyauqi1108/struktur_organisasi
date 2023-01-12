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
    .btn {
      display: inline-block;
      background-color: #f44336;
      color: #FFFFFF;
      padding: 14px 25px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      margin-left: 20px;
      opacity: 0.9;
    }
    .btn-export-cancel{
      display: inline-block;
      background-color: red;
      color: #FFFFFF;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      margin-bottom: 10px;
    }
    </style>
  </head>
  <body>
    <div id="pgside">
        <div id="pguser">
            <i class="txt">Struktur organisasi</i>
        </div>

        <a href="struktur.php" class="current">
            <i class="ico">&#9737;</i>
            <i class="txt">Struktur</i>
        </a>
        <a href="user.php">
            <i class="ico">&#9737;</i>
            <i class="txt">User</i>
        </a>
        <a href="logout.php">
            <i class="ico">&#9737;</i>
            <i class="txt">Logout</i>
        </a>
    </div>

    <main id="pgmain">
      <h1>Add Struktur</h1>
      <form class="form" action="../controller/controller_structure.php" methode="POST">
        <a href="struktur.php" class="btn-export-cancel">Cancel</a>
        <input type="hidden" name="action" value="save">
        <label for="user_name">User Name</label>
        <select name="user_id" id="user_name">
            <option value="">--- Select User Name ---</option>
            <?php 
                foreach($db->show_user() as $user){
            ?>
            <option value="<?php echo $user['user_id']?>"><?php echo $user['user_name']?></option>
            <?php
                }
            ?>
        </select>
        <label for="jabatan">Jabatan</label>
        <input type="text" name="j_name" id="jabatan" required="required">
        <label for="parent">Parent Jabatan</label>
        <select name="j_parent_id" id="parent">
            <option value="0">--- Select Parent Jabatan ---</option>
            <?php 
                foreach($db->show_jabatan() as $user){
            ?>
            <option value="<?php echo $user['j_id']?>"><?php echo $user['j_name']?></option>
            <?php
                }
            ?>
        </select>
        <input type="submit" value="Save">
      </form>
    </main>
  </body>
</html>