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
                header("location:../index.php");
            }
        }
    }
	
	require 'koneksi.php';
	$sql = "SELECT * FROM tb_restaurant WHERE type='drink'";
	$result = $conn->query($sql);
	$array=array();
	$html="";
	if ($result->num_rows > 0) {	
						
		// output data of each row
		while($row = $result->fetch_assoc()) {
		
				$html=$html."<div class='col-md-2 dropdown'>";
					$html=$html."<input class='item' hidden='true' value='".$row['id']."'>";
					$html=$html."<div class='btn btn-secondary dropdown-toggle item' type='input' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$row['item']."</div>";			
				
					$html=$html."<div class='col-md-12 dropdown-menu control' aria-labelledby='dropdownMenuButton' style='padding: 10px; margin-left: 10px'>";
						$html=$html."<div class='form-group dropdown-item'>";
						$html=$html."<label for=''>Quantity</label>";
						$html=$html."<input min='1' type='number' class='form-control qty' placeholder='Quantity'>";
						$html=$html."</div>";
						$html=$html."<div class='form-group dropdown-item'>";
						$html=$html."<label for=''>Price</label>";
						$html=$html."<input type='text' class='form-control price' placeholder='Price' value='".$row['price']."' readonly='readonly'>";
						$html=$html."</div>";
						$html=$html."<div class='form-group dropdown-item'>";
						$html=$html."<label for=''>Total</label>";
						$html=$html."<input type='text' class='form-control total' placeholder='Total' readonly='readonly'>";
						$html=$html."</div>";
				$html=$html."</div>";
				$html=$html."</div>";
			
		}
		echo $html;
	}
		
?>