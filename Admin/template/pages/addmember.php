<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../config/dbhelper.php');
?>
<?php 
if (isset($_POST["signup"])) {
    //lấy thông tin từ các form bằng phương thức POST
    $username = $_POST["username"];
    $password = md5($_POST['password']);
    $name = $_POST["name"];
    $permission = $_POST["role"];
    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if ($username == "" || $password == "" || $name == "" || $permission == "" ) {
      echo "<script>alert('bạn vui lòng nhập đầy đủ thông tin.');</script>";
    }else{
       $con=mysqli_connect("localhost","root","","eshop");
      $sql = "INSERT INTO admin(username, password, fullname, permission) VALUES ( '$username', '$password', '$name','$permission' )";
      mysqli_query($con,$sql);
      header('Location: member.php');
    }
  }
?>
<?php 
include ('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
   Thêm thành viên
  </title>
	<div class="container" style="margin-top:80px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm thành viên</h2>
			</div>
			<div class="panel-body">
				<form action="" method="POST" class="text-start">
                  <div class="form-group">  
                    <label for="username">Tên Tài Khoản:</label>           
                    <input type="text" placeholder="Tạo tên tài khoản" id="username" name="username" autocomplete="OFF" autocomplete="off" class="form-control">
                  </div>
                   <label for="name">Họ tên:</label>       
                  <div class="form-group">                 
                    <input type="text" placeholder="Tạo họ tên" id="name" name="name" autocomplete="OFF" class="form-control">
                  </div>
                   <label for="password">Mật khẩu:</label>       
                  <div class="form-group">                 
                    <input type="password" placeholder="Tạo mật khẩu" id="password" autocomplete="OFF" name="password" class="form-control">
                  </div>
                  <div class="form-group">
					  <label for="role">Chọn vai trò(1: Quản lý, 2: Nhân viên):</label>					 
					  <input type="number" required="trues" id="role" name="role" min="1" max="2" value="1">
					</div>	
                  <div class="text-center">
                    <button class="btn bg-gradient-primary my-4" type="submit" name="signup">Lưu</button>
                  </div>
                </form>
			</div>						
		</div>
	</div>
  </div>
</body>
<?php 
include ('footer.php');
?>
</html>