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

require "../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_kategori WHERE id='$id';");
header("location:../backend/kategori.php");
 ?>
