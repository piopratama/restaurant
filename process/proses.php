<?php 
    $jmlhmkanan=count($_POST['makanan']);
    $jmlhminuman=count($_POST['minuman']);
    $makanan=$_POST['makanan'];
    $minuman=$_POST['minuman'];
    $meja = $_POST['meja'];
    
    echo $meja; echo "<br>";
    for($i=0;$i<$jmlhmkanan;$i++){
        echo $makanan[$i]; echo "<br>";
    }
    for($i=0;$i<$jmlhminuman;$i++){
        echo $minuman[$i];echo "<br>";
    }
    
    

?>