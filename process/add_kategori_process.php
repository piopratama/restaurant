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
	$kategori= $_POST['category'];
	$description = $_POST['description'];

	//include database connection file
	require '../koneksi.php';
											
	// // Insert user data into table
	$result = mysqli_query($conn, "INSERT INTO tb_kategori (kategori,description) VALUES('$kategori','$description')");
	
									
	header("location:../backend/kategori.php");
?>