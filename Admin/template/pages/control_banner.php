<?php
include('../../../config/dbhelper.php');

//xuly hinh anh 1
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time().'_'.$hinhanh;
//xuly hinh anh 2
$hinhanh2 = $_FILES['hinhanh2']['name'];
$hinhanh_tmp2 = $_FILES['hinhanh2']['tmp_name'];
$hinhanh2 = time().'_'.$hinhanh2;
//xuly hinh anh 3
$hinhanh3 = $_FILES['hinhanh3']['name'];
$hinhanh_tmp3 = $_FILES['hinhanh3']['tmp_name'];
$hinhanh3 = time().'_'.$hinhanh3;



if(isset($_POST['thembanner'])){
	//them
	$con=mysqli_connect("localhost","root","","eshop");
	$sql_them = mysqli_query($con,"INSERT INTO banner(hinhanh,hinhanh2,hinhanh3) VALUE('".$hinhanh."','".$hinhanh2."','".$hinhanh3."')");
	move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
	move_uploaded_file($hinhanh_tmp2,'uploads/'.$hinhanh2);
	move_uploaded_file($hinhanh_tmp3,'uploads/'.$hinhanh3);
	header('Location:Banner-slider.php');
}
elseif(isset($_POST['suabanner'])){
	//sua
	if(!empty($_FILES['hinhanh']['name'])){

		move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
		$con=mysqli_connect("localhost","root","","eshop");
		$sql_update = mysqli_query($con,"UPDATE banner SET hinhanh='".$hinhanh."' WHERE id='$_GET[id]'");
		//xoa hinh anh cu
		$con=mysqli_connect("localhost","root","","eshop");
		$sql = mysqli_query($con,"SELECT * FROM banner WHERE id = '$_GET[id]' LIMIT 1");
		while($row = mysqli_fetch_array($sql,$con)){
			unlink('uploads/'.$row['hinhanh']);

		}
	}

	if(!empty($_FILES['hinhanh2']['name'])){

		move_uploaded_file($hinhanh_tmp2,'uploads/'.$hinhanh2);

		$con=mysqli_connect("localhost","root","","eshop");
		$sql_update = mysqli_query($con,"UPDATE banner SET hinhanh2='".$hinhanh2."' WHERE id='$_GET[id]'");
		//xoa hinh anh cu
		$con=mysqli_connect("localhost","root","","eshop");
		$sql = mysqli_query($con,"SELECT * FROM banner WHERE id = '$_GET[id]' LIMIT 1");
		while($row = mysqli_fetch_array($sql,$con)){
		
			unlink('uploads/'.$row['hinhanh2']);
	
		}
	}

	if(!empty($_FILES['hinhanh3']['name'])){

		move_uploaded_file($hinhanh_tmp3,'uploads/'.$hinhanh3);
		$con=mysqli_connect("localhost","root","","eshop");
		$sql_update = mysqli_query($con,"UPDATE banner SET hinhanh3='".$hinhanh3."' WHERE id='$_GET[id]'");
		//xoa hinh anh cu
		$con=mysqli_connect("localhost","root","","eshop");
		$sql = mysqli_query($con,"SELECT * FROM banner WHERE id = '$_GET[id]' LIMIT 1");
		while($row = mysqli_fetch_array($sql,$con)){
			unlink('uploads/'.$row['hinhanh3']);
		}
	}
	header('Location:Banner-slider.php');
}
?>