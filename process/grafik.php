<?php 
session_start();
if(empty($_SESSION['username'])){
	header("location:index.php");
}
else
{
	if(!empty($_SESSION['level_user']))
	{
		if($_SESSION["level_user"]==0 || $_SESSION["level_user"]==2)
		{
			header("location:..");
		}
	}
}

include '../koneksi.php';

$year=$_POST['year'];

$sql="SELECT MONTHNAME(`date`) as `labels`,SUM(total_price)/100 as `series` FROM tb_transaksi WHERE YEAR(`date`)=".$year." and `status`='paid' GROUP BY MONTH(`date`) order by MONTH(`date`)";
$result= mysqli_query($conn, $sql);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

echo json_encode($data);
?>