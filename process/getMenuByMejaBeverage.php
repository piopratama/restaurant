<?php
function rupiah($angka){
	
    $hasil_rupiah = number_format($angka,0,',','.');
    return $hasil_rupiah;
 
}

session_start();
if(empty($_SESSION['username'])){
    header("location:..");
}
else
{
    if(!empty($_SESSION['level_user']))
    {
        if($_SESSION["level_user"]==1)
        {
            header("location:..");
        }
    }
}

require('../koneksi.php');

$sql1 = "SELECT tb_menu.id, tb_menu.item, tb_transaksi.price, tb_kategori.kategori, tb_transaksi.qty from tb_transaksi inner join tb_menu on tb_transaksi.id_menu=tb_menu.id inner join tb_kategori on tb_kategori.id=tb_menu.kategori where id_meja=".$_POST['idMeja']." and tb_kategori.id=2 and tb_transaksi.status='not paid' and customer='".$_POST['customer']."'";
$data_menu = $conn->query($sql1);

$html="";
$html=$html."<h3 class='text-center'>Beverage</h3>";
while($row=$data_menu->fetch_assoc())
{
    $html=$html."<div class='dropdown'>";
    $html=$html."<div class='col-sm-3 myMenu'>";
    $html=$html."<p class='text-center title-menu'>".$row['item']." (".$row['qty'].") </p>";
    $html=$html."<img src='../assets/img/".$row['id'].".jpg' alt='".$row['item']."'";
    $html=$html."width='100' height='73' class='dropdown-toggle imageMenu' data-toggle='dropdown'>";
    $html=$html."<p class='text-center'>IDR ".rupiah($row['price'])."</p>";
    $html=$html."<div class='dropdown-menu dropdown-menu-myStyle'>";
    $html=$html."<div class='form-group'>";
    $html=$html."<label for=''>Qty</label>";
    $html=$html."<input type='hidden' value='".$row['kategori']."' class='form-control type'>";
    $html=$html."<input type='hidden' value='".$row['price']."' class='form-control price'>";
    $html=$html."<input type='hidden' value='".$row['id']."' class='form-control idItem'>";
    $html=$html."<input type='number' value='".$row['qty']."' class='form-control qty' placeholder='Qty'>";
    $html=$html."</div>";
    $html=$html."<div class='mybtn-dropdown'>";
    $html=$html."<button type='button' class='btn btn-primary pull-right addMenuOrder'>Update</button>";
    $html=$html."<button type='button' class='btn btn-primary pull-right removeMenuOrder' style='margin-right:2px;'>Delete</button>";
    $html=$html."</div>";
    $html=$html."</div>";
    $html=$html."</div>";
    $html=$html."</div>";
}

echo $html;
?>