<?php
session_start();
require_once('../config/dbhelper.php');
if (isset($_POST['personalname']) && isset($_POST['personalemail']) && isset($_POST['personaladdress']) && isset($_POST['personalpassword'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
    $tenkhachhang = $_POST['personalname'];
    $email = $_POST['personalemail'];
    $diachi = $_POST['personaladdress'];
    $matkhau_hash = md5($_POST['personalpassword']);
    $matkhau = $_POST['personalpassword'];
    $con = mysqli_connect("localhost", "root", "", "eshop");

    $checktrungmail = mysqli_query($con, "SELECT * FROM signup WHERE phone = '" . $email . "' AND id_signup != '" . $id_khachhang . "'");
    $countrow = mysqli_num_rows($checktrungmail);
    if ($countrow > 0) {
        echo json_encode(array("success" => false, "message" => "Email đăng ký đã tồn tại"));
    } else {
        $sql_dangky = mysqli_query($con, "UPDATE signup 
                                        SET name = '" . $tenkhachhang . "', 
                                            phone = '" . $email . "', 
                                            address = '" . $diachi . "', 
                                            passwords = '" . $matkhau_hash . "', 
                                            matkhau = '" . $matkhau . "' 
                                        WHERE id_signup = '" . $id_khachhang . "'");
        if ($sql_dangky) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "message" => "Cập nhật thất bại"));
        }
    }
}
?>