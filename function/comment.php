<?php
session_start();
require_once('../config/dbhelper.php');
$con = mysqli_connect("localhost", "root", "", "eshop");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $comment = $data['commentmess'];
    $id_product = $data['idproduct'];
    if (isset($_SESSION['dangky'])) {
        $account_id = mysqli_fetch_array($con->query("SELECT * FROM signup WHERE name='" . $_SESSION['dangky'] . "'"));
        $account_id = $account_id['id_signup'];
        $st1 = '0';
        $con->query("INSERT INTO comment(comments,id_account,id_product,status) VALUE ('" . $comment . "','" . $account_id . "','" . $id_product . "','" . $st1 . "')");
        echo json_encode(array('success' => true));
    }else {
		echo json_encode(array('success' => false, 'message' => 'Bạn phải đăng nhập để bình luận!'));
	}
}
?>