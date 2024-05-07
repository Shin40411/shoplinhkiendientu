<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../db/dbhelper.php');

$id = $name = '';
if(!empty($_POST)) {
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('"', '\\"', $name);
	}
	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	if(!empty($name)) {
		//luu vao database
		if($id == '') {
			$sql = 'insert into category_news(name_category) 
		    values ("'.$name.'")'
		    ;
		} else {
			$sql = 'update category_news set name_category = "'.$name.'" where id = '.$id;
		}
		
		    execute($sql);

		    header('Location: category.php');
		    die();
	}

}


if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from category_news where id = '.$id;
	$category_news = executeSingleResult($sql);
	if($category_news != null) {
		$name = $category_news['name_category'];
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
   Thêm/sửa danh mục bài viết
  </title>
	<div class="container" style="margin-top:110px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Danh Mục Bài Viết</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="name">Tên Danh Mục:</label>
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					  <input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
					</div>				
					<button class="btn btn-success">Lưu</button>
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