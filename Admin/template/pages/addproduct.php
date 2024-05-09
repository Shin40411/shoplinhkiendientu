<?php
require('function.php');
if (!isset($_SESSION['login'])) {
	header('Location: sign-in.php');
}
?>
<?php
require_once('../../../config/dbhelper.php');

$id = $price = $title = $thumbnail = $status = $content = $id_category = '';
if (!empty($_POST)) {
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$title = str_replace('"', '\\"', $title);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"', '\\"', $price);
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}

	if (isset($_FILES['hinhanh']['name'])) {
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$hinhanh_extension = strtolower(pathinfo($hinhanh_name, PATHINFO_EXTENSION));
		$upload_directory = 'uploads/';

		if (file_exists($upload_directory . $hinhanh)) {
			unlink($upload_directory . $hinhanh);
		}
		$hinhanhname = $hinhanh . '.' . $hinhanh_extension;

		move_uploaded_file($hinhanh_tmp, $upload_directory . $hinhanh);
		$hinhanhname = rtrim($hinhanhname, '.');
	}else{
		$hinhanh = null;
	}

	if (isset($_POST['status'])) {
		$status = $_POST['status'];
		$status = str_replace('"', '\\"', $status);
	}
	if (isset($_POST['content'])) {
		$content = $_POST['content'];
		$content = str_replace('"', '\\"', $content);
	}
	if (isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
		$id_category = str_replace('"', '\\"', $id_category);
	}

	if (!empty($title)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//luu vao database
		if ($id == '') {
			$thumbnail_value = ($hinhanhname != '') ? $hinhanhname :  '';
			$sql = 'insert into product (title, thumbnail, status_pro, price, content, id_category, created_at, updated_at) 
        		values ("' . $title . '", "' . $thumbnail_value . '", "' . $status . '", "' . $price . '",
                "' . $content . '", "' . $id_category . '", "' . $created_at . '", "' . $updated_at . '")';
		} else {

			$thumbnail_value;
			if ($hinhanhname != '') {
				$thumbnail_value = $hinhanhname;
			}else{
				$sqlthumb = 'select thumbnail from product where id = ' . $id;
				$getoldthumb = executeSingleResult($sqlthumb);
				$thumbnail_value = $getoldthumb['thumbnail'];
			}

			$sql = 'update product set title = 
			"' . $title . '", updated_at = "' . $updated_at . '", thumbnail = "' . $thumbnail_value . '",
			 status_pro = "' . $status . '", price = "' . $price . '", content = "' . $content . '", id_category = "' . $id_category . '" where id = ' . $id;
		}

		execute($sql);

		header('Location: product.php');
		die();
	}
}


if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from product where id = ' . $id;
	$product = executeSingleResult($sql);
	if ($product != null) {
		$title       = $product['title'];
		$price       = $product['price'];
		$thumbnail   = $product['thumbnail'];
		$status 		 = $product['status_pro'];
		$id_category = $product['id_category'];
		$content     = $product['content'];
	}
}
?>

<?php
include('header.php');
?>

<title>
	Thêm/sửa sản phẩm
</title>

<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Tên Sản Phẩm:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
					</div>
					<div class="form-group">
						<label for="price">Chọn Danh Mục:</label>
						<select class="form-control" name="id_category" id="id_category">
							<option>-- Lựa chọn danh mục --</option>
							<?php
							$sql = 'select * from category';
							$categoryList = executeResult($sql);

							foreach ($categoryList as $item) {
								if ($item['id'] == $id_category) {
									echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
								} else {
									echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Giá Bán:</label>
						<input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
					</div>
					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<div class="d-flex">
							<!-- &nbsp;<label>Nhập url:&nbsp;</label> <input type="radio" onclick="showhideinput('url')" id="typeurl" checked value="URL"> -->
							<!-- &nbsp;<label>Nhập file:&nbsp;</label> <input type="radio" onclick="showhideinput('file')" id="typefile" value="File"> -->
						</div>
						<input type="text" style="display: none;" class="form-control" id="thumbnail" name="thumbnail" value=""  />
						<input type="file" id="uploadFile" name="hinhanh" />
						<img src="<?= 'uploads/' . $thumbnail ?>" style="max-width: 200px;margin-left: 400px;margin-top: 25px;" id="img_thumbnail">
					</div>

					<div class="form-group">
						<label for="status">Chọn trạng thái(0: Hàng hot, 1: Hàng bình thường):</label>
						<input type="number" required="trues" id="status" name="status" min="0" max="1" value="<?= $status ?>">
					</div>

					<div class="form-group">
						<label for="content">Nội dung:</label>
						<textarea class="form-control" style="resize: none" rows="5" name="content"><?= $content ?></textarea>
					</div>
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>
		</div>
	</div>

	<!-- script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>

	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

	<script>
		CKEDITOR.replace('content');

		// function showhideinput(option) {
		// 	const urlInput = document.getElementById('typeurl');
		// 	const fileInput = document.getElementById('typefile');
		// 	const uploadFileInput = document.getElementById('uploadFile');
		// 	const thumbnailInput = document.getElementById('thumbnail');

		// 	if (option == 'url') {
		// 		fileInput.checked = false;
		// 		uploadFileInput.style.display = 'none';
		// 		thumbnailInput.style.display = 'block';
		// 	} else {
		// 		urlInput.checked = false;
		// 		uploadFileInput.style.display = 'block';
		// 		thumbnailInput.value = '';
		// 		thumbnailInput.style.display = 'none';
		// 	}
		// }
	</script>

</body>
<?php
include('footer.php');
?>

</html>