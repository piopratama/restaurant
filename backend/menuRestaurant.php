<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location:..");
    }
    else
    {
        if(!empty($_SESSION['level_user']))
        {
            if($_SESSION["level_user"]==0)
            {
                header("location:../index.php");
            }
        }
    }
    $title="Dashboard";
    include('../layout/headercasier.php');
	require('../koneksi.php');
	$menu = mysqli_query($conn, "SELECT tb_menu.*, tb_kategori.kategori FROM tb_menu INNER JOIN tb_kategori on tb_menu.kategori=tb_kategori.id;");
?>

	<body>
		<form action="transactionUnDirect.php" method="POST" accept-charset="utf-8">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 header">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Restaurant</a>
								</div>
						
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">		
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="logout.php">Logout</a></li>
										<li><a href=""><!-- <?php  echo $_SESSION['username'];  ?> --> </a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-12 articles">
						<div class="row">						
							<table id="example" class="table table-bordered" style="width: 100%">
								<h1>Menu</h1>
								<a type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" href="dashboard.php" style="margin-bottom:10px; margin-right: 5px;"></a>
								<a type="button" class="btn btn-primary glyphicon glyphicon-plus" href="../process/add_Menu.php" style="margin-bottom:10px"></a>
								<thead>
									<tr>
										<th>ID</th>
										<th>Item</th>
										<th>Price</th>
										<th>Category</th>
										<th>Stock</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$no=1;
										foreach($menu as $data) {?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $data["item"];?></td>
										<td><?php echo $data["price"];?></td>
										<td><?php echo $data["kategori"];?></td>
										<td><?php echo $data["stock"];?></td>
										
										<td><img src="../assets/img/<?php echo $data['img_path'] ?>" alt="<?php echo $data['item']; ?>" width="100" height="73"></td>
			
										<td><a type="button" class="btn btn-danger"    onclick="return confirm('Are you sure?')" onclick="return confirm('Are you sure?')" href="../process/delete_menu.php?id=<?php echo $data['id']?>">Delete</a>
											<a type="button" class="btn btn-success" href="../process/edit_menu.php?id=<?php echo $data['id']?>">Update</a>
										</td>
									</tr>
									<?php $no++;}?>
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</form>
			<?php include('../layout/footercasier.php'); ?>
		<script>
			$(document).ready(function () {
				$("#example").DataTable();
			});
		</script>
	</body>
</html>									