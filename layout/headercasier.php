<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['url']; ?>assets/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['url']; ?>assets/bootstrap3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <link href="<?php echo $_SESSION['url']; ?>assets/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $_SESSION['url']; ?>assets/chart.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['url']; ?>css/myStyle.css">

    <?php
    function rupiah($angka){
	
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
     
    }
    ?>
</head>