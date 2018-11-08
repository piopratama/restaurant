<?php
 session_start();
 /*if(empty($_SESSION['username'])){
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
 }*/

 $date=$_POST["date"];
 $customer_name=$_POST["customer_name"];
 $customer_table=$_POST["customer_table"];
 $description=$_POST["description"];
 $item=$_POST["item"];
 $qty=$_POST["qty"];
 
 echo $name;
?>