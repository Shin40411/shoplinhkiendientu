<?php
require('function.php');
if (!isset($_SESSION['login'])) {
	header('Location: sign-in.php');
}
?>
<?php
require_once('../../../config/dbhelper.php');
?>
<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<title>
		Sửa bài viết
	</title>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php
				$con = mysqli_connect("localhost", "root", "", "eshop");
				$sql_sua_bv = mysqli_query($con, "SELECT * FROM news WHERE id_baiviet='$_GET[idbaiviet]' LIMIT 1");
				?>
				<h2 class="text-center">Sửa Bài Viết</h2>
			</div>
			<div class="panel-body">
				<?php
				while ($row = mysqli_fetch_array($sql_sua_bv)) {
				?>
					<form method="post" action="control.php?idbaiviet=<?php echo $row['id_baiviet'] ?>" enctype="multipart/form-data">
						<div class="form-group">
							<label for="tenbaiviet">Tên Bài viết:</label>
							<input type="text" name="id" hidden="true">
							<input required="true" type="text" value="<?php echo $row['tenbaiviet'] ?>" class="form-control" name="tenbaiviet">
						</div>
						<div class="form-group">
							<label for="hinhanh">Thumbnail:</label>
							<input type="file" name="hinhanh">
							<img src="uploads/<?php echo $row['hinhanh'] ?>" width="150px">
						</div>
						<div class="form-group">
							<label for="tomtat">Tóm tắt:</label>
							<textarea class="form-control" style="resize: none" rows="5" name="tomtat"><?php echo $row['tomtat'] ?></textarea>
						</div>
						<div class="form-group">
							<label for="noidung">Nội dung:</label>
							<textarea class="form-control" style="resize: none" rows="5" name="noidung"><?php echo  $row['noidung'] ?></textarea>
						</div>
						<div class="form-group">
							<label for="danhmuc">Chọn Danh Mục:</label>
							<select class="form-control" name="danhmuc">
								<option>-- Lựa chọn danh mục --</option>
								<?php
								$con = mysqli_connect("localhost", "root", "", "eshop");
								$sql_danhmuc = mysqli_query($con, "SELECT * FROM category_news ORDER BY id DESC");
								while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
									if ($row_danhmuc['id'] == $row['id_danhmuc']) {
								?>
										<option selected value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name_category'] ?></option>
									<?php
									} else {
									?>
										<option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name_category'] ?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<input type="submit" name="suabaiviet" value="Lưu" style="width:10%; height:40px;">
					</form>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<!-- script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>

	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

	<script>
		CKEDITOR.replace('tomtat');
	</script>

	<script>
		CKEDITOR.replace('noidung');
	</script>

	</body>
	<?php
	include('footer.php');
	?>

</html>