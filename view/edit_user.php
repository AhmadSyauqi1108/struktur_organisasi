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

        <a href="struktur.php">
            <i class="ico">&#9737;</i>
            <i class="txt">Struktur</i>
        </a>
        <a href="user.php" class="current">
            <i class="ico">&#9737;</i>
            <i class="txt">User</i>
        </a>
        <a href="logout.php">
            <i class="ico">&#9737;</i>
            <i class="txt">Logout</i>
        </a>
    </div>
    <main id="pgmain">
      <h1>Edit User</h1>
      <form class="form" action="../controller/controller_user.php" methode="post" enctype="multipart/form-data">
        <a href="user.php" class="btn-export-cancel">Cancel</a>
        <?php 
          foreach($db->show_e_user($_GET['id']) as $data){
        ?>
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="user_id" value="<?php echo $data['user_id'] ?>"/>
          <label for="user_name">User Name</label>
          <input type="text" id="user_name" name="user_name" value="<?php echo $data['user_name'] ?>"/>
          <?php
            if($_SESSION['user_level'] == 1){
            ?>
              <label for="new_pass"> New Password </label>
              <input type="password" name="new_pass"/>
            <?php
            }
          ?>
          <br>
          <button id="Button" type="submit" formmethod="post">Save</button>
        <?php 
        }
        ?>
      </form>
    </main>
  </body>
</html>