<?php
session_start();
require_once('db/dbhelper.php');
require('mail/sendmail.php');
require('Carbon/autoload.php');
require_once('config_vnpay.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

if (isset($_SESSION['dangky'])) {
	if (isset($_SESSION['cart'])) {
		$now = Carbon::now('Asia/Ho_Chi_Minh');
		$name = $_SESSION['id_khachhang'];
		$code_order = rand(0, 9999);
		$order_payment = $_POST['payment'];
		//lấy id thông tin giao hàng
		$id_dangky =  $_SESSION['id_khachhang'];
		$con = mysqli_connect("localhost", "root", "", "eshop");
		$sql_getvanchuyen = mysqli_query($con, "SELECT * FROM shipping WHERE id_dangky='$id_dangky' LIMIT 1");
		$row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
		$id_shipping = $row_getvanchuyen['id_shipping'];
		$tongtien = 0;
		foreach ($_SESSION['cart'] as $key => $value) {
			$thanhtien = $value['soluong'] * $value['price'];
			$tongtien = $tongtien + $thanhtien;
		}

		// TT tien mat chuyen khoan
		if ($order_payment == 'Tiền mặt' || $order_payment == 'Chuyển khoản ATM') {
			//insert order
			$_SESSION['code_cart'] = $code_order;
			$con = mysqli_connect("localhost", "root", "", "eshop");
			$insert_cart = mysqli_query($con, "INSERT INTO orders(id_khachhang,code_order,status,order_date,order_payment,order_shipping) VALUE ('" . $name . "','" . $code_order . "',1,'" . $now . "','" . $order_payment . "','" . $id_shipping . "')");
			foreach ($_SESSION['cart'] as $key => $value) {
				$id_sanpham = $value['id'];
				$soluong = $value['soluong'];
				$insert_order_details = "INSERT INTO order_detail(product_id,code_order,soluongmua) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
				mysqli_query($con, $insert_order_details);
			}
			echo "<script>alert('Thanh toán thành công! cảm ơn bạn đã mua hàng..');</script>";
			echo "<script>setTimeout(\"location.href = 'orderdetail.php';\",1500);</script>";
			//thanh toan vnpay
		} elseif ($order_payment == 'vnpay') {
			$vnp_TxnRef = $code_order;
			$vnp_OrderInfo = 'Thanh toán hóa đơn đặt tại web';
			$vnp_OrderType = 'billpayment';
			$vnp_Amount = $tongtien * 100;
			$vnp_Locale = 'vn';
			$vnp_BankCode = 'NCB';
			$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
			//Add Params of 2.0.1 Version
			$vnp_ExpireDate = $expire;

			$inputData = array(
				"vnp_Version" => "2.1.0",
				"vnp_TmnCode" => $vnp_TmnCode,
				"vnp_Amount" => $vnp_Amount,
				"vnp_Command" => "pay",
				"vnp_CreateDate" => date('YmdHis'),
				"vnp_CurrCode" => "VND",
				"vnp_IpAddr" => $vnp_IpAddr,
				"vnp_Locale" => $vnp_Locale,
				"vnp_OrderInfo" => $vnp_OrderInfo,
				"vnp_OrderType" => $vnp_OrderType,
				"vnp_ReturnUrl" => $vnp_Returnurl,
				"vnp_TxnRef" => $vnp_TxnRef,
				"vnp_ExpireDate" => $vnp_ExpireDate
			);

			if (isset($vnp_BankCode) && $vnp_BankCode != "") {
				$inputData['vnp_BankCode'] = $vnp_BankCode;
			}
			//var_dump($inputData);
			ksort($inputData);
			$query = "";
			$i = 0;
			$hashdata = "";
			foreach ($inputData as $key => $value) {
				if ($i == 1) {
					$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
				} else {
					$hashdata .= urlencode($key) . "=" . urlencode($value);
					$i = 1;
				}
				$query .= urlencode($key) . "=" . urlencode($value) . '&';
			}

			$vnp_Url = $vnp_Url . "?" . $query;
			if (isset($vnp_HashSecret)) {
				$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
				$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
			}
			$returnData = array(
				'code' => '00', 'message' => 'success', 'data' => $vnp_Url
			);
			if (isset($_POST['redirect'])) {
				$_SESSION['code_cart'] = $code_order;
				$con = mysqli_connect("localhost", "root", "", "eshop");
				$insert_cart = mysqli_query($con, "INSERT INTO orders(id_khachhang,code_order,status,order_date,order_payment,order_shipping) VALUE ('" . $name . "','" . $code_order . "',1,'" . $now . "','" . $order_payment . "','" . $id_shipping . "')");
				foreach ($_SESSION['cart'] as $key => $value) {
					$id_sanpham = $value['id'];
					$soluong = $value['soluong'];
					$insert_order_details = "INSERT INTO order_detail(product_id,code_order,soluongmua) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
					mysqli_query($con, $insert_order_details);
				}
				header('Location: ' . $vnp_Url);
				die();
			} else {
				echo json_encode($returnData);
			}
		}
		if ($insert_cart) {
			// gui mail
			$tieude = "Đặt hàng website shoptraicay.vn thành công!";
			$noidung = "<h4>Tổng tiền của đơn hàng: " . number_format($tongtien, 0, ',', '.') . "đ</h4>";
			$noidung .= "<h4>Đơn hàng đặt bao gồm:</h4>";
			foreach ($_SESSION['cart'] as $key => $val) {
				$thanhtien = $val['soluong'] * $val['price'];
				$noidung .= "<ul style='border:1px solid blue;margin:10px;'>
				<li>Tên sản phẩm: " . $val['title'] . "</li>
				<li>Mã sản phẩm: " . $val['id'] . "</li>
				<li>Giá: " . number_format($val['price'], 0, ',', '.') . "đ</li>
				<li>Số lượng: " . $val['soluong'] . "</li>
				<li>Thành tiền: " . number_format($thanhtien, 0, ',', '.') . "đ</li>
				</ul>";
			}
			$maildathang = $_SESSION['phone'];
			$mail = new Mailer();
			$mail->dathangmail($tieude, $noidung, $maildathang);
			unset($_SESSION['cart']);
		}
	} else {
		echo "<script>alert('Có lỗi xảy ra');</script>";
		echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
	}
} else {
	echo "<script>alert('Có lỗi xảy ra');</script>";
	echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
}
