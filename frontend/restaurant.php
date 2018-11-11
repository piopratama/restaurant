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
                header("location:index.php");
            }
        }
    }
    $title="Order";
    include('../layout/headercasier.php');

    require('../koneksi.php');
    $sql1 = "SELECT id, meja FROM tb_meja";
    $data_meja = $conn->query($sql1);

    $sql2 = "SELECT id, item, price, kategori FROM tb_menu where `status`='yes';";
    $data_menu = $conn->query($sql2);
?>
<body>
    <!--<form method="POST" action="">-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">Restaurant</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control" id="" name="date" placeholder="Date" value="<?php echo Date('Y-m-d'); ?>" readonly="readonly">
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
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['item']; ?></option>
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
                                            <img src="../assets/img/<?php echo $row['id'] ?>.jpg" alt="<?php echo $row['item']; ?>" width="100" height="73" class="dropdown-toggle imageMenu" data-toggle="dropdown">
                                            <p class="text-center">IDR <?php echo rupiah($row['price']); ?></p>
                                            <div class="dropdown-menu dropdown-menu-myStyle">
                                                <div class="form-group">
                                                    <label for="">Qty</label>
                                                    <input type="hidden" value="1" class="form-control type">
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
                                            <p class="text-center">IDR <?php echo rupiah($row['price']); ?></p>
                                            <div class="dropdown-menu dropdown-menu-myStyle">
                                                <div class="form-group">
                                                    <label for="">Qty</label>
                                                    <input type="hidden" value="2" class="form-control type">
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
                <button type="button" id="submitBtn" class="btn btn-success center-block" data-dismiss="alert" aria-hidden="true">Submit</button>
            </div>
        </div>
    <!--</form>-->

    <?php include('../layout/footercasier.php'); ?>
    <script>
        $(document).ready(function () {
            $("#customer_table").select2();
            $("#search_menu").select2();

            $(".menuWrapper").on('click', '.addMenuOrder', function(){
                var qty=$(this).parent().prev().find('.qty').val();
                var type=$(this).parent().prev().find('.type').val();

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
                }
            });

            $(".menuWrapperOrder").on('click', '.addMenuOrder', function(){
                var s=$(this).parent().parent().parent().find('.title-menu').text();
                s = s.substring(0, s.indexOf('('))+"("+$(this).parent().prev().find('.qty').val()+")";
                $(this).parent().parent().parent().find('.title-menu').html(s);
            });

            $(".menuWrapperOrder").on('click', '.removeMenuOrder', function(){
                $(this).parent().parent().parent().remove();
            });

            $("#search_menu").change(function(){
                var idMenu=$(this).val();
                $.ajax({
                    type: "POST",
                    url: "../process/getMenuById.php",
                    data: {id:idMenu},
                    dataType: "text",
                    success: function (response) {
                        $("#foodOrder").append(response);
                    }
                });
            });

            $("#submitBtn").click(function(){
                var data = new Array();

                $(".menuWrapperOrder .idItem").each(function(indexInArray, valueOfElement){
                    var dataObject={id:$(this).val(),type: $(this).prev().val(), qty: $(this).next().val()};
                    data.push(dataObject);
                });

                $.ajax({
                    type: "POST",
                    url: "../process/insertOrder.php",
                    data: {data: JSON.stringify(data)},
                    dataType: "text",
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>
</html>