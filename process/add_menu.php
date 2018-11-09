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

	include('../layout/headercasier.php');
	require('../koneksi.php');
	$sql = "SELECT * FROM tb_kategori";
	$result = $conn->query($sql);
?>
	<link rel="stylesheet" type="text/css" href="./css/directPayStyle.css">
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
								<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Restaurant</a>
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
		<div class="container">
			<div class="row">
				<div class="col-md-4 sidebar">
					<a type="button" href="../backend/dashboard.php" class="btn btn-danger glyphicon glyphicon-arrow-left"></a>
				</div>
				
				<div class="col-md-8 articles">
					<div class="row">
						<div class="col-md-12" style="margin: 10px 0px">
							<form action="add_menu_process.php" method="POST" role="form" enctype="multipart/form-data">
								<table>				
									<tr>
										<td>	
											<div class="form-group">
												<label for="usr">Item :</label>
												<input type="text" style="width: 200%; margin-bottom: 5px;" class="form-control" name="item" id="usr" required="required">
											</div>
										</td>
									</tr>
									<tr>
										
										<td>	
											<div class="form-group">
												<label for="usr">Price :</label>
												<input type="text" style="width: 200%; margin-bottom: 5px;" class="form-control" name="price" id="usr" required="required">
											</div>
										</td>
									</tr>
									<tr>
										
										<td><label>Kategori</label>
											<select name="type" style="width: 200%; margin-bottom: 10px;" class="form-control" >
											<option value="">-- Select Category --</option>
													<?php
														if ($result->num_rows > 0) {
														// output data of each row
														while($row = $result->fetch_assoc()) {
														?>
													<option value="<?php echo $row['id']?>"><?php echo $row['kategori'];?></option>
													<?php
														}
													}
														$conn->close();
													?>
											</select> 
										</td>
									</tr>
									<tr>
										
										<td>	
											<div class="form-group">
												<label for="usr">Stock</label>
												<input type="text" style="width: 200%; margin-bottom: 5px;" class="form-control" name="stock" id="usr" required="required">
											</div>
										</td>
									</tr>
									<tr>
										<td>	
											<div class="form-group">
												<label for="usr">Images</label>
												<input type="file" style="width: 80%; height: 400%; margin-bottom: 5px;" class="form-control" name="image" id="usr">
											</div>
										</td>
									</tr>
									<tr>
										<td><button type="submit" class="btn btn-success" id="add_item_btn" name=Submit>Submit</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>