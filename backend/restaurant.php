<?php
session_start();
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/directPayStyle.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	</head>
	<body>
		<form method="POST">
			<div class="container-fluid" style="margin-right: -15px; margin-left: -15px;">
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Shop</a>
								</div>
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Date</label>
							<input type="date" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" placeholder="" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" id="date" placeholder="Name" requaried="required">
						</div>
						<button type="button" class="btn btn-warning" id="menu">Menu</button>

					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row"  id="parent_item_container">
					
				</div>	

				<div class="row" id="parent_drink_container">
					
				</div>
				<div class="row">
					<!--<div class="col-md-8"></div>-->
					<div class="col-md-4">
						<div class="form-group">
							<label for=""></label>
							<input type="text" class="form-control" id="grand" hidden="true" placeholder="Grand Total" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Grand Total</label>
							<input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="">Payment</label>
							<input type="text" class="form-control" name="payment" id="payment" placeholder="Payment" required="required">
						</div>
						<div class="form-group">
							<label for="">Change</label>
							<input type="text" class="form-control" id="change" placeholder="Change" readonly="readonly">
						</div>
					</div>
				</div>
			</div>
		</form>

		<script src="https://cdn.jsdelivr.net/npm/recta/dist/recta.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="assets\jsNumber\jquery.number.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#menu").click(function(event) {
					$.ajax({
						url: 'checkPriceRestaurant.php',
						type: 'post',
						data: {},
						success: function (data) {
							
							//$("#parent_item_container").html(data);

						}
					});

					$.ajax({
						url: 'checkPriceRestaurantDrink.php',
						type: 'post',
						data: {},
						success: function (data) {
							alert(data);
							$("#parent_drink_container").html(data);
						}
					});
				});


				$("#parent_drink_container").on('keyup','.qty',function(event) {
					var qty=$(this).parent().next().next().parent().find(".qty").val();
					var price=$(this).parent().next().next().parent().find(".price").val();
					var priceTotal=$(this).parent().next().next().parent().find(".total");
					var total=qty*price;
					
					priceTotal.val(total);

					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							totalFinal=total+0.1*total;
							$("#grandTotal").val(totalFinal);

						};
					});
				});

				$("#parent_item_container").on('keyup','.qty',function(event) {
					var qty=$(this).parent().next().next().parent().find(".qty").val();
					var price=$(this).parent().next().next().parent().find(".price").val();
					var priceTotal=$(this).parent().next().next().parent().find(".total");
					var total=qty*price;
					
					priceTotal.val(total);

					var total=0;
					$('.total').each(function(i, obj) {
						if(isNaN($(this).val())==false && $(this).val()!="")
						{
							total=total+parseFloat($(this).val());
							totalFinal=total+0.1*total;
							$("#grandTotal").val(totalFinal);

						};
					});
				});

				$("#payment").keyup(function(event) {
					var grandTotal=($("#grandTotal").val());
					var payment=($("#payment").val());
					var change=payment-grandTotal;
					$("#change").val(change);
				});
			});
		</script>
	</body>
</html>