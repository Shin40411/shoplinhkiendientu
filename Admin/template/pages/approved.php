<?php 
    include('../../../config/dbhelper.php');

    if( $_GET['disid']){

    $id_approved=intval($_GET['disid']);
    $con=mysqli_connect("localhost","root","","eshop");
    $query=mysqli_query($con,"update comment set status='1' where id_comment='$id_approved'");
}

if($_GET['appid']){

    $id_unapproved=intval($_GET['appid']);
     $con=mysqli_connect("localhost","root","","eshop");
    $query=mysqli_query($con,"update comment set status='0' where id_comment='$id_unapproved'");
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>