<?php
include "koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_restaurant WHERE id='$id'");
header("location:menuRestaurant.php");
 ?>
