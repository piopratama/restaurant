<?php 
session_start();
if(empty($_SESSION['username'])){
    header("location:index.php");
}
else
{
    if(!empty($_SESSION['level_user']))
    {
        if($_SESSION["level_user"]==0)
        {
            header("location:index.php");
        }
    }
}

include '../koneksi.php';
$id=$_POST['id'];
$item=$_POST['item'];
$price=$_POST['price'];
$stock=$_POST['stock'];


mysqli_query($conn, "UPDATE tb_menu SET item='$item', price='$price', stock='$stock', WHERE id='$id'");
header("location:../backend/menuRestaurant.php");
?>