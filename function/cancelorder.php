<?php 
session_start();
include('../config/dbhelper.php');
$con = mysqli_connect("localhost","root","","eshop");
$idBill = $_POST['idBill'];
$reason = $_POST['reason'];

$sql = mysqli_query($con,"UPDATE orders SET status=2, cancel_reason='".$reason."' WHERE id='".$idBill."'");
if ($sql){
    echo true;
}else{
    echo false;
}
?>