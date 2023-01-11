<?php 
    include '../model/config.php';
    $db = new conection();

    $action = $_POST['action'];
    if($action == 'save'){
        $username = $_POST['user_name'];
        $pass = $_POST['pass'];
        $user_lvl = $_POST['user_level'];
        $image = isset($_FILES['image']['name'])? $_FILES['image']['name'] : false;
        $db->input_user($username,$pass,$user_lvl,$image);
        if($image != false){
          move_uploaded_file($_FILES['image']['tmp_name'], '../asset/gambar/'.$image);
        }
        echo "<script>window.alert('Data Di Simpan')
                window.location='../view/user.php'
              </script>";
    } elseif ($action == 'update'){
        $user_id = $_GET['user_id'];
        $user_name = $_GET['user_name'];
        $image = isset($_GET['image']);
        $db->update_user($user_name,$image,(int)$user_id);
        echo "<script>window.alert('Data Di Edit')
                window.location='../view/user.php'
              </script>";
    } elseif ($action == 'delete'){
        $db->delete_user($_GET['id']);
        echo "<script>window.alert('Data Di Hapus')
                window.location='../view/user.php'
              </script>";
    }
?>