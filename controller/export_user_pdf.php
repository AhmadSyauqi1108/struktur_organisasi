<?php 
	ob_start();

	include "../model/config.php";
    $db = new conection();

	$data = mysqli_query($db->config, "SELECT * from user");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		td{
			padding: 3px 3px;
		}
	</style>
</head>
<body>
<h3 align="center">Data User</h3>
<table style="border-collapse:collapse;border-spacing:0;" align="center" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>USER NAME</th>
			<th>USER LEVEL</th>
			<th>IMAGES</th>
		</tr>
	</thead>
	<tbody>
	<?php 
    $no = 1; 
	while ($usr = mysqli_fetch_array($data)) {
		echo "<tr>";
		echo "<td>$no</td>";
		echo "<td>$usr[user_name]</td>";
		echo "<td>$usr[user_level]</td>";
		echo "<td>$usr[images]</td>";
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
	$content = $mpdf->Output("Data user.pdf", "D");
?>