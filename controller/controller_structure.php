<?php 
    include '../model/config.php';
    $db = new conection();

    $action = $_GET['action'];
    if($action == 'save'){
        $jname = $_GET['j_name'];
        $jparent = $_GET['j_parent_id'];
        $user = $_GET['user_id'];
        $db->input_jabatan($jname,(int)$jparent,(int)$user);
        echo "<script>window.alert('Data Di Simpan')
                window.location='../view/struktur.php'
              </script>";
    } elseif ($action == 'update'){
        $j_id = $_GET['j_id'];
        $jname = $_GET['j_name'];
        $jparent = $_GET['j_parent_id'];
        $user = $_GET['user_id_edit'];
        $db->update_jabatan($jname,(int)$jparent,(int)$user,(int)$j_id);
        echo "<script>window.alert('Data Di Edit')
                window.location='../view/struktur.php'
              </script>";
    } elseif ($action == 'delete'){
        $db->delete_jabatan($_GET['id']);
        echo "<script>window.alert('Data Di Hapus')
                window.location='../view/struktur.php'
              </script>";
    }
?>