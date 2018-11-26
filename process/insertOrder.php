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
            header("location:..");
        }
    }
}

include '../koneksi.php';
$data=json_decode($_POST['data']);
$customer=$_POST['customer'];
$meja=$_POST['meja'];
$description=$_POST['description'];
$total=$_POST['total'];

if($meja!="")
{
    $myInvoice = mysqli_query($conn, "Select invoice from tb_transaksi where customer='".$customer."' and id_meja=".$meja." and `status`='not paid'");

    if($myInvoice->num_rows>0)
    {
        while($row=$myInvoice->fetch_assoc())
        {
            $invoice=$row['invoice'];
        }
        mysqli_query($conn, "delete from tb_transaksi where invoice='".$invoice."'");
    }
    else
    {
        $invoice=Date('Y-m-d H:i:s')."".$_SESSION["id_kasir"];
    }
}
else
{
    $invoice=Date('Y-m-d H:i:s')."".$_SESSION["id_kasir"];
}

$value="";

for($i=0;$i<count($data);$i++)
{
    if($i==0)
    {
        if($meja!="")
        {
            $value=$value."('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", ".$meja.", ".$data[$i]->qty.", ".$data[$i]->price.", ".($data[$i]->qty*$data[$i]->price).", '', 'cash', '".$description."', 'not paid', '0')";
        }
        else
        {
            $value=$value."('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", '', ".$data[$i]->qty.", ".$data[$i]->price.", ".($data[$i]->qty*$data[$i]->price).", '', 'cash', '".$description."', 'not paid', '1')";
        }
    }
    else
    {
        if($meja!="")
        {
            $value=$value.",('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", ".$meja.", ".$data[$i]->qty.", ".$data[$i]->price.", ".($data[$i]->qty*$data[$i]->price).", '', 'cash', '".$description."' ,'not paid', '0')";
        }
        else
        {
            $value=$value.",('".$invoice."', '".Date('Y-m-d')."', '".Date('Y-m-d H:i:s')."', '".$customer."',".$_SESSION["id_kasir"].", ".$data[$i]->id.", '', ".$data[$i]->qty.", ".$data[$i]->price.", ".($data[$i]->qty*$data[$i]->price).", '', 'cash', '".$description."' ,'not paid', '1')";
        }
    }
}

$sql = mysqli_query($conn, "INSERT INTO tb_transaksi(`invoice`, `date`, `date_insert`, `customer`, `id_employee`, `id_menu`, `id_meja`, `qty`, `price`, `total_price`, `rest_total`, `method`, `description`, `status`, `method_order`) values".$value."");


if ($conn->query($sql) === TRUE) {
    $_SESSION['message']="Insert Successfully";
} else {
    $_SESSION['message']="Insert Error";
}
//header("location:../frontend/restaurant.php");

?>