<?php
session_start();
// if (isset($_GET['vnp_Amount'])) {

//   $vnp_Amount = $_GET['vnp_Amount'];
//   $vnp_BankCode = $_GET['vnp_BankCode'];
//   $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
//   $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
//   $vnp_PayDate = $_GET['vnp_PayDate'];
//   $vnp_TmnCode = $_GET['vnp_TmnCode'];
//   $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
//   $vnp_CardType = $_GET['vnp_CardType'];
//   $code_cart = $_SESSION['code_cart'];

//   //insert vnpay vao database
//   $con = mysqli_connect("localhost", "root", "", "eshop");
//   $insert_vnpay = "INSERT INTO vnpay(vnp_amount,code_orders,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno) VALUE('" . $vnp_Amount . "','" . $code_cart . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "','" . $vnp_TransactionNo . "')";
//   $insert_cart = mysqli_query($con, $insert_vnpay);
//   if ($insert_cart) {
//     echo "<script>alert('Thanh toán bằng Vnpay thành công! cảm ơn bạn đã mua hàng.');</script>";
//   } else {
//     echo "<script>alert('Giao dịch thất bại');</script>";
//   }
//   if ($insert_cart) {
//     unset($_SESSION['cart']);
//   }
// }
$orders = array();
$id_khachhang = $_SESSION['id_khachhang'];
$code_carts = $_SESSION['code_cart'];
$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_lietke_dh = mysqli_query($con, "SELECT * FROM orders,signup WHERE orders.id_khachhang=signup.id_signup AND orders.id_khachhang='$id_khachhang' AND orders.code_order='$code_carts' ORDER BY orders.id ASC");
$index = 1;
while ($item = mysqli_fetch_array($sql_lietke_dh)) {
  $order_html = '<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                                <tr>
                                    <td>' . $item['code_order'] . '</td>
                                    <td>' . $item['name'] . '</td>
                                    <td>' . $item['phone'] . '</td>
                                    <td>' . $item['order_payment'] . '</td>
                                    <td>' . ($item['status'] == 1 ? 'Chưa xử lý' : 'Đã xem') . '</td>
                                    <td>' . $item['order_date'] . '</td>
                                    <td><a href="orderprint.php?action=xemdonhang&code=' . $item['code_order'] . '" target="_blank"><i class="fa fa-print" style="font-size: 22px;vertical-align: middle;"></i></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
    $orders[] = array( 
      'renderorder' => $order_html
    );
}
echo json_encode($orders);
?>