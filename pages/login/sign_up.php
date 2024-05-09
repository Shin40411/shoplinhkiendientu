<?php
  if(isset($_POST['email']) && isset($_POST['matkhau'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $matkhau = md5($_POST['matkhau']);
    $con=mysqli_connect("localhost","root","","eshop");

    $checktrungmail = mysqli_query($con, "SELECT * FROM signup WHERE phone = '".$email."'");
    $countrow = mysqli_num_rows($checktrungmail);
    if ($countrow > 0){
      echo json_encode(array("success" => false, "message" => "Email đăng ký đã tồn tại"));
    }else{
      $sql_dangky = mysqli_query($con,"INSERT INTO signup (name,phone,address,passwords) VALUE('".$tenkhachhang."','".$email."','".$diachi."','".$matkhau."')");
      if($sql_dangky){
        echo json_encode(array("success" => true));
      }else{
        echo json_encode(array("success" => false, "message" => "Đăng ký thất bại"));
      }
    }
  }
?>

