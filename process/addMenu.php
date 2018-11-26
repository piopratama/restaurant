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

	// Check If form submitted, insert form data into users table.
	$item = $_POST['item'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$stock = $_POST['stock'];
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
	//$image_name = addslashes($_FILES['image']['name']);

	
	
	// include database connection file
	include 'koneksi.php';
											
	// // Insert user data into table
	$result = mysqli_query($conn, "INSERT INTO tb_restaurant(item,price,type,stock,image) VALUES('$item','$price','$type','$stock','$image')");
									
	header("location:menuRestaurant.php");
?>