<?php 
session_start();
?> 
<?php 
require_once ('../config/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chi tiết đơn hàng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Admin/template/assets/css/admin_style.css" >
</head>
<body>
  <?php if(isset($_SESSION['dangky'])){ ?>
 <?php
    $code = $_GET['code'];
    $con=mysqli_connect("localhost","root","","eshop");
    $sql_lietke_dh = mysqli_query($con,"SELECT * FROM order_detail,product WHERE order_detail.product_id=product.id AND order_detail.code_order='".$code."' ORDER BY order_detail.id DESC");
       ?>
 <div id="order-detail-wrapper" style="margin-top:100px;">
            <div id="order-detail">
                <h3 style="text-align:center;">Chi tiết đơn hàng</h3>
                <hr/>
                <ul>
                    <?php
                      $tongtien = 0;
                      while($row = mysqli_fetch_array($sql_lietke_dh)){
                        $thanhtien = $row['price']*$row['soluongmua'];
                        $tongtien += $thanhtien ;
                      ?>
                        <li style="list-style:none;">
                            <span class="item-name"><strong>Mã đơn hàng:</strong> <?php echo $row['code_order'] ?></span>
                            <br>
                            <span class="item-name"> Tên sản phẩm: <?php echo $row['title'] ?></span>
                            <br>
                            <span class="item-quantity"> SL: <?php echo $row['soluongmua'] ?> sản phẩm</span>
                            <br>
                            <span class="item-name">Giá: <?php echo number_format($row['price'],0,',','.').'vnđ' ?></span>
                            <br>
                            <span class="item-name"> Thành tiền: <?php echo number_format($thanhtien,0,',','.').'vnđ' ?></span>
                        </li>
                </ul>
                 <?php } ?>
                <hr/>   
                <label><strong>Tổng tiền:</strong><?php echo number_format($tongtien,0,',','.').'vnđ' ?></label>  
            </div>
        </div>
<?php }else{
   echo "<script>alert('Bạn cần đăng nhập');</script>";
  echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
} ?>
</body>
</html>