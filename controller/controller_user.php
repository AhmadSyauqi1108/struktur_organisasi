<?php 
    include '../model/config.php';
    $db = new conection();

    $action = isset($_POST['action']) ? $_POST['action'] : $_GET['action'];
    if($action == 'save'){
      $username = $_POST['user_name'];
      $cek_user = mysqli_query($db->config,"SELECT * from user WHERE user_name='$username'");
      $cek_user = mysqli_num_rows($cek_user);
      if($cek_user > 0){
        echo "<script>window.alert('User sudah ada')
          window.location='../view/add_user.php'
        </script>";
      } else {
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
      }
    } elseif ($action == 'update'){
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $new_pass = isset($_POST['new_pass']);
        $cek_user = mysqli_query($db->config,"SELECT * from user WHERE user_name='$user_name' AND user_id NOT in ('user_id')");
        $cek_user = mysqli_num_rows($cek_user);
        if($cek_user > 0){
          echo "<script>window.alert('User sudah ada')
            window.location='../view/edit_user.php?id=$user_id'
          </script>";
        } else {
          $db->update_user($user_name,$new_pass,(int)$user_id);
          echo "<script>window.alert('Data Di Edit')
                  window.location='../view/user.php'
                </script>";
        }
    } elseif ($action == 'delete'){
        $db->delete_user($_GET['id']);
        echo "<script>window.alert('Data Di Hapus')
                window.location='../view/user.php'
              </script>";
    }
?>