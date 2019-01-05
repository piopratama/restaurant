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
                header("location:..");
            }
        }
    }
    $title="User";
    include('../layout/headercasier.php');
	require('../koneksi.php');
    $barang = mysqli_query($conn, "SELECT * FROM tb_barang;");
    $user = mysqli_query($conn, "SELECT id, nama, address, sallary, tlp, username, password FROM tb_employee");
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
							<h1>USER</h1>
						
						<a type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" href="../backend/dashboard.php" style="margin:0 5px 10px 0"></a>
						<a type="button" class="btn btn-primary glyphicon glyphicon-plus" href="../process/add_user.php" style="margin: 0 0 10px 0"></a>
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Address</th>
									<th>Sallary</th>
									<th>tlpn</th>
									<th>Username</th>
									<th>Password</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no=1;
									foreach($user as $data) {?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $data["nama"];?></td>
									<td><?php echo $data["address"];?></td>
									<td><?php echo $data["sallary"];?></td>
									<td><?php echo $data["tlp"];?></td>
									<td><?php echo $data["username"];?></td>
									<td><?php echo $data["password"];?></td>
									<td>
										<a type="button" class="btn btn-danger" onclick="return confirm('Are you sure?')" href="../process/delete_user.php?id=<?php echo $data['id']?>"><span class="glyphicon glyphicon-trash"></span></a></a>
										<a type="button" class="btn btn-success" href="../process/edit_user.php?id=<?php echo $data['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
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