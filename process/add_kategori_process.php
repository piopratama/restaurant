<?php
	// Check If form submitted, insert form data into users table.
	$kategori= $_POST['category'];
	$description = $_POST['description'];

	//include database connection file
	require '../koneksi.php';
											
	// // Insert user data into table
	$result = mysqli_query($conn, "INSERT INTO tb_kategori (kategori,description) VALUES('$kategori','$description')");
	
									
	header("location:../backend/kategori.php");
?>