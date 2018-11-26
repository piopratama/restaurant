<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location:..");
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
    $title="Dashboard";
    include('../layout/headercasier.php');

    $name = $_POST['name'];
	$address = $_POST['address'];
	$sallary = $_POST['sallary'];
	$phone = $_POST['phone'];
	$usernamed = $_POST['username'];
	$passworde=md5($_POST['password']);
	$level=$_POST['level'];
	
	require '../koneksi.php';
	/*$cek = mysqli_query($conn, "SELECT username FROM tb_employee WHERE username='$usernamed'");
	$no=1;
	foreach( $cek as $a ){
         $b= $a['username'];
         
    }*/

	/*if($b==null){	*/
        $result = mysqli_query($conn, "INSERT INTO tb_employee(nama,address,sallary,tlp,username,password, level) VALUES('$name','$address',$sallary,$phone,'$usernamed','$passworde',$level);");
        
		header("location:../backend/user.php");
		/*}else{
		
		echo "<script>alert('username $usernamed sudah digunakan, Gunakan yang lain');history.go(-1);</script>";
	}*/					
?>