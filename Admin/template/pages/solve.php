<?php
	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../../../config/dbhelper.php');
    require('../../../Carbon/autoload.php');
      $now = date('Y-m-d');
	 if(isset($_GET['code'])){
	 	$code = $_GET['code'];
	 	$con=mysqli_connect("localhost","root","","eshop");
	 	$sql = mysqli_query($con,"UPDATE orders SET status=0 WHERE code_order='".$code."'");
	 	
        //thống kê
	 	$con=mysqli_connect("localhost","root","","eshop");
	 	$sql_lietke_dh = mysqli_query($con,"SELECT * FROM order_detail,product WHERE order_detail.product_id=product.id AND order_detail.code_order='$code' ORDER BY order_detail.id DESC");

        $con=mysqli_connect("localhost","root","","eshop");
        $sql_thongke = mysqli_query($con,"SELECT * FROM statistical WHERE ngaydat='$now'"); 
        
        $soluongmua = 0;
        $doanhthu   = 0;
        while($row = mysqli_fetch_array($sql_lietke_dh)){
              $soluongmua +=$row['soluongmua'];
              $doanhthu +=$row['price'];
        }
        if(mysqli_num_rows($sql_thongke)==0){
                $soluongban = $soluongmua;
                $doanhthu   = $doanhthu;
                $donhang    = 1;
                $sql_update_thongke = mysqli_query($con,"INSERT INTO statistical (ngaydat,soluongban,doanhthu,donhang) VALUE('$now','$soluongban','$doanhthu','$donhang')" );
        }elseif(mysqli_num_rows($sql_thongke)!=0){
            while($row_tk   = mysqli_fetch_array($sql_thongke)){
                $soluongban = $row_tk['soluongban']+$soluongban;
                $doanhthu   = $row_tk['doanhthu']+$doanhthu;
                $donhang    = $row_tk['donhang']+1;
                $sql_update_thongke = mysqli_query($con,"UPDATE statistical SET soluongban='$soluongban',doanhthu='$doanhthu',donhang='$donhang' WHERE ngaydat='$now'" );
            }
        }
	 	header('Location: ' . $_SERVER['HTTP_REFERER']);
	 }
?>