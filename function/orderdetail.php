<?php
session_start();
?>
<?php
include('layout/header.php');
require_once('../config/dbhelper.php');
$id = '';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = 'select * from product where id = ' . $id;
  $product = executeSingleResult($sql);
  $sql = 'select * from category where id = ' . $id;
  $category = executeSingleResult($sql);
  if ($category != null) {
    $name = $category['name'];
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đơn hàng đã đặt</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="Index_css/style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
  <?php if (isset($_SESSION['dangky'])) { ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('banner-slider/slider.php') ?>
        <div id="main-products">
          <?php include('sidebar/sidebar2.php') ?>
          <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
            <div class="main-detail">
              <?php
              if (isset($_GET['vnp_Amount'])) {

                $vnp_Amount = $_GET['vnp_Amount'];
                $vnp_BankCode = $_GET['vnp_BankCode'];
                $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
                $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
                $vnp_PayDate = $_GET['vnp_PayDate'];
                $vnp_TmnCode = $_GET['vnp_TmnCode'];
                $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
                $vnp_CardType = $_GET['vnp_CardType'];
                $code_cart = $_SESSION['code_cart'];

                //insert vnpay vao database
                $con = mysqli_connect("localhost", "root", "", "eshop");
                $insert_vnpay = "INSERT INTO vnpay(vnp_amount,code_orders,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno) VALUE('" . $vnp_Amount . "','" . $code_cart . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "','" . $vnp_TransactionNo . "')";
                $insert_cart = mysqli_query($con, $insert_vnpay);
                if ($insert_cart) {
                  echo "<script>alert('Thanh toán bằng Vnpay thành công! cảm ơn bạn đã mua hàng.');</script>";
                } else {
                  echo "<script>alert('Giao dịch thất bại');</script>";
                }
                if ($insert_cart) {
                  unset($_SESSION['cart']);
                }
              }

              ?>
              <h3 style=" text-align: center;">Đơn hàng đã đặt</h3>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <!-- Responsive Arrow Progress Bar -->
                    <div class="arrow-steps clearfix">
                      <div class="step done"> <span> <a href="giohang.php">Giỏ hàng</a></span> </div>
                      <div class="step done"> <span><a href="shipping.php">Giao hàng</a></span> </div>
                      <div class="step done"> <span><a href="billinfo.php">Thanh toán</a><span> </div>
                      <div class="step current"> <span>Đơn hàng<span> </div>
                    </div>
                    <!-- end Responsive Arrow Progress Bar -->
                    <?php
                    $id_khachhang = $_SESSION['id_khachhang'];
                    $code_carts = $_SESSION['code_cart'];
                    $con = mysqli_connect("localhost", "root", "", "eshop");
                    $sql_lietke_dh = mysqli_query($con, "SELECT * FROM orders,signup WHERE orders.id_khachhang=signup.id_signup AND orders.id_khachhang='$id_khachhang' AND orders.code_order='$code_carts' ORDER BY orders.id ASC");
                    ?>
                    <div class="table-responsive" style="margin-top: 15px;">
                      <table class="table table-light table-hover">
                        <thead class="thead-dark">
                          <tr>

                            <th>Mã đơn hàng</th>
                            <th>Họ tên</th>
                            <th style="vertical-align: middle;">Email</th>
                            <th>Hình thức thanh toán</th>
                            <th>Tình trạng</th>
                            <th style="vertical-align: middle;">Ngày đặt</th>
                            <th width="50px">In đơn</th>
                          </tr>
                        </thead>
                        <?php

                        $index = 1;
                        while ($item = mysqli_fetch_array($sql_lietke_dh)) {
                        ?>
                          <tr>

                            <td><?php echo $item['code_order'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['phone'] ?></td>
                            <td><?php echo $item['order_payment'] ?></td>
                            <td>
                              <?php if ($item['status'] == 1) {
                                echo 'Chưa xử lý';
                              } else {
                                echo 'Đã xem';
                              }
                              ?>
                            </td>
                            <td><?php echo $item['order_date'] ?></td>
                            <td><a href="orderprint.php?action=xemdonhang&code=<?php echo $item['code_order'] ?>" target="_blank"><i class="fa fa-print" style="font-size: 22px;vertical-align: middle;"></i></a></td>

                          </tr>
                        <?php
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include('sidebar/sidebar.php') ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>

  <?php
  } else {
    echo "<script>alert('Bạn cần đăng nhập');</script>";
    echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
  } ?>
  <img class="img img-responsive" width="100%" src="img/istockphoto-515673754-612x612.jpg" style="height: 609px">
  <!-- script -->
  <script src="js/jquery-1.11.1.min.js"></script>

  <?php include('banner-slider/slider-script.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <?php include('login/script.php') ?>
</body>

</html>
<?php
include('footer.php');
?>