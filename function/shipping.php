<?php
session_start();

$response = array();
$con = mysqli_connect("localhost", "root", "", "eshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents("php://input"), true);
  $fullname = $data['fullname'];
  $phone_number = $data['phone_number'];
  $addresses = $data['addresses'];
  $note = $data['note'];
  $action = $data['action'];
  $id_dangky =  $_SESSION['id_khachhang'];
  if ($action == "add") {
    $sql_add_vanchuyen = mysqli_query(
      $con,
      "INSERT INTO shipping(fullname,phone_number,addresses,note,id_dangky) VALUES('$fullname','$phone_number','$addresses','$note','$id_dangky')"
    );
  } else if ($action == "update") {
    $sql_update_vanchuyen = mysqli_query(
      $con,
      "UPDATE shipping SET fullname='$fullname',phone_number='$phone_number',addresses='$addresses',note='$note',id_dangky='$id_dangky' WHERE id_dangky='$id_dangky'"
    );
  }
}
if (isset($_SESSION['id_khachhang'])) {
  $id_dangky = $_SESSION['id_khachhang'];
  $sql_getvanchuyen = mysqli_query($con, "SELECT * FROM shipping WHERE id_dangky='$id_dangky' LIMIT 1");
  $count = mysqli_num_rows($sql_getvanchuyen);
  if ($count > 0) {
    $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
    $shippinghtml = '';
    if (isset($row_getvanchuyen)) {
      $shippinghtml .= '<hr>';
      $shippinghtml .= '<div class="container-fluid">';
      $shippinghtml .= ' <div class="row">';
      $shippinghtml .= '   <div id="main-products">';
      $shippinghtml .= '     <div class="main-detail">';
      $shippinghtml .= '       <h3 style="text-align: center;">Thông tin thanh toán</h3>';
      $shippinghtml .= '       <div class="container-fluid">';
      $shippinghtml .= '         <div class="row">';
      $shippinghtml .= '           <div class="col-md-12">';
      $shippinghtml .= '             <div class="clear" style="margin-bottom:1%"></div>';
      $shippinghtml .= '             <div class="row">';
      $shippinghtml .= '               <div class="col-md-12">';
      $shippinghtml .= '                 <form action="" autocomplete="off" method="POST">';
      $shippinghtml .= '                   <div class="form-group">';
      $shippinghtml .= '                     <label for="email">Họ và tên:</label>';
      $shippinghtml .= '                     <input type="text" id="fullname"  class="form-control" value="' . $row_getvanchuyen['fullname'] . '" placeholder="Họ tên người nhận...">';
      $shippinghtml .= '                   </div>';
      $shippinghtml .= '                   <div class="form-group">';
      $shippinghtml .= '                     <label for="email">Số điện thoại:</label>';
      $shippinghtml .= '                     <input type="text" id="phone_number"  class="form-control" value="' . $row_getvanchuyen['phone_number'] . '" placeholder="SĐT để liên hệ...">';
      $shippinghtml .= '                   </div>';
      $shippinghtml .= '                   <div class="form-group">';
      $shippinghtml .= '                     <label for="email">Địa chỉ:</label>';
      $shippinghtml .= '                     <input type="text" id="addresses"  class="form-control" value="' . $row_getvanchuyen['addresses'] . '" placeholder="Địa chỉ người nhận...">';
      $shippinghtml .= '                   </div>';
      $shippinghtml .= '                   <div class="form-group">';
      $shippinghtml .= '                     <label for="email">Ghi chú:</label>';
      $shippinghtml .= '                     <textarea type="text" id="note" class="form-control" placeholder="Ghi chú khi đặt hàng...">' . $row_getvanchuyen['note'] . '</textarea>';
      $shippinghtml .= '                   </div>';
      if ($row_getvanchuyen['fullname'] == '' && $row_getvanchuyen['phone_number'] == '') {
        $shippinghtml .= '                 <div id="submitbutt" >  <button type="button" style="width:25%;float:left" onclick="updateShipping(\'add\')" id="updatevanchuyen" class="btn btn-success">Thêm thông tin</button> <button type="button" id="paystep" onclick="nextpaystep()" style="width:25%;float:right" class="btn btn-success">Bước kế tiếp</button> </div>';
      } else {
        $shippinghtml .= '                 <div id="submitbutt">  <button type="button" style="width:25%;float:left" onclick="updateShipping(\'update\')" id="updatevanchuyen" class="btn btn-primary">Cập nhật</button> <button type="button" id="paystep" onclick="nextpaystep()" style="width:25%;float:right" class="btn btn-success">Bước kế tiếp</button></div>';
      }
      $shippinghtml .= '                 </form>';
      $shippinghtml .= '               </div>';
      $shippinghtml .= '             </div>';
      $shippinghtml .= '           </div>';
      $shippinghtml .= '         </div>';
      $shippinghtml .= '       </div>';
      $shippinghtml .= '     </div>';
      $shippinghtml .= '<div style="margin-top:10px;" id="notification"></div>';
      $shippinghtml .= '   </div>';
      $shippinghtml .= ' </div>';
      $shippinghtml .= '</div>';
    }
    $response = array(
      'shippinghtml' => $shippinghtml
    );
  } else {
    $shippinghtml = '';
    $shippinghtml .= '<hr>';
    $shippinghtml .= '<div class="container-fluid">';
    $shippinghtml .= ' <div class="row">';
    $shippinghtml .= '   <div id="main-products">';
    $shippinghtml .= '     <div class="main-detail">';
    $shippinghtml .= '       <h3 style="text-align: center;">Thông tin thanh toán</h3>';
    $shippinghtml .= '       <div class="container-fluid">';
    $shippinghtml .= '         <div class="row">';
    $shippinghtml .= '           <div class="col-md-12">';
    $shippinghtml .= '             <div class="clear" style="margin-bottom:1%"></div>';
    $shippinghtml .= '             <div class="row">';
    $shippinghtml .= '               <div class="col-md-12">';
    $shippinghtml .= '                 <form action="" autocomplete="off" method="POST">';
    $shippinghtml .= '                   <div class="form-group">';
    $shippinghtml .= '                     <label for="email">Họ và tên:</label>';
    $shippinghtml .= '                     <input type="text" id="fullname"  class="form-control" placeholder="Họ tên người nhận...">';
    $shippinghtml .= '                   </div>';
    $shippinghtml .= '                   <div class="form-group">';
    $shippinghtml .= '                     <label for="email">Số điện thoại:</label>';
    $shippinghtml .= '                     <input type="text" id="phone_number"  class="form-control" placeholder="SĐT để liên hệ...">';
    $shippinghtml .= '                   </div>';
    $shippinghtml .= '                   <div class="form-group">';
    $shippinghtml .= '                     <label for="email">Địa chỉ:</label>';
    $shippinghtml .= '                     <input type="text" id="addresses"  class="form-control"  placeholder="Địa chỉ người nhận...">';
    $shippinghtml .= '                   </div>';
    $shippinghtml .= '                   <div class="form-group">';
    $shippinghtml .= '                     <label for="email">Ghi chú:</label>';
    $shippinghtml .= '                     <textarea type="text" id="note" class="form-control" placeholder="Ghi chú khi đặt hàng..."></textarea>';
    $shippinghtml .= '                   </div>';
    $shippinghtml .= '                 <div id="submitbutt" >  <button type="button" style="width:25%;float:left" onclick="updateShipping(\'add\')" id="updatevanchuyen" class="btn btn-success">Thêm thông tin</button> </div>';
    $shippinghtml .= '                 </form>';
    $shippinghtml .= '               </div>';
    $shippinghtml .= '             </div>';
    $shippinghtml .= '           </div>';
    $shippinghtml .= '         </div>';
    $shippinghtml .= '       </div>';
    $shippinghtml .= '     </div>';
    $shippinghtml .= '<div style="margin-top:10px;" id="notification"></div>';
    $shippinghtml .= '   </div>';
    $shippinghtml .= ' </div>';
    $shippinghtml .= '</div>';
  }
  $response = array(
    'shippinghtml' => $shippinghtml
  );
}

echo json_encode($response);
