<?php 
    include '../model/config.php';
    $db = new conection();

    $action = $_GET['action'];
    if($action == 'save'){
      $jname = $_GET['j_name'];
      $jparent = $_GET['j_parent_id'];
      $user = $_GET['user_id'];
      if($jname == '' || $user == ''){
          echo "<script>window.alert('Silahkan lengkapi data')
            window.location='../view/add_struktur.php'
          </script>";
      }else{
        $query = mysqli_query($db->config,"SELECT * from jabatan WHERE j_name='$jname'");
        $cek_jabatan = mysqli_num_rows($query);
        if($cek_jabatan > 0){
          echo "<script>window.alert('Jabatan Sudah ada')
                window.location='../view/add_struktur.php'
              </script>";
        } else {
          $db->input_jabatan($jname,(int)$jparent,(int)$user);
          echo "<script>window.alert('Data Di Simpan')
                  window.location='../view/struktur.php'
                </script>";
        }
      }
    } elseif ($action == 'update'){
      $j_id = (int)$_GET['j_id'];
      $jname = $_GET['j_name'];
      $jparent = isset($_GET['j_parent_id']) ? $_GET['j_parent_id'] : 0;
      $user = $_GET['user_id_edit'];
      $query = mysqli_query($db->config,"SELECT * from jabatan WHERE j_name='$jname' AND j_id NOT IN ('$j_id')");
      $cek_jabatan = mysqli_num_rows($query);
      if($cek_jabatan > 0){
        echo "<script>window.alert('Jabatan Sudah ada')
              window.location='../view/edit_struktur.php?id=$j_id'
            </script>";
      } else {
        $db->update_jabatan($jname,(int)$jparent,(int)$user,(int)$j_id);
        echo "<script>window.alert('Data Di Edit')
                window.location='../view/struktur.php'
              </script>";
      }
    } elseif ($action == 'delete'){
      $parent_id = (int)$_GET['parent_id'];
      $j_id = (int)$_GET['id'];
      $db->delete_jabatan($j_id, $parent_id);
      echo "<script>window.alert('Data Di Hapus')
              window.location='../view/struktur.php'
            </script>";
    }
?>