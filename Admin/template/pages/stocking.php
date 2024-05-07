<?php 
    include('../../../config/dbhelper.php');

    if( $_GET['stock']){

    $id_stock=intval($_GET['stock']);
    $con=mysqli_connect("localhost","root","","eshop");
    $query=mysqli_query($con,"update product set status_pro='0' where id='$id_stock'");
}

if($_GET['outstock']){

    $id_outstock=intval($_GET['outstock']);
     $con=mysqli_connect("localhost","root","","eshop");
    $query=mysqli_query($con,"update product set status_pro='1' where id='$id_outstock'");
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>