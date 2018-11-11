<?php
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
            header("location:index.php");
        }
    }
}

include '../koneksi.php';
$data=json_decode($_POST['data']);
$invoice=Date('Y-m-d hh:mm:ss')."".$_SESSION["id_kasir"];

for($i=0;$i<count($invoice);$i++)
{
    $value=$value."(".$invoice.", '".Date('Y-m-d')."', '".Date('Y-m-d hh:mm:ss')."')"
}

$result = mysqli_query($conn, "INSERT INTO tb_transaksi(`invoice`, `date`, `date_insert`, `customer`, `id_employee`, `id_menu`, `id_meja`, `qty`, `price`, `total_price`, `rest_total`, `method`, `description`, `status`) values($invoice)");
									
header("location:../fronend/restaurant.php");

?>