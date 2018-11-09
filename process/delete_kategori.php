<?php
require "../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_kategori WHERE id='$id';");
header("location:../backend/kategori.php");
 ?>
