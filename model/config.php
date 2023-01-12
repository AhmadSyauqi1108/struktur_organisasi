<?php 
    class conection{
        var $host = "localhost";
        var $uname = "root";
        var $pass = "";
        var $db_name = "struktur_organisasi";
        public $config;

        function __construct(){
            $conf = new mysqli($this->host, $this->uname, $this->pass);
            $this->config = $conf;
            mysqli_select_db($conf, $this->db_name) or die ('Sql Error:'.mysqli_error($config));
        }

        function cek_login($user_name, $pass){
            $cek_login = mysqli_query($this->config,"SELECT * from user where user_name='$user_name' and user_password='$pass'");
            $login = mysqli_num_rows($cek_login);
            $data = mysqli_fetch_array($cek_login);
            if($login > 0){
                session_start();
                $_SESSION['username'] = $data['user_name'];
	            $_SESSION['status'] = "login";
	            $_SESSION['user_level'] = $data['user_level'];
                echo "<script>window.alert('berhasil login')
                window.location='../view/struktur.php'
                </script>";
            } else {
                echo "<script>window.alert('user name atau password salah')
                window.location='../login.php'
                </script>";
            }
        }

        function resetPass($user_name, $pass){
            $get_data = mysqli_query($this->config,"SELECT * from user WHERE user_name='$user_name'");
            $cek = mysqli_num_rows($get_data);
            if ($cek > 0) {
                $query = mysqli_query($this->config, "UPDATE user set user_password='$pass' where user_name='$user_name'");
                echo "<script>window.alert('Password di Reset')
                window.location='../login.php'
                </script>";
            } else {
                echo "<script>window.alert('User Name tidak di temukan')
                window.location='../view/reset_pass.php'
                </script>";
            }
        }
        //START DATA JABATAN
        function show_data(){
            $data_J = mysqli_query($this->config,"SELECT * from jabatan INNER JOIN user on jabatan.user_id = user.user_id") or die ('Sql Error:'.mysqli_error($config));
            $show = [];
            while($data = mysqli_fetch_array($data_J)){
                $show[] = $data;
            }
            return $show;
        }
        function show_data_parent($id){
            $data_Jp = mysqli_query($this->config,"SELECT * from jabatan where j_id='$id'") or die ('Sql Error:'.mysqli_error($config));
            $show = [];
            while($data = mysqli_fetch_array($data_Jp)){
                $show[] = $data;
            }
            return $show;
        }

        function show_user(){
            $data_user = mysqli_query($this->config,"SELECT * from user") or die ('Sql Error:'.mysqli_error($config));
            $show = [];
            while($data = mysqli_fetch_array($data_user)){
                $show[] = $data;
            }
            return $show;
        }

        function show_jabatan(){
            $data_jabatan = mysqli_query($this->config,"SELECT * from jabatan");
            $show = [];
            while($data = mysqli_fetch_array($data_jabatan)){
                $show[] = $data;
            }
            return $show;
        }

        function input_jabatan($jname,$jparent,$user){
            $query = "INSERT INTO jabatan (`j_id`,`j_name`, `j_parent_id`,`user_id`) VALUES ('','$jname','$jparent','$user')";
            $post_jabatan = mysqli_query($this->config, $query) or die ('Sql Error:'.mysqli_error($this->config));
        }

        function delete_jabatan($id, $parent){
            $query = "DELETE from jabatan where j_id='$id'";
            $cek_child = mysqli_query($this->config,"UPDATE jabatan set j_parent_id='$parent' where j_parent_id='$id'");
            $delete_jabatan = mysqli_query($this->config, $query);
        }

        function show_e_jabatan($id){
            $query = mysqli_query($this->config, "SELECT * from jabatan INNER JOIN user on jabatan.user_id = user.user_id where j_id='$id'");
            $show_e = [];
            while($data = mysqli_fetch_array($query)){
                $show_e[] = $data;
            }
            return $show_e;
        }

        function update_jabatan($j_name, $jparent, $user, $id){
            $query = mysqli_query($this->config, "UPDATE jabatan set j_name='$j_name', j_parent_id='$jparent', user_id='$user' where j_id='$id'");
        }
        
        function show_p_jabatan($id){
            $id = (int)$id;
            $query = mysqli_query($this->config, "SELECT * FROM jabatan where j_id='$id'");
            $show_p = [];
            while($data = mysqli_fetch_array($query)){
                $show_p[] = $data;
            }
            return $show_p;
        }

        function show_user_edit($user){
            $data_user = mysqli_query($this->config,"SELECT * from user where user_id NOT in ('$user')") or die ('Sql Error:'.mysqli_error($config));
            $show = [];
            while($data = mysqli_fetch_array($data_user)){
                $show[] = $data;
            }
            return $show;
        }

        function show_jabatan_edit($jabatan, $parent){
            if($parent == 0){
                $data_jabatan = mysqli_query($this->config,"SELECT * from jabatan where j_id NOT in ('$jabatan') AND j_parent_id NOT in ('$jabatan')");
            } else {
                $data_jabatan = mysqli_query($this->config,"SELECT * from jabatan where j_id NOT in ('$jabatan','$parent') AND j_parent_id NOT in ('$parent')");
            }
            $show = [];
            while($data = mysqli_fetch_array($data_jabatan)){
                $show[] = $data;
            }
            return $show;
        }

        //END DATA JABATAN

        //STRAT DATA USER
        function show_data_user(){
            $data_u = mysqli_query($this->config,"SELECT * from user") or die ('Sql Error:'.mysqli_error($config));
            $show = [];
            while($data = mysqli_fetch_array($data_u)){
                $show[] = $data;
            }
            return $show;
        }

        function show_e_user($id){
            $query = mysqli_query($this->config, "SELECT * from user where user_id='$id'");
            $show_e = [];
            while($data = mysqli_fetch_array($query)){
                $show_e[] = $data;
            }
            return $show_e;
        }

        function update_user($userName, $new_pass, $id){
            if($new_pass != ''){
                $query = mysqli_query($this->config, "UPDATE user set user_name='$userName', user_password='$new_pass' where user_id='$id'");
            } else {
                $query = mysqli_query($this->config, "UPDATE user set user_name='$userName' where user_id='$id'");
            }
        }

        function input_user($user_name,$pass,$user_level,$image){
            $query = "INSERT INTO user (`user_id`,`user_name`, `user_password`,`user_level`,`images`) VALUES ('','$user_name','$pass','$user_level','$image')";
            $post_jabatan = mysqli_query($this->config, $query) or die ('Sql Error:'.mysqli_error($this->config));
        }

        function delete_user($id){
            $query = "DELETE from user where user_id='$id'";
            $delete_user = mysqli_query($this->config, $query);
        }
        //END DATA USER
    }
?>