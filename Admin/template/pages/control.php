<?php
include('../../../config/dbhelper.php');

$tenbaiviet = $_POST['tenbaiviet'];
//xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;
$con = mysqli_connect("localhost", "root", "", "eshop");


$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];


if (isset($_POST['thembaiviet'])) {
	//them
	$sql_them = mysqli_query($con, "INSERT INTO news(tenbaiviet,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE('" . $tenbaiviet . "','" . $hinhanh . "','" . $tomtat . "','" . $noidung . "','" . $tinhtrang . "','" . $danhmuc . "')");
	move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
	header('Location:news.php');
} elseif (isset($_POST['suabaiviet'])) {
	//sua
	if (!empty($_FILES['hinhanh']['name'])) {

		move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
		$sql_update = mysqli_query($con, "UPDATE news SET tenbaiviet='" . $tenbaiviet . "',hinhanh='" . $hinhanh . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',id_danhmuc='" . $danhmuc . "' WHERE id_baiviet='$_GET[idbaiviet]'");
		//xoa hinh anh cu
		$sql = mysqli_query($con, "SELECT * FROM news WHERE id_baiviet = '$_GET[idbaiviet]' LIMIT 1");
		while ($row = mysqli_fetch_array($sql, $con)) {
			unlink('uploads/' . $row['hinhanh']);
		}
	} else {
		$sql_update = mysqli_query($con, "UPDATE news SET tenbaiviet='" . $tenbaiviet . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',id_danhmuc='" . $danhmuc . "' WHERE id_baiviet='$_GET[idbaiviet]'");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
