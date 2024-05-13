<?php
session_start();
$tongtien = 0;
$payments = array();
$paymenthtml = '';
$con = mysqli_connect("localhost", "root", "", "eshop");
if (isset($_SESSION['id_khachhang'])) {
  $id_kh = $_SESSION['id_khachhang'];
  $sql_getaccount = mysqli_query($con, "SELECT * FROM signup WHERE id_signup='" . $id_kh . "'");
  $row = mysqli_fetch_assoc($sql_getaccount);
  $point = $row['points'];
  if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $cart_item) {
      $thanhtien = $cart_item['soluong'] * $cart_item['price'];
      $tongtien += $thanhtien;
    }
    $paymenthtml .= '<div class="row">';
    $paymenthtml .= ' <div id="main-products">';
    $paymenthtml .= '   <div class="main-detail">';
    $paymenthtml .= '<h3 style="text-align: center;">Phương thức thanh toán</h3>';
    $paymenthtml .= '     <div class="container-fluid">';
    $paymenthtml .= '       <div class="row">';
    $paymenthtml .= '         <div class="col-md-12">';
    $paymenthtml .= '           <div class="clear" style="margin-bottom:1%"></div>';
    $paymenthtml .= '<form action="" autocomplete="off" method="POST">';
    $paymenthtml .= '             <div class="row">';
    $paymenthtml .= '               <div class="col-md-12">';
    $paymenthtml .= '                 <div style="padding: 0 40px 40px 40px;">';
    $paymenthtml .= '                   <div class="form-check" style="margin-top:25px">';
    $paymenthtml .= '<label class="colorblack form-check-label" for="exampleRadios2">Tên chủ thẻ:</label>';
    $paymenthtml .= '<input class="form-control" type="text" id="cardholder" disabled>';
    $paymenthtml .= '                    </div>';
    $paymenthtml .= '                 <div class="form-check" style="margin-top:25px">';
    $paymenthtml .= '<label class="colorblack form-check-label" for="exampleRadios2">Chi tiết thẻ:</label>';
    $paymenthtml .= '                   <div class="carddetails">';
    $paymenthtml .= '<input class="form-control" style="width:60%" type="password" placeholder="Nhập số thẻ" maxlength="16" id="carddetails">';
    $paymenthtml .= '<input class="form-control" style="width:25%" type="month" text="MM/YY" id="paymentdate">';
    $paymenthtml .= '<input class="form-control" style="width:15%" type="text" maxlength="3" placeholder="CVV" id="paymentcvv">';
    $paymenthtml .= '                   </div>';
    $paymenthtml .= '                 </div>';

    if ($point > 0) {
      $paymenthtml .= '                   <div class="form-check" style="margin-top:25px">';
      $paymenthtml .= '<label class="colorblack form-check-label" for="exampleRadios2">Áp dụng điểm tích lũy:</label>';
      $paymenthtml .= '<input type="checkbox" style="margin-left:10px;margin-right:10px;" onclick="applyPoints()" id="applypoint">';
      $paymenthtml .= '<p>(Số điểm của bạn hiện có <span id="currentaccpoint">' . $point . '</span>.đ)</p>';
      $paymenthtml .= '<input type="hidden" value="' . $point . '000" id="hddpoint">';
      $paymenthtml .= '<input type="hidden" value="' . $point . '" id="hddpointsub">';
      $paymenthtml .= '                    </div>';
    }

    $paymenthtml .= '               </div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    //  <div class="form-check">
    //                         <input class="form-check-input" type="radio" name="payment" style="margin-top:28px" id="exampleRadios3" value="vnpay">
    //                         <img src="img/vnpaylogo.jpg" height="70" width="40%" style="margin-left:8px">
    //                       </div> 
    $paymenthtml .= '<div class="row">';
    $paymenthtml .= '<div class="d-flex justify-content-space" style="padding: 0 55px 0 55px;">';
    $paymenthtml .= '<input type="hidden" value="' . $tongtien . '" id="hddtotal">';
    $paymenthtml .= '<div class="d-flex"><b>Tổng cộng:&nbsp;</b> <p id="totalpaid">' . number_format($tongtien, 0, ',', '.') . '.đ &nbsp;' . '</p><p id="totalchanged"></p></div>';
    $paymenthtml .= '<button type="button" style="width:100%;max-width:300px" onclick="pay()" id="redirect" class="btn btn-danger">Thanh toán ngay</button>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '<div id="paynoti">';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</div>';
    $paymenthtml .= '</form>';
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
