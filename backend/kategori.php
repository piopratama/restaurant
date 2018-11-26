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
    $title="Category";
    include('../layout/headercasier.php');
	require('../koneksi.php');
    $category = mysqli_query($conn, "SELECT * FROM tb_kategori;");
?>
<body>
        <div class="container-fluid" style="">
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
                    
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse navbar-ex1-collapse">									
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px;" href="logout.php">Logout</a></li>
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
                <div class="col-md-12" id="mytable">
                <table id="example" class="table table-bordered" style="width: 100%;">
                    <h1>CATEGORY</h1>
                    
                    <a href="../backend/dashboard.php" style="margin:0 5px 10px 0" type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" ></a>
                    <a type="button" href="../backend/add_kategori.php" class="btn btn-primary glyphicon glyphicon-plus" style="margin-bottom:10px" data-toggle="modal" data-target="#exampleModal"></a>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no=1;
                            foreach ($category as $data) {?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data["kategori"];?></td>
                                <td><?php echo $data["description"];?></td>
                                <td>
                                    <a href="../process/delete_kategori.php?id=<?php echo $data['id'];?>" type="button" class="btn btn-danger glyphicon glyphicon-trash deleteCategory" onclick="return confirm('Are you sure?')" ></a>
                                    <a type="button" class="btn btn-success glyphicon glyphicon-pencil" href="../process/edit_kategori.php?id=<?php echo $data['id']?>"></a>
                                </td>
                            </tr>
                            <?php 
                            $no++; 
                            }           
                        ?>							
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="../process/add_kategori_process.php" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" name="category" class="form-control" placeholder="Category" require="required">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" row="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
                                    
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="deleteCategory.php" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_delete" id="id_delete" class="form-control" placeholder="id" require="required">
                        </div>
                        <p>Are you sure want to delete this data ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>

		<?php include('../layout/footercasier.php'); ?>
		<script>
			$(document).ready(function () {
				$("#example").DataTable();
			});
		</script>
	</body>
</html>				