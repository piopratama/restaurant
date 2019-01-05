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
  
  require "../koneksiserver.php";
  require "../koneksi.php";
  mysqli_query($connServer,"DELETE FROM tb_transaksi");

  $sql1 = "SELECT * from tb_employee";
  $data_employee = $conn->query($sql1);

  while($row=$data_employee->fetch_assoc())
  {
    $fieldVal1 = mysql_real_escape_string($row['id']);
    $fieldVal2 = mysql_real_escape_string($row['nama']);
    $fieldVal3 = mysql_real_escape_string($row['address']);
    $fieldVal4 = mysql_real_escape_string($row['sallary']);
    $fieldVal5 = mysql_real_escape_string($row['tlp']);
    $fieldVal6 = mysql_real_escape_string($row['username']);
    $fieldVal7 = mysql_real_escape_string($row['password']);
    $fieldVal8 = mysql_real_escape_string($row['level']);
    $fieldVal9 = mysql_real_escape_string($row['status']);
    $fieldVal10 = mysql_real_escape_string($row['online_status']);

    $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3','$fieldVal4', '$fieldVal5', '$fieldVal6','$fieldVal7', '$fieldVal8', '$fieldVal9','$fieldVal10')";
  }

  $sql = "INSERT INTO tb_employee (id, `nama`, `address`, sallary, tlp, username, `password`, `level`, `status`, online_status) values ";
  $sql .= implode(',', $DataArr);
  
  mysqli_query($connServer, $sql);

  unset($DataArr);

  $sql1 = "SELECT * from tb_kategori";
  $data_kategori = $conn->query($sql1);

  while($row=$data_kategori->fetch_assoc())
  {
    $fieldVal1 = mysql_real_escape_string($row['id']);
    $fieldVal2 = mysql_real_escape_string($row['kategori']);
    $fieldVal3 = mysql_real_escape_string($row['description']);

    $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3')";
  }

  $sql = "INSERT INTO tb_kategori (id, kategori, `description`) values ";
  $sql .= implode(',', $DataArr);
  
  mysqli_query($connServer, $sql);

  unset($DataArr);

  $sql1 = "SELECT * from tb_meja";
  $data_meja = $conn->query($sql1);

  while($row=$data_meja->fetch_assoc())
  {
    $fieldVal1 = mysql_real_escape_string($row['id']);
    $fieldVal2 = mysql_real_escape_string($row['meja']);
    $fieldVal3 = mysql_real_escape_string($row['description']);

    $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3')";
  }

  $sql = "INSERT INTO tb_meja (id, meja, `description`) values ";
  $sql .= implode(',', $DataArr);
  
  mysqli_query($connServer, $sql);

  unset($DataArr);

  $sql1 = "SELECT * from tb_menu";
  $data_menu = $conn->query($sql1);

  while($row=$data_menu->fetch_assoc())
  {
    $fieldVal1 = mysql_real_escape_string($row['id']);
    $fieldVal2 = mysql_real_escape_string($row['item']);
    $fieldVal3 = mysql_real_escape_string($row['price']);
    $fieldVal4 = mysql_real_escape_string($row['kategori']);
    $fieldVal5 = mysql_real_escape_string($row['stock']);
    $fieldVal6 = mysql_real_escape_string($row['img_path']);
    $fieldVal7 = mysql_real_escape_string($row['status']);

    $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3','$fieldVal4', '$fieldVal5', '$fieldVal6','$fieldVal7')";
  }

  $sql = "INSERT INTO tb_menu (id, item, `price`, kategori, stock, img_path, `status`) values ";
  $sql .= implode(',', $DataArr);
  
  mysqli_query($connServer, $sql);

  unset($DataArr);

  $sql1 = "SELECT * from tb_transaksi";
  $data_transaksi = $conn->query($sql1);

  while($row=$data_transaksi->fetch_assoc())
  {
    $fieldVal1 = mysql_real_escape_string($row['id']);
    $fieldVal2 = mysql_real_escape_string($row['invoice']);
    $fieldVal3 = mysql_real_escape_string($row['date']);
    $fieldVal4 = mysql_real_escape_string($row['date_insert']);
    $fieldVal5 = mysql_real_escape_string($row['customer']);
    $fieldVal6 = mysql_real_escape_string($row['id_employee']);
    $fieldVal7 = mysql_real_escape_string($row['id_menu']);
    $fieldVal8 = mysql_real_escape_string($row['id_meja']);
    $fieldVal9 = mysql_real_escape_string($row['qty']);
    $fieldVal10 = mysql_real_escape_string($row['price']);
    $fieldVal11 = mysql_real_escape_string($row['total_price']);
    $fieldVal12 = mysql_real_escape_string($row['rest_total']);
    $fieldVal13 = mysql_real_escape_string($row['method']);
    $fieldVal14 = mysql_real_escape_string($row['description']);
    $fieldVal15 = mysql_real_escape_string($row['status']);
    $fieldVal16 = mysql_real_escape_string($row['method_order']);

    $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3','$fieldVal4', '$fieldVal5', '$fieldVal6','$fieldVal7', '$fieldVal8', '$fieldVal9','$fieldVal10', '$fieldVal11', '$fieldVal12','$fieldVal13', '$fieldVal14', '$fieldVal15', '$fieldVal16')";
  }

  $sql = "INSERT INTO tb_transaksi (id, invoice, `date`, date_insert, customer, id_employee, id_menu, id_meja, qty, price, total_price, rest_total, method, `description`, `status`, method_order) values ";
  $sql .= implode(',', $DataArr);
  
  mysqli_query($connServer, $sql);

  echo json_encode("success");

  /*if(is_array($records)){

    $DataArr = array();
    foreach($records as $row){
        $fieldVal1 = mysql_real_escape_string($records[$row][0]);
        $fieldVal2 = mysql_real_escape_string($records[$row][1]);
        $fieldVal3 = mysql_real_escape_string($records[$row][2]);

        $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3')";
    }

    $sql = "INSERT INTO programming_lang (field1, field2, field3) values ";
    $sql .= implode(',', $DataArr);

    mysqli_query($conn, $query); 
  }
  header("location:../backend/dashboard.php");*/
?>