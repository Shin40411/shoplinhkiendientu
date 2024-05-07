<?php
session_start();
include('../config/dbhelper.php');
$products = array();

//themsoluong
if (isset($_GET['cong'])) {
	$id = $_GET['cong'];
	foreach ($_SESSION['cart'] as $cart_item) {
		if ($cart_item['id'] != $id) {
			$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			$_SESSION['cart'] = $products;
		} else {
			$tangsoluong = $cart_item['soluong'] + 1;
			if ($cart_item['soluong'] <= 9) {

				$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong, 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			} else {
				$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			}
			$_SESSION['cart'] = $products;
		}
	}
	echo json_encode($_SESSION['cart']);
}
//trusoluong
if (isset($_GET['tru'])) {
	$id = $_GET['tru'];
	foreach ($_SESSION['cart'] as $cart_item) {
		if ($cart_item['id'] != $id) {
			$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			$_SESSION['cart'] = $products;
		} else {
			$tangsoluong = $cart_item['soluong'] - 1;
			if ($cart_item['soluong'] > 1) {

				$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong, 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			} else {
				$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
			}
			$_SESSION['cart'] = $products;
		}
	}
	echo json_encode($_SESSION['cart']);
}
//xoa
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
	$id = $_GET['xoa'];
	$success = false;
	foreach ($_SESSION['cart'] as $cart_item) {
		if ($cart_item['id'] != $id) {
			$products[] = array('title' => $cart_item['title'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'price' => $cart_item['price'], 'masp' => $cart_item['id'], 'thumbnail' => $cart_item['thumbnail']);
		} else {
			$success = true;
		}
		$_SESSION['cart'] = $products;
	}
	echo json_encode(array('success' => $success));
}
//xoatatca
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
	$success = false;
	try{
		unset($_SESSION['cart']);
		$success = true;
		echo json_encode(array('success' => $success));
	}catch (Exception $ex){
		echo json_encode(array('success' => $success));
	}
}
//laygiohang
if (isset($_GET['getCartSummary'])) {
	$cart_html = '';
	$i = 0;
	$tongtien = 0;
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
		foreach ($cart as $cart_item) {
			$thanhtien = $cart_item['soluong'] * $cart_item['price'];
			$tongtien += $thanhtien;
			$i++;
			$cart_html .= '<tr>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center">' . $i . '</td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center"><p>' . $cart_item['title'] . '</p></td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center">';
			$cart_html .= '<a href="javascript:void(0);" id="addcount" class="increasenumber" style="font-size:unset;padding:5px" onclick="updateCart(' . $cart_item['id'] . ', \'cong\')"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>';
			$cart_html .= $cart_item['soluong'];
			$cart_html .= '<a href="javascript:void(0);" id="minuscount" class="decreasenumber" style="font-size:unset;padding:5px" onclick="updateCart(' . $cart_item['id'] . ', \'tru\')"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>';
			$cart_html .= '</td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center">' . number_format($cart_item['price'], 0, ',', '.') . 'vnđ</td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center">' . $cart_item['id'] . '</td>';
			$cart_html .= '<td style="vertical-align: middle;"><img class="img img-responsive" width="100%" src="' . 'Admin/template/pages/uploads/' . $cart_item['thumbnail'] . '"></td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center">' . number_format($thanhtien, 0, ',', '.') . '.đ</td>';
			$cart_html .= '<td style="vertical-align: middle; text-align:center"><a class="removeitem h5" href="javascript:void(0);" onclick="removeFromCart(' . $cart_item['id'] . ')"><i class="fa fa-trash"></i></a></td>';
			$cart_html .= '</tr>';
		}
		$cart_html .= '<tr>';
		$cart_html .= '<td colspan="8">';
		$cart_html .= '<p style="float: left;margin-top: 8px;"><b>Tổng cộng:</b> ' . number_format($tongtien, 0, ',', '.') . '.đ' . ' </p>';
		$cart_html .= '<p style="float: right;margin-top: 9px;"><a class="removeitems h5" href="javascript:void(0);" onclick="removeAllFromCart()"><i class="fa fa-trash"></i> Xóa tất cả</a></p>';
		$cart_html .= '<div style="clear: both;"></div>';
		$cart_html .= '<a style="font-size:unset" style="width:25%" id="changeStep" data-keyword="giaohang" onclick="shipping()" href="javascript:void(0);"><button class="btn btn-success">Thanh toán</button></a>';
		$cart_html .= '</td>';
		$cart_html .= '</tr>';
	}

	$cartSummary = array(
		'number' => $i++,
		'total' => $tongtien,
		'cartbody' => $cart_html
	);
	echo json_encode($cartSummary);
}
//themgiohang
if (isset($_POST['themgiohang'])) {
	//session_destroy();
	$id = $_GET['id'];
	$soluong = 1;
	$sql = "SELECT * FROM product WHERE id ='" . $id . "' LIMIT 1";
	$product = executeSingleResult($sql);
	if ($product) {
		$new_product = array(
			'title' => $product['title'],
			'id' => $id,
			'soluong' => $soluong,
			'price' => $product['price'],
			'masp' => $id,
			'thumbnail' => $product['thumbnail']
		);
		//kiem tra session gio hang ton tai
		if (isset($_SESSION['cart'])) {
			$found = false;
			foreach ($_SESSION['cart'] as &$cart_item) {
				if ($cart_item['id'] == $id) {
					$cart_item['soluong'] += 1;
					$found = true;
					break;
				}
			}
			if (!$found) {
				$_SESSION['cart'][] = $new_product;
			}
		} else {
			$_SESSION['cart'] = array($new_product);
		}
		echo json_encode(array('success' => true));
	} else {
		echo json_encode(array('success' => false, 'message' => 'Product not found'));
	}
}

