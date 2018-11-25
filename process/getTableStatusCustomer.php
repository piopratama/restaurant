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
				header("location:..");
			}
		}
	}
	
    $status=$_POST['status'];
    $startDate=$_POST['dateStart'];
    $stopDate=$_POST['dateStop'];
    $customer=$_POST['customer'];
    require '../koneksi.php';
    if($customer!="" && $startDate!="" && $stopDate!="" && $status!="")
    {
        $sql = "SELECT invoice, customer as nm_transaksi, Date(`date`) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_menu WHERE id=id_menu )AS item, qty, total_price, `status`, method FROM tb_transaksi WHERE status=".$status." and Date(`date`)>='".$startDate."' and Date(`date`)<='".$stopDate."' and customer as customer='".$customer."';";
    }
    else if($startDate!="" && $stopDate!="" && $status!="")
    {
        $sql = "SELECT invoice, customer as nm_transaksi, Date(`date`) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_menu WHERE id=id_menu )AS item, qty, total_price, `status`, method FROM tb_transaksi WHERE status=".$status." and Date(`date`)>='".$startDate."' and Date(`date`)<='".$stopDate."';";
    }
    else if($startDate!="" && $stopDate!="")
    {
        $sql = "SELECT invoice, customer as nm_transaksi, Date(`date`) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_menu WHERE id=id_menu )AS item, qty, total_price, `status`, method FROM tb_transaksi WHERE Date(`date`)>='".$startDate."' and Date(`date`)<='".$stopDate."';";
    }
    else if($status!="")
    {
        $sql = "SELECT invoice, customer as nm_transaksi, Date(`date`) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_menu WHERE id=id_menu )AS item, qty, total_price, status, method FROM tb_transaksi WHERE `status`=".$status.";";
    }
    else
    {
        $sql = "SELECT invoice, customer as nm_transaksi, Date(`date`) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_menu WHERE id=id_menu )AS item, qty, total_price, status, method FROM tb_transaksi;";
    }
    //$sql = "SELECT invoice, customer as nm_transaksi FROM tb_transaksi WHERE status=".$status." and customer as nm_transaksi<>'' and Date(`date`)>='".$startDate."' and Date(`date`)<='".$stopDate."' and customer as nm_transaksi='".$customer as nm_transaksi."';";
    $result = $conn->query($sql);
    
    $data=array();
    if ($result->num_rows > 0) {
        $i=0;

        $html="<option value=''>-- Select Customer --</option>";
        while($row = $result->fetch_assoc()){
            $data[$i]["no"]=($i+1);
            $data[$i]["invoice"]=$row["invoice"];
            $data[$i]["customer as nm_transaksi"]=($row["customer as nm_transaksi"]=="" ? "Direct Pay":$row["customer as nm_transaksi"]);
            $data[$i]["tnggl"]=$row["tnggl"];
            $data[$i]["nama_pegawai"]=$row["nama_pegawai"];
            $data[$i]["item"]=$row["item"];
            $data[$i]["qty"]=$row["qty"];
            $data[$i]["total_price"]=$row["total_price"];
            $data[$i]["method"]=$row["method"];
            if($row["status"]==1)
            {
                $data[$i]["status"]="paid";
            }
            else if($row["status"]==0){
                $data[$i]["status"]="not paid";
            }
            $i=$i+1;
        }
        echo json_encode($data);
    }
    else
    {
        echo json_encode($data);
    }

?>