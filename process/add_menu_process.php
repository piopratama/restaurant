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
	$stock = $_POST['stock'];
	$kategori=$_POST['category'];
	$image_name = $_FILES['image']['name'];
	$file_tmp=$_FILES['image']['tmp_name'];
	//move_uploaded_file($file_tmp,'../assets/img/'.$image_name);
	//$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
	
	
	
	//include database connection file
	require '../koneksi.php';
											
	// // Insert user data into table
	$result = mysqli_query($conn, "INSERT INTO tb_menu(item,price,kategori,stock,img_path) VALUES('$item',$price,$kategori,$stock,'$image_name')");
	$last_id = $conn->insert_id;
	move_uploaded_file($file_tmp,'../assets/img/'.$last_id.".jpg");
									
	header("location:../backend/menuRestaurant.php");
?>