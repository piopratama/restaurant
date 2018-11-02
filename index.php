<?php 
	session_start();
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	$url=$protocol."".$_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI'];
	$_SESSION['url']=$url;
	include('./layout/headercasier.php');
?>
	<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['url']; ?>css/loginStyle.css">
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Resto</a>
								</div>
								<div class="collapse navbar-collapse navbar-ex1-collapse">						
									<ul class="nav navbar-nav navbar-right">
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
			<div class="row">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-4" id="container-form">
					<form action="process/loginProcess.php" method="POST" role="form">
						<legend>Login</legend>
					
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" name="username" class="form-control" id="username" placeholder="Username" required="required">
						</div>
						
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required">
						</div>
						
					
						<button type="submit" class="btn btn-primary">Login</button>
						
					</form>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>
		<?php include('./layout/footercasier.php'); ?>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				if(message!="")
				{
					alert(message);
				}
			});
		</script>
	</body>
</html>