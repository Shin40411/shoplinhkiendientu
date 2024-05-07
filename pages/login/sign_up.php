<?php
  if(isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $matkhau = md5($_POST['matkhau']);
    $con=mysqli_connect("localhost","root","","eshop");
    $sql_dangky = mysqli_query($con,"INSERT INTO signup (name,phone,address,passwords) VALUE('".$tenkhachhang."','".$dienthoai."','".$diachi."','".$matkhau."')");
    if($sql_dangky){
      $_SESSION['dangky'] = $tenkhachhang;
      $_SESSION['phone'] = $dienthoai;
      $_SESSION['id_khachhang'] = mysqli_insert_id($con);
      echo "<script>alert('Đăng ký thành công. Mời bạn đăng nhập lại');</script>";
      echo "<script>setTimeout(\"location.href = '../giohang.php';\",1500);</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Đăng ký thành viên</title>
<link rel="shortcut icon" type="image/png" href="Admin/assets/img/Free.png">
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}
form {
    border: 3px solid #f1f1f1;
    background-color: #fff5cc;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
h1 {
    text-align: center;
    font-family: cursive;
}

</style>
</head>
<body>

<h1>Đăng ký thành viên</h1>

<form action="" method="POST">
  <div class="imgcontainer">
    <img src="../img/istockphoto-515673754-612x612.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="hovaten"><b>Họ và tên</b></label>
    <input type="text"  name="hovaten" placeholder="Tên tài khoản..." required="">

    <label for="dienthoai"><b>Email</b></label>
    <input type="text"  name="dienthoai"  placeholder="Email của bạn..." required="">

    <label for="diachi"><b>Địa chỉ</b></label>
    <input type="text" name="diachi" placeholder="Địa chỉ của bạn..." required="">

    <label for="matkhau"><b>Mật khẩu</b></label>
    <input type="password" style="width: 100%;height:40px" name="matkhau" placeholder="Tạo mật khẩu..." required="">
        
    <button type="submit" name="dangky">Đăng ký</button>
  </div>
  <div class="container" style="background-color:#f1f1f1">
    <script>
  document.write('<a href="' + document.referrer + '"><button type="button" class="cancelbtn">Quay về</button></a>');
</script>
  </div>
</form>
</body>
</html>
