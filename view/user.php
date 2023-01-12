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
        <title>struktur organisasi</title>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
        <link rel="stylesheet" href="../style/admin.css">
        <style>
            table.belang {
            width: 100%;
            border-collapse: collapse;
            }
            table.belang tr:nth-child(odd) { background: #5f5f5f; }
            table.belang td { padding: 10px; }
            * {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            }
            .btn {
                display: inline-block;
                background-color: #9b2323;
                color: #FFFFFF;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin-bottom: 10px;
            }
            .btn-export{
                display: inline-block;
                background-color: green;
                color: #FFFFFF;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin-bottom: 10px;
            }
            .btn-export-pdf{
                display: inline-block;
                background-color: blue;
                color: #FFFFFF;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin-bottom: 10px;
            }
            .btn-edit {
                display: inline-block;
                background-color: green;
                color: #FFFFFF;
                padding: 8px 19px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
            }
            .btn-hapus {
                display: inline-block;
                background-color: red;
                color: #FFFFFF;
                padding: 8px 19px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
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
            <a href="#" class="current">
                <i class="ico">&#9737;</i>
                <i class="txt">User</i>
            </a>
            <a href="logout.php">
                <i class="ico">&#9737;</i>
                <i class="txt">Logout</i>
            </a>
        </div>

        <main id="pgmain">
            <h1>Data User</h1>
            <?php
            $user_level = $_SESSION['user_level'];
            if($user_level == 1){
            ?>
                <a href="add_user.php" class="btn">add user</a>
                <a href="../controller/export_user_excel.php" class="btn-export">Export Excel</a>
                <a href="../controller/export_user_pdf.php" class="btn-export-pdf">Export PDF</a>
            <?php
            } else {
            ?>
                <a href="../controller/export_user_excel.php" class="btn-export">Export Excel</a>
                <a href="../controller/export_user_pdf.php" class="btn-export-pdf">Export PDF</a>
            <?php
            }
            ?>
            <table class="belang">
            <tr>
                <th>No.</th>
                <th align="left">User Name</th>
                <th align="left">foto</th>
                <th align="right">option</th>
            </tr>
            
            <?php 
                $no = 1;
                foreach($db->show_data_user() as $data){
                ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $data['user_name']; ?></td>
                    <td><img src="../asset/gambar/<?php echo $data['images']?>" alt="" width="45" height="55"></td>
                    <td align="right">
                        <?php
                            $user_level = $_SESSION['user_level'];
                            if($user_level == 1){
                            ?>
                            <a href="edit_user.php?id=<?php echo $data['user_id'];?>" class="btn-edit">Edit</a>
                            <a href="../controller/controller_user.php?id=<?php echo $data['user_id'];?>&action=delete" class="btn-hapus">Hapus</a>
                            <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
                } 
                ?>
            </table>
        </main>
    </body>
</html>