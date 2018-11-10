<?php
require "../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tb_expenses WHERE id='$id';");
header("location:../backend/expenses.php");
 ?>
