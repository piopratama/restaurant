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
	$user = mysqli_query($conn, "SELECT nama FROM tb_employee where online_status=1");
?>
	<body>
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Dashboard</a>
								</div>
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">		
									<ul class="nav navbar-nav navbar-right">
										<li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="../logout.php">Logout</a></li>
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
				<div class="col-md-4" >
					<div style="height:200px; position: absolute;">
						<table>
						<p>User Online</p>
							<?php $no=0; 
							foreach( $user as $a ){
							?> 
							<tr style="border-bottom:1px solid black">
								<td style="width :100px; font-style:bold"><?php echo $a['nama'];?></td>
								<td style="color:green">Online</td>
							</tr>
							<?php  $no++; }?>
						</table>
					</div>
				</div>
				<div class="col-md-4">
					<a href="menuRestaurant.php"><button type="button" class="btn btn-default buttonMenu" id="directpayMenu">Menu</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="user.php"><button type="button" class="btn btn-default buttonMenu" id="undirectpayMenu">User</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="expenses.php"><button type="button" class="btn btn-default buttonMenu">Expenses</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="report.php"><button type="button" class="btn btn-default buttonMenu">Report</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="../backend/kategori.php"><button type="button" class="btn btn-default buttonMenu">Category</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		<?php include('../layout/footercasier.php');?>
	</body>
</html>