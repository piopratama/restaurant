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
$buyer=$_POST['buyer'];
$date=$_POST['date'];
$item=$_POST['item'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$total=$_POST['total'];
$unit=$_POST['unit'];
$desc=$_POST['description'];

mysqli_query($conn, "UPDATE tb_expenses SET buyer='$buyer', item='$item', qty='$qty', price='$price', total='$total', description='$desc', unit='$unit' WHERE id='$id'"); 
header("location:../backend/expenses.php");
?>