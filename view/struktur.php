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
        table.zebra {
        width: 100%;
        border-collapse: collapse;
        }
        table.zebra tr:nth-child(odd) { background: #5f5f5f; }
        table.zebra td { padding: 10px; }
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

        <a href="#" class="current">
            <i class="ico">&#9737;</i>
            <i class="txt">Struktur</i>
        </a>
        <a href="user.php">
            <i class="ico">&#9737;</i>
            <i class="txt">User</i>
        </a>
    </div>

    <main id="pgmain">
        <h1>struktur organisasi</h1>
        <a href="add_struktur.php" class="btn">add struktur</a>
        <a href="../controller/export_struktur_excel.php" class="btn-export">Export Excel</a>
        <a href="../controller/export_struktur_pdf.php" class="btn-export-pdf">Export PDF</a>
        <table class="zebra">
            <tr>
                <th>No.</th>
                <th align="left">User Name</th>
                <th align="left">Jabatan</th>
                <th align="left">Parent</th>
                <th align="right">option</th>
            </tr>
            <?php 
                $no = 1;
                foreach($db->show_data() as $data){
                    $parenName = [];
                    $id_parent = $data['j_parent_id'];
                    if($id_parent > 0){
                        while($id_parent > 0){
                            foreach($db->show_data_parent($id_parent) as $jp){
                                $id_parent = $jp['j_parent_id'];
                                array_push($parenName,$jp['j_name']);
                            }
                        }
                    }
                    $stringName = '';
                    if(count($parenName) > 0){
                        $reverse = count($parenName);
                        while($reverse > 0){
                            --$reverse;
                            $stringName .= $parenName[$reverse]. '\\';
                        }
                        $stringName .= $data['j_name'];
                    } else {
                        $stringName = '-';
                    }
                ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $data['user_name']; ?></td>
                    <td><?php echo $data['j_name']; ?></td>
                    <td align="left"><?php echo $stringName; ?></td>
                    <td align="right">
                        <a href="edit_struktur.php?id=<?php echo $data['user_id'];?>" class="btn-edit">Edit</a>
                        <a href="../controller/controller_structure.php?id=<?php echo $data['j_id'];?>&action=delete" class="btn-hapus">Hapus</a>
                    </td>
                </tr>
                <?php
                } 
                ?>
        </table>
    </main>
  </body>
</html>