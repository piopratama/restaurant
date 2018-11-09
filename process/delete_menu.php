<?php
require "../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_menu WHERE id='$id';");
header("location:../backend/menuRestaurant.php");
 ?>
