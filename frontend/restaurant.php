<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location:..");
    }
    else
    {
        if(!empty($_SESSION['level_user']))
        {
            if($_SESSION["level_user"]==1)
            {
                header("location:..");
            }
        }
    }
    $title="Order";
    include('../layout/headercasier.php');

    require('../koneksi.php');
    $sql1 = "SELECT id, meja FROM tb_meja";
    $data_meja = $conn->query($sql1);

    $sql2 = "SELECT id, item, price, kategori, img_path FROM tb_menu where `status`='yes';";
    $data_menu = $conn->query($sql2);
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
									<a class="navbar-brand" style="font-size: 40px;" href="#">Order</a>
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

    <!--<form method="POST" action="">-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if($_SESSION["level_user"]==2)
                    {
                    ?>
                        <a href="main_menu.php" style="margin-left: 5px; margin-bottom: 10px;" type="button" class="btn btn-danger glyphicon glyphicon-arrow-left" ></a><br>
                    <?php
                    }
                    ?>
                    <h1 class="text-center">Restaurant</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo Date('Y-m-d'); ?>" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="">Customer</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Table</label>
                        <select name="customer_table" id="customer_table" class="form-control" require="required">
                            <option value="">-- Select Table --</option>
                            <?php
                            while($row=$data_meja->fetch_assoc())
                            {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['meja']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Search Menu</label>
                        <select id="search_menu" class="form-control">
                            <option value="">-- Search Menu --</option>
                            <?php
                            while($row=$data_menu->fetch_assoc())
                            {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['item'].($row['kategori']==1 ? " (food)":" (beverage)"); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" id="clearBtn">Clear Data</button>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-center">Menu</h2>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#food" aria-controls="food" role="tab" data-toggle="tab">Food</a>
                            </li>
                            <li role="presentation">
                                <a href="#beverage" aria-controls="beverage" role="tab" data-toggle="tab">Beverage</a>
                            </li>
                        </ul>
                            
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active menuWrapper" id="food">
                                <h3 class="text-center">Food</h3>
                                <?php
                                mysqli_data_seek($data_menu, 0);
                                while($row=$data_menu->fetch_assoc())
                                {
                                    if($row['kategori']==1)
                                    {
                                ?>
                                    <div class="dropdown">
                                        <div class="col-sm-3 myMenu">
                                            <p class="text-center title-menu"><?php echo $row['item'] ?></p>
                                            <img src="../assets/img/<?php echo $row['id']?>.jpg" alt="<?php echo $row['item']; ?>" width="100" height="73" class="dropdown-toggle imageMenu" data-toggle="dropdown">
                                            <p class="text-center priceMenu">IDR <?php echo rupiah($row['price']); ?></p>
                                            <div class="dropdown-menu dropdown-menu-myStyle">
                                                <div class="form-group">
                                                    <label for="">Qty</label>
                                                    <input type="hidden" value="1" class="form-control type">
                                                    <input type="hidden" value="<?php echo $row['price']; ?>" class="form-control price">
                                                    <input type="hidden" value="<?php echo $row['id']; ?>" class="form-control idItem">
                                                    <input type="number" value="1" class="form-control qty" placeholder="Qty">
                                                </div>
                                                <div class="mybtn-dropdown">
                                                    <button type="button" class="btn btn-primary pull-right addMenuOrder">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div role="tabpanel" class="tab-pane menuWrapper" id="beverage">
                                <h3 class="text-center">Beverage</h3>
                                <?php
                                mysqli_data_seek($data_menu, 0);
                                while($row=$data_menu->fetch_assoc())
                                {
                                    if($row['kategori']==2)
                                    {
                                ?>
                                    <div class="dropdown">
                                        <div class="col-sm-3 myMenu">
                                            <p class="text-center title-menu"><?php echo $row['item'] ?></p>
                                            <img src="../assets/img/<?php echo $row['id'] ?>.jpg" alt="<?php echo $row['item']; ?>" width="100" height="73" class="dropdown-toggle imageMenu" data-toggle="dropdown">
                                            <p class="text-center price">IDR <?php echo rupiah($row['price']); ?></p>
                                            <div class="dropdown-menu dropdown-menu-myStyle">
                                                <div class="form-group">
                                                    <label for="">Qty</label>
                                                    <input type="hidden" value="2" class="form-control type">
                                                    <input type="hidden" value="<?php echo $row['price']; ?>" class="form-control price">
                                                    <input type="hidden" value="<?php echo $row['id']; ?>" class="form-control idItem">
                                                    <input type="number" value="1" class="form-control qty" placeholder="Qty">
                                                </div>
                                                <div class="mybtn-dropdown">
                                                    <button type="button" class="btn btn-primary pull-right addMenuOrder">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-sm-6" id="ordered">
                    <h2 class="text-center">Ordered</h2>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#foodOrder" aria-controls="foodOrder" role="tab" data-toggle="tab">Food</a>
                            </li>
                            <li role="presentation">
                                <a href="#beverageOrder" aria-controls="beverageOrder" role="tab" data-toggle="tab">Beverage</a>
                            </li>
                        </ul>
                            
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active menuWrapperOrder" id="foodOrder">
                                <h3 class="text-center">Food</h3>
                            </div>
                            <div role="tabpanel" class="tab-pane menuWrapperOrder" id="beverageOrder">
                                <h3 class="text-center">Beverage</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input type="number" class="form-control" id="total" placeholder="Total" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <!--<div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Payment</label>
                        <input type="number" class="form-control" id="payment" placeholder="Payment">
                    </div>                    
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Change</label>
                        <input type="number" class="form-control" id="change" placeholder="Change" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Method</label>
                        <select name="method" id="method" class="form-control" required="required">
                            <option value="">-- Select Method --</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="button" id="submitBtn" class="btn btn-success center-block" data-dismiss="alert" aria-hidden="true">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    <!--</form>-->
    
    <div class="modal fade" id="exampleModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    <p id="message">Insert Successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    <p id="messageError">Please Select Menu</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    <p id="messageName">Please insert Menu</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php 
        $session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
        unset($_SESSION['message']);
        
        $pelayan=(isset($_SESSION['nama']))?$_SESSION['nama']:'';
    ?>
    <?php include('../layout/footercasier.php'); ?>
    <script>
        $(document).ready(function () {
            var total=0;
            var pelayan="<?php echo $pelayan; ?>";
            $("#customer_table").select2();
            $("#search_menu").select2();
            
            /*var message='<?php echo $session_value;?>';
            if(message!="")
            {
                $("#exampleModal2").modal('show');
            }*/

            $(".menuWrapper").on('click', '.addMenuOrder', function(){
                if($("#customer_name").val()==""){
                    $("#messageName").html("Please Insert Name");
                    $("#exampleModal4").modal('show');
                }
                else{
                    var qty=$(this).parent().prev().find('.qty').val();
                    var type=$(this).parent().prev().find('.type').val();
                    var price=$(this).parent().prev().find('.price').val();
                    
                    if(parseFloat(qty)>0)
                    {
                        if(parseInt(type)==1)
                        {
                            $("#foodOrder").append($(this).parent().parent().parent().parent().html());
                            
                            $("#foodOrder .mybtn-dropdown").html("<button type='button' class='btn btn-primary pull-right removeMenuOrder'>Delete</button><button type='button' class='btn btn-primary pull-right addMenuOrder' style='margin-right:2px;'>Update</button>");
                            
                            $("#foodOrder .title-menu:last").html($(this).parent().parent().parent().parent().find('.title-menu').html()+" ("+qty+") ");

                        $("#foodOrder .qty:last").val(qty);
                    }
                    else if(parseInt(type)==2)
                    { 
                        $("#beverageOrder").append($(this).parent().parent().parent().parent().html());
                        
                        $("#beverageOrder .mybtn-dropdown").html("<button type='button' class='btn btn-primary pull-right removeMenuOrder'>Delete</button><button type='button' class='btn btn-primary pull-right addMenuOrder' style='margin-right:2px;'>Update</button>");

                            $("#beverageOrder .title-menu:last").html($(this).parent().parent().parent().parent().find('.title-menu').html()+" ("+qty+") ");

                            $("#beverageOrder .qty:last").val(qty);
                        }

                        total=total+qty*parseFloat(price);
                        $("#total").val(total);
                    }
                }
            });
            
            /*$("#payment").keyup(function(){
                var totalVal=$("#total").val();
                if(totalVal!="" && $(this).val()!="")
                {
                    $("#change").val(totalVal-parseFloat($(this).val()));
                }
            });*/

            $(".menuWrapperOrder").on('click', '.addMenuOrder', function(){
                var s=$(this).parent().parent().parent().find('.title-menu').text();
                s = s.substring(0, s.indexOf('('))+"("+$(this).parent().prev().find('.qty').val()+")";
                $(this).parent().parent().parent().find('.title-menu').html(s);
                
                total=0;
                $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                    total=total+parseFloat($(this).next().val())*parseFloat($(this).prev().val());
                });

                $("#total").val(total);
            });

            $(".menuWrapperOrder").on('click', '.removeMenuOrder', function(){
                $(this).parent().parent().parent().remove();
                var rmPrice=$(this).parent().prev().find('.price').val();
                var rmQty=$(this).parent().prev().find('.qty').val();
                
                total=total-rmQty*parseFloat(rmPrice);
                $("#total").val(total);
            });

            $("#search_menu").change(function(){
                var idMenu=$(this).val();
                var textMenu=$(this).find('option:selected').text();
                
                $.ajax({
                    type: "POST",
                    url: "../process/getMenuById.php",
                    data: {id:idMenu},
                    dataType: "text",
                    success: function (response) {
                        if(textMenu.indexOf('food')!=-1)
                        {
                            $("#foodOrder").append(response);
                        }
                        else
                        {
                            $("#beverageOrder").append(response);
                        }

                        total=0;
                        $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                            total=total+parseFloat($(this).next().val())*parseFloat($(this).prev().val());
                        });
                        $("#total").val(total);
                    }
                });
            });
            
            function search_order(){
                var idMeja=$("#customer_table").val();
                var name = $("#customer_name").val();
                if(idMeja!="")
                {
                    $.ajax({
                        type: "POST",
                        url: "../process/getMenuByMejaFood.php",
                        data: {idMeja:idMeja, customer:name},
                        dataType: "text",
                        success: function (response) {
                            $("#foodOrder").html(response);
                            total=0;
                            $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                                total=total+parseFloat($(this).next().val())*parseFloat($(this).prev().val());
                            });

                            $("#total").val(total);
                        }
                
                    });

                    $.ajax({
                        type: "POST",
                        url: "../process/getMenuByMejaBeverage.php",
                        data: {idMeja:idMeja, customer:name},
                        dataType: "text",
                        success: function (response) {
                            $("#beverageOrder").html(response);
                            total=0;
                            $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                                total=total+parseFloat($(this).next().val())*parseFloat($(this).prev().val());
                            });

                            $("#total").val(total);
                        }
                    });
                }
            }

            $("#customer_table").change(function(){
                search_order();
            });
            
            $("#customer_name").keyup(function (e) {
                search_order();
            });

            $("#clearBtn").click(function(){
                location.reload();
            });

            $("#submitBtn").click(function(){
                var data = new Array();
                if(($("#total").val()=="")||($("#total").val()=="0")){
                    $("#messageError").html("Please Select Menu");
                    $("#exampleModal3").modal('show');
                }
                else
                {
                    $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                        var dataObject={id:$(this).val(),type: $(this).prev().prev().val(), qty: $(this).next().val(), price: $(this).prev().val()};
                        data.push(dataObject);
                    });

                    $.ajax({
                        type: "POST",
                        url: "../process/insertOrder.php",
                        data: {data: JSON.stringify(data), customer: $("#customer_name").val(), meja: $("#customer_table").val(), description: $("#description").val(), total: $("#total").val(), payment: $("#payment").val(), change: $('#change').val()},
                        dataType: "text",
                        success: function (response) {
                            $("#message").html("Insert Successfully");
                            $("#exampleModal2").modal('show');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#message").html("Insert Unsuccessfully");
                            $("#exampleModal2").modal('show');
                        }
                    }); 
                }

                var printer = new Recta('3245260761', '1811');
                var data = new Array();
                $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                    var qty=$(this).next().val();
                    var price=$(this).prev().val();
                    var dataObject={id:$(this).val(),type: $(this).prev().prev().val(), qty: $(this).next().val(), price: $(this).prev().val(), itemName: $(this).parent().parent().prev().prev().prev().text(), total: qty*price};
                    data.push(dataObject);
                });
                printer.open().then(function () {
                    var x=[];
                    printer.align('center')	
                    .text('RESTAURANT')
                    .bold(true)
                    .text($("#date").val())	
                    .text("Waitrees :" + pelayan)
                    .text("Name  :" + $("#customer_name").val())
                    .text("Table :" + $("#customer_table").val())	
                    .text('------------------------------')
                    printer.align('left')
                    .text()
                    .bold(true);
                    printer.text("Food");
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
            });
        });
    </script>
</body>
</html>