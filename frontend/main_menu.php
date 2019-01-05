<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location:..");
    }
    else
    {
        if(!empty($_SESSION['level_user']))
        {
            if($_SESSION["level_user"]==0 || $_SESSION["level_user"]==1)
            {
                header("location:..");
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Casier</a>
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
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="restaurant.php"><button type="button" class="btn btn-default buttonMenu" >Order</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="payment_menu.php"><button type="button" class="btn btn-default buttonMenu">Payment</button></a>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);

			$pelayan=(isset($_SESSION['nama']))?$_SESSION['nama']:'';
			$level_user=(isset($_SESSION["level_user"]))?$_SESSION["level_user"]:'';
		?>
		<?php include('../layout/footercasier.php');?>
		<script>
			$(document).ready(function () {
				var total=0;
				var pelayan="<?php echo $pelayan; ?>";
				var level_user="<?php echo $level_user; ?>";

				var conn = new WebSocket('ws:/192.168.0.101:8080');
				conn.onopen = function(e) {
					console.log("Connection established!");
				};

				conn.onmessage = function(e) {
					console.log(e.data);
					if(level_user!="" && level_user!="0")
					{
						printer(JSON.parse(e.data));
					}
				};

				function printer(data)
				{
					var printer = new Recta('3245260761', '1811');
					printer.open().then(function () {
						var x=[];
						var pelayan="";
                    var cust_table="";
                    var cust_name="";
                    if(data.length>0)
                    {
                        pelayan=data[0].pelayan;
                        cust_table=data[0].cust_table;
                        cust_name=data[0].cust_name;
                    }

                    printer.align('center')	
						.text('RESTAURANT')
						.bold(true)
						.text($("#date").val())	
						.text("Waitrees :" + pelayan)
						.text("Name  :" + cust_name)
						.text("Table :" + cust_table)	
						.text('------------------------------')
						printer.align('left')
						.text()
						.bold(true);
						printer.text("Food");
						printer.text("Item"+"(Qty)");
						printer.text("");
						for(var j=0;j<data.length;j++)
						{
							if(data[j].type=="1" || data[j].type=="food")
							{
								printer.text(data[j].itemName);
								printer.text("");
							}
						}
						printer.text("");
						printer.text("Bevarage");
						printer.text("Item"+"(Qty)");
						printer.text("");
						for(var j=0;j<data.length;j++)
						{
							if(data[j].type=="2" || data[j].type=="beverage")
							{
								printer.text(data[j].itemName);
								printer.text("");
							}
						}
						printer.bold(true);
						printer.text("------------------------------")
						.text("")
						.text("Description :")
						.text($("#description").val())
						.cut()
						.print();
					});
				}
			});
		</script>
	</body>
</html>