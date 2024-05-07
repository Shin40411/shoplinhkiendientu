<?php
session_start();
$tongtien = 0;
$payments = array();
$paymenthtml = '';
if (isset($_SESSION['id_khachhang'])) {
  if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $cart_item) {
      $thanhtien = $cart_item['soluong'] * $cart_item['price'];
      $tongtien += $thanhtien;
    }
    $paymenthtml .= '<div class="row">';
    $paymenthtml .= '<div id="main-products">';
    $paymenthtml .= '<div class="main-detail">';
    $paymenthtml .= '<h3 style="text-align: center;">Phương thức thanh toán</h3>';
    $paymenthtml .= '<div class="container-fluid">';
    $paymenthtml .= '<div class="row">';
    $paymenthtml .= '<div class="col-md-12">';
    $paymenthtml .= '<div class="clear" style="margin-bottom:1%"></div>';
    $paymenthtml .= '<div class="row">';
    $paymenthtml .= ' <div class="col-md-12">';
    $paymenthtml .= '<form action="xulythanhtoan.php" method="POST">';
    $paymenthtml .= '<div style="padding:40px">';
    $paymenthtml .= '<div class="form-check">';
    $paymenthtml .= '<input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="Tiền mặt" checked>';
    $paymenthtml .= '<label class="form-check-label" style="padding-left:20px" for="exampleRadios1"> <i class="fa fa-money"></i>	&nbsp; Tiền mặt</label>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '<div class="form-check" style="margin-top:25px">';
    $paymenthtml .= '<input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="Chuyển khoản ATM">';
    $paymenthtml .= '<label class="form-check-label" style="padding-left:20px" for="exampleRadios2"> <i class="fa fa-credit-card-alt"></i>	&nbsp; Chuyển khoản</label>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    //  <div class="form-check">
    //                         <input class="form-check-input" type="radio" name="payment" style="margin-top:28px" id="exampleRadios3" value="vnpay">
    //                         <img src="img/vnpaylogo.jpg" height="70" width="40%" style="margin-left:8px">
    //                       </div> 
    $paymenthtml .= '<div class="d-flex justify-content-space">';
    $paymenthtml .= '<p style="float: left;margin-top: 8px;"><b>Tổng cộng:</b> ' . number_format($tongtien, 0, ',', '.') . '.đ' . '</p>';
    $paymenthtml .= '<input type="submit" value="Thanh toán ngay" name="redirect" id="redirect" class="btn btn-danger">';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</form>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';


    $payments = array(
      'formpay' => $paymenthtml
    );
    echo json_encode($payments);
  }
}
