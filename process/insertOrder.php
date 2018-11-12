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
$invoice=Date('Y-m-d H:i:s')."".$_SESSION["id_kasir"];
$customer=$_POST['customer'];
$meja=$_POST['meja'];
$description=$_POST['description'];
$total=$_POST['total'];


$value="";

for($i=0;$i<count($data);$i++)
{
    if($i==0)
    {
        $value=$value."('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", ".$meja.", ".$data[$i]->qty.", ".$data[$i]->price.", ".$total.", '', 'cash', '".$description."', 'not paid', '0')";
    }
    else
    {
        $value=$value.",('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", ".$meja.", ".$data[$i]->qty.", ".$data[$i]->price.", ".$total.", '', 'cash', '".$description."' ,'not paid', '0')";
    }
}

echo "INSERT INTO tb_transaksi(`invoice`, `date`, `date_insert`, `customer`, `id_employee`, `id_menu`, `id_meja`, `qty`, `price`, `total_price`, `rest_total`, `method`, `description`, `status`, `method_order`) values".$value."";

$sql = mysqli_query($conn, "INSERT INTO tb_transaksi(`invoice`, `date`, `date_insert`, `customer`, `id_employee`, `id_menu`, `id_meja`, `qty`, `price`, `total_price`, `rest_total`, `method`, `description`, `status`, `method_order`) values".$value."");

if ($conn->query($sql) === TRUE) {
    $_SESSION['message']="Insert Successfully";
} else {
    $_SESSION['message']="Insert Error";
}
//header("location:../frontend/restaurant.php");

?>