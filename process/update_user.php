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
            header("location:../index.php");
        }
    }
}

require '../koneksi.php';
$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['address'];
$sallary=$_POST['sallary'];
$phone=$_POST['phone'];
$usernamed=$_POST['username'];
$passworde=$_POST['password'];
$level=$_POST['level'];

mysqli_query($conn, "UPDATE tb_employee SET nama='$name', address='$address', sallary=$sallary,tlp=$phone,username='$usernamed',password='$passworde', level=$level WHERE id='$id';"); 
header("location:../backend/user.php");
?>