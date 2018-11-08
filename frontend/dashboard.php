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
                header("location:../index.php");
            }
        }
    }
    $title="Dashboard";
    include('../layout/headercasier.php');

    require('../koneksi.php');
    $sql1 = "SELECT id, meja FROM tb_meja";
    $data_meja = $conn->query($sql1);

    $sql2 = "SELECT id, item, price, kategori FROM tb_menu where `status`='yes';";
    $data_menu = $conn->query($sql2);
?>
<body>
    <form method="POST" action="orderTransaction.php">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <ul class="nav navbar-nav navbar-right">
                        <a type="button" class="btn btn-danger" style="margin: 10px; padding: 10px; color: white" href="logout.php">Logout</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">Dashboard</h1>
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
                            <div role="tabpanel" class="tab-pane active" id="food">
                                <h3 class="text-center">Food</h3>
                                <?php
                                mysqli_data_seek($data_menu, 0);
                                while($row=$data_menu->fetch_assoc())
                                {
                                    if($row['kategori']==1)
                                    {
                                ?>
                                    <div class="col-sm-3 dropdown">
                                        <div class="col-sm-12 dropdown-toggle" id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' name="item[]">
                                            <p class="text-center item"><?php echo $row['item'] ?></p>
                                            <img src="../assets/img/<?php echo $row['id'] ?>.jpg" alt="<?php echo $row['item']; ?>" width="100" height="73">
                                            <p class="text-center">IDR <?php echo rupiah($row['price']); ?></p>
                                        </div>

                                        <!--dropdown order 'edited 08-11-2018'-->
                                        <div class='col-sm-12 dropdown-menu control order' aria-labelledby='dropdownMenuButton'>
                                            <div class="col-sm-12">
                                                Quantity
                                                <input min="1" type="number" class="form-control qty" required=required width="200">
                                            </div>     
                                            <div class="col-sm-12">
                                                Price
                                                <input type="text" class="form-control price" value="<?php echo $row['price']?>" readonly=readonly>
                                            </div>
                                            <div class="col-sm-12" hidden="true">    
                                                Total
                                                <input type="text" class="form-control total" required=required>   
                                            </div>                                
                                        </div>
                                    </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="beverage">
                                <h3 class="text-center">Beverage</h3>
                                <?php
                                mysqli_data_seek($data_menu, 0);
                                while($row=$data_menu->fetch_assoc())
                                {
                                    if($row['kategori']==2)
                                    {
                                ?>
                                    <div class="col-sm-3 dropdown">
                                        <div class="col-sm-12 dropdown-toggle" id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <p class="text-center><?php echo $row['item'] ?></p>
                                            <img src="../assets/img/<?php echo $row['id'] ?>.jpg" alt="<?php echo $row['item']; ?>" width="100" height="73">
                                            <p class="text-center">IDR <?php echo rupiah($row['price']); ?></p>
                                        </div>
                                        <div class='col-sm-12 dropdown-menu control order' aria-labelledby='dropdownMenuButton'>
                                            <div class="col-sm-12">
                                                Quantity
                                                <input min="1" type="number" class="form-control qty" name="qty[]" required=required width="200">
                                            </div>     
                                            <div class="col-sm-12">
                                                Price
                                                <input type="text" class="form-control price" value="<?php echo $row['price']?>" name="price[]" readonly=readonly>
                                            </div>
                                            <div class="col-sm-12" hidden="true">    
                                                Total
                                                <input type="text" class="form-control total" required=required>   
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
                <div class="col-sm-6">
                    <h2 class="text-center">Order</h2>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        Item
                        <input type="text" class="itemOrder" readonly=readonly width="10%"> 
                        Quantitiy
                        <input type="number" class="qtyOrder" readonly=readonly>
                        <a type="button" class="btn btn-danger glyphicon glyphicon-trash deleteIcon"><a>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-9"></div>
            <div class="col-sm-3">
                Gran Total</br>
                <input type="text" class="form-control" id="grandTotal" placeholder="Grand Total" readonly=readonly>
                <button type="submit"class="btn btn-success" id="orderBtn">Order</button>
            </div>
        </div>
    </form>
    <?php include('../layout/footercasier.php'); ?>
    <script>
        $(document).ready(function () {
        
        });
    </script>
</body>
</html>