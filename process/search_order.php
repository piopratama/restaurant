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

include '../koneksi.php';
$table=$_POST['table'];
$customer=$_POST['customer'];

$data_menu=mysqli_query($conn, "SELECT id_menu as id, (SELECT item FROM tb_menu WHERE tb_menu.id=tb_transaksi.`id_menu`) AS item, `date`, qty, tb_transaksi.price, total_price, tb_kategori.kategori  FROM tb_transaksi inner join tb_menu on tb_menu.id=tb_transaksi.id_menu inner join tb_kategori on tb_kategori.id=tb_menu.kategori WHERE id_meja=".$table." and customer='".$customer."' and tb_transaksi.`status`='not paid';
");

$i=0;

$total_price=0;
$html="";
while($row=$data_menu->fetch_assoc())
{
    $total_price=$total_price+$row['price']*$row['qty'];
    $html=$html."<div class='col-sm-3 myMenu'>";
    $html=$html."<p class='text-center title-menu'>".$row['item']." (".$row['qty'].")</p>";
    $html=$html."<img src='../assets/img/".$row['id'].".jpg' alt='".$row['item']."'";
    $html=$html."width='100' height='73' class='dropdown-toggle imageMenu center-block' data-toggle='dropdown'>";
    $html=$html."<p class='text-center'>IDR ".rupiah($row['price'])."</p>";
    $html=$html."<div class='dropdown-menu dropdown-menu-myStyle'>";
    $html=$html."<div class='form-group'>";
    $html=$html."<label for=''>Qty</label>";
    $html=$html."<input type='hidden' value='".$row['kategori']."' class='form-control type'>";
    $html=$html."<input type='hidden' value='".($row['price']*$row['qty'])."' class='form-control price'>";
    $html=$html."<input type='hidden' value='".$row['id']."' class='form-control idItem'>";
    $html=$html."<input type='number' value='".$row['qty']."' class='form-control qty' placeholder='Qty'>";
    $html=$html."<p>Date : ".$row['date']."</p>";
    $html=$html."</div>";
    $html=$html."</div>";
    $html=$html."</div>";
    $html=$html."</div>";
}
if($data_menu->num_rows>0)
{
    $html=$html."<div class='row'><div class='col-md-12'><h2 class='text-center'>Total History Price : ".$total_price."</h2></div></div>";
}
echo $html;

?>