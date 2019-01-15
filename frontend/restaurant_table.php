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
    $title="Restaurant Table";
    include('../layout/headercasier.php');

    require('../koneksi.php');
    $sql1 = "SELECT id, meja FROM tb_meja";
    $data_meja = $conn->query($sql1);
?>
<body class="container">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>

    <?php 
        $session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
        unset($_SESSION['message']);
        
        $pelayan=(isset($_SESSION['nama']))?$_SESSION['nama']:'';
        $level_user=(isset($_SESSION["level_user"]))?$_SESSION["level_user"]:'';
    ?>
    <?php include('../layout/footercasier.php'); ?>
    <script>
        $(document).ready(function () {
            var total=0;
            var pelayan="<?php echo $pelayan; ?>";
            var level_user="<?php echo $level_user; ?>";
            $("#customer_table").select2();
            $("#search_menu").select2();

            var conn = new WebSocket('ws://192.168.0.101:8080');
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
        });
    </script>
</body>
</html>