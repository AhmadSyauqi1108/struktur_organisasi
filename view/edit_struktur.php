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
    </div>
    <main id="pgmain">
<h1>Edit Strukur</h1>
<form class="form" action="../controller/controller_structure.php" methode="POST">
    <?php 
        foreach($db->show_e_jabatan($_GET['id']) as $data){
    ?>
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="j_id" value="<?php echo $data['j_id'] ?>">

    <label for="user_name_edit">User Name</label>
    <select name="user_id_edit" id="user_name_edit">
        <option value="<?php echo $data['user_id'] ?>"><?php echo $data['user_name'] ?></option>
        <?php 
            foreach($db->show_user_edit($data['user_id']) as $user){
        ?>
        <option value="<?php echo $user['user_id']?>"><?php echo $user['user_name']?></option>
        <?php
            }
        ?>
    </select>

    <label for="Jabatan">Jabatan</label>
    <input type="text" name="j_name" id="Jabatan" value="<?php echo $data['j_name'] ?>">

    <label for="j_parent_id">Parent Jabatan</label>
    <select name="j_parent_id" id="j_parent_id">
        <?php foreach($db->show_p_jabatan($data['j_parent_id']) as $parent){?>
        <option value="<?php echo $data['j_parent_id'] ?>"><?php echo $parent['j_name'] ?></option>
        <?php } ?>
        <?php 
            foreach($db->show_jabatan_edit($data['j_id'], $data['j_parent_id']) as $jabatan){
        ?>
        <option value="<?php echo $jabatan['j_id']?>"><?php echo $jabatan['j_name']?></option>
        <?php
            }
        ?>
    </select>
    <input type="submit" value="Save">
    <?php 
    }
    ?>
</form>
        </main>
    </body>
</html>