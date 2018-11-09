<?php
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
	$result = mysqli_query($conn, "INSERT INTO tb_menu(item,price,kategori,stock,img_path) VALUES('$item','$price','$kategori','$stock','$image')");
									
	header("location:../backend/menuRestaurant.php");
?>