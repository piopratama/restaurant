<?php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	require '../koneksi.php';

	$usernamed=$_POST["username"];
	$password=$_POST["password"];
	// $level=$_POST["level"];

	$sql = mysqli_query($conn, "SELECT level FROM tb_employee where username='$usernamed';");
	$no=1;
	foreach($sql as $a){
		$b = $a['level'];
	}
	
	if($b=='1'){
		
		$sql = "SELECT id,username,nama FROM tb_employee WHERE username = '$usernamed' AND `password`=MD5('".$password."');";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
	        $_SESSION["username"]=$usernamed;
			$_SESSION["id_kasir"]=$row["id"];
			$_SESSION["nama"]=$row["nama"];
			}
			$_SESSION['level_user']=1;
			$sql1 = mysqli_query($conn, "update tb_employee set online_status='1' where username='$usernamed'");
			header("location:../backend/dashboard.php");
			}else{
			$_SESSION["message"]="Login Failed";
			header("location:..");
			}
	}
	elseif ($b=='0'){
		
		$sql = "SELECT id,username,nama FROM tb_employee WHERE username = '$usernamed' AND `password`=MD5('".$password."');";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$_SESSION["username"]=$usernamed;
				$_SESSION["id_kasir"]=$row["id"];
				$_SESSION["nama"]=$row["nama"];
			}
			$_SESSION['level_user']=0;
			$sql1 = mysqli_query($conn, "update tb_employee set online_status='1' where username='$usernamed'");
			header("location:../frontend/restaurant.php");
		}else{
			$_SESSION["message"]="Login Failed";
			header("location:..");
		}
	}
	elseif ($b=='2'){
		
		$sql = "SELECT id,username,nama FROM tb_employee WHERE username = '$usernamed' AND `password`=MD5('".$password."');";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$_SESSION["username"]=$usernamed;
				$_SESSION["id_kasir"]=$row["id"];
				$_SESSION["nama"]=$row["nama"];
			}
			$_SESSION['level_user']=2;
			$sql1 = mysqli_query($conn, "update tb_employee set online_status='1' where username='$usernamed'");
			header("location:../frontend/main_menu.php");
		}else{
			$_SESSION["message"]="Login Failed";
			header("location:..");
		}
	}
	
	$conn->close();

}
else
{
	$_SESSION["message"]="Login Failed";
	header("location:..");
}
?>