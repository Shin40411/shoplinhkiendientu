<?php
$con=mysqli_connect("localhost","root","","eshop");
// Check connection
if (!$con) {
die("Connection failed: " . mysqli_connect_error());
}
// Kiểm tra button
if(isset($_POST['upload'])){

// Dung lượng cho phép upload lên
$maxsize = 104857600; // 5MB

// Lưu vào thư mục trên máy tính
$name = $_FILES['file']['name'];
$target_dir = "video/";
$target_file = $target_dir . $_FILES["file"]["name"];

$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Định dạng mở rộng
$extensions_arr = array("mp4","avi","3gp","mov","mpeg");

if( in_array($videoFileType,$extensions_arr) ){

// Điều kiện kiểm tra dung lượng file
if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
echo "File quá lớn! Vui lòng upload file nhỏ hơn!";
}else{
// Tiếp hành Upload
if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
// Ghi dữ liệu vào Database
$con=mysqli_connect("localhost","root","","eshop");
$query = mysqli_query($con,"INSERT INTO videoqc(name,location) VALUES('".$name."','".$target_file."')");
if($query)
{
echo "Upload thành công.";
}
}
}

}else{
echo "Lỗi định dạng";
}

}
?>