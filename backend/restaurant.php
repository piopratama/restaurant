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
		<div class="container-fluid dashboard">
			<div class="row">
                <div class="col-sm-9">
                    <h1 class="text-left">Dashboard</h1>
				</div>
                <div class="col-sm-3">
                    <ul class="nav navbar-nav navbar-right">
                        <a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="logout.php">Logout</a></li>
                        
                    </ul>
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
					<a href="kategori.php"><button type="button" class="btn btn-default buttonMenu">Category</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		<?php include('../layout/footercasier.php');?>
	</body>
</html>