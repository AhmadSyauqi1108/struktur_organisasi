<?php 
	ob_start();

	include "../model/config.php";
    $db = new conection();

	$data = mysqli_query($db->config, "SELECT * from jabatan INNER JOIN user on jabatan.user_id = user.user_id");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Belajar Ekspor PDF menggunakan mPDF</title>
	<style type="text/css">
		td{
			padding: 3px 3px;
		}
	</style>
</head>
<body>
<h3 align="center">Data Struktur</h3>
<table style="border-collapse:collapse;border-spacing:0;" align="center" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>USER NAME</th>
			<th>Jabatan</th>
			<th>PARENT Jabatan</th>
		</tr>
	</thead>
	<tbody>
	<?php 
    $no = 1; 
	while ($jbtn = mysqli_fetch_array($data)) {
        $parenName = [];
        $id_parent = $jbtn['j_parent_id'];
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
            $stringName .= $jbtn['j_name'];
        } else {
            $stringName = '-';
        }
		echo "<tr>";
		echo "<td>$no</td>";
		echo "<td>$jbtn[user_name]</td>";
		echo "<td>$jbtn[j_name]</td>";
		echo "<td>$stringName</td>";
        $no++;
	}
	?>
	</tbody>
</table>
</body>
</html>

<?php 
	require '../vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 25, 'margin_right' => 25]);
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->WriteHTML(utf8_encode($html));
	$content = $mpdf->Output("Data Struktur.pdf", "D");
?>