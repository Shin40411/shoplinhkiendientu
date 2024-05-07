<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../db/dbhelper.php');
$id_admin = $username = $name = $role = '';
if(!empty($_POST)) {
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$username = str_replace('"', '\\"', $username);
	}
	if(isset($_POST['id_admin'])) {
		$id_admin = $_POST['id_admin'];
	}
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('"', '\\"', $name);
	}
	if(isset($_POST['role'])) {
		$role = $_POST['role'];
		$role = str_replace('"', '\\"', $role);
	}
		//luu vao database
		if($id_admin == '') {
			$sql = 'insert into admin(username, fullname, permission) values ("'.$username.'", "'.$name.'", "'.$role.'")';
		} else {
			$sql = 'update admin set username = "'.$username.'", fullname = "'.$name.'", permission = "'. $role.'" where id_admin = '.$id_admin;
		}
		
		    execute($sql);

		    header("Location: member.php");
		    die();
	}



if(isset($_GET['id_admin'])) {
	$id_admin = $_GET['id_admin'];
	$sql = 'select * from admin where id_admin = '.$id_admin;
	$admin = executeSingleResult($sql);
	if($admin != null) {
		$username   = $admin['username'];
		$name       = $admin['fullname'];
		$role 			= $admin['permission'];
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
   Sửa thành viên
  </title>
	<div class="container" style="margin-top:80px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Sửa thành viên</h2>
			</div>
			<div class="panel-body">
				<form action="" method="POST" class="text-start">
                  <div class="form-group">  
                    <label for="username">Tên Tài Khoản:</label>   
                      <input type="text" name="id_admin" value="<?=$id_admin?>" hidden="true">        
                    <input type="text" placeholder="Tạo tên tài khoản" id="username" name="username" value="<?=$username?>"autocomplete="OFF" autocomplete="off" class="form-control">
                  </div>
                   <label for="name">Họ tên:</label>       
                  <div class="form-group">                 
                    <input type="text" placeholder="Tạo họ tên" id="name" name="name" value="<?=$name?>" autocomplete="OFF" class="form-control">
                  </div>
                  
                  <div class="form-group">
					  <label for="quantity">Chọn vai trò (1: Quản lý, 2: Nhân viên):</label>					 
					  <input type="number" id="quantity" name="role" min="1" max="2" value="<?=$role?>">
					</div>	
                  <div class="text-center">
                    <button class="btn bg-gradient-primary my-4" type="submit">Lưu</button>
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