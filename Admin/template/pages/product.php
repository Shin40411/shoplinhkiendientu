<?php
require('function.php');
if (!isset($_SESSION['login'])) {
	header('Location: sign-in.php');
}
?>
<?php
require_once('../../../config/dbhelper.php');
require_once('../../../common/utility.php');
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
		Quản lý sản phẩm
	</title>
	<div class="container-fluid py-4">
		<div class="panel-heading">
			<h2 class="text-center">Quản Lý sản phẩm</h2>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
					<a href="addproduct.php">
						<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card-body px-0 pb-2">
						<div class="table-responsive p-0">
							<table class="table table-light table-hover align-items-center mb-0">
								<thead class="thead-dark">
									<tr>
										<th style="text-align:center">STT</th>
										<th>Hình Ảnh</th>
										<th>Tên Sản Phẩm</th>
										<th>Giá Bán</th>
										<th>Danh Mục</th>
										<th>Ngày Cập Nhật</th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									//lay danh sach danh muc tu database
									$limit = 3;
									$page  = 1;
									if (isset($_GET['page'])) {
										$page = $_GET['page'];
									}
									if ($page <= 0) {
										$page = 1;
									}
									$firstIndex = ($page - 1) * $limit;

									$sql = 'select product.id, product.title, product.price, product.thumbnail, product.status_pro, product.updated_at, category.name category_name from product left join category on product.id_category = category.id' . ' limit ' . $firstIndex . ',' . $limit;
									$productList = executeResult($sql);

									$sql = 'select count(id) as total from product where 1';
									$countResult = executeSingleResult($sql);
									$number = 0;
									if ($countResult != null) {
										$count = $countResult['total'];
										$number = ceil($count / $limit);
									}

									$index = 1;
									foreach ($productList as $item) {
									?>
										<tr>
											<td style="text-align:center"><?php echo ++$firstIndex ?></td>
											<td><img src="<?php echo 'uploads/' . $item['thumbnail'] ?>" class="avatar avatar-lg me-3 border-radius-lg" style="max-width: 100px"></td>
											<td>
												<p>
													<?php echo $item['title'] ?>
												</p>
											</td>
											<td><?php echo number_format($item['price'], 0, ',', '.') . ' vnđ' ?></td>
											<td><?php echo $item['category_name'] ?></td>
											<td><?php echo $item['updated_at'] ?></td>
											<td>
												<a href="addproduct.php?id=<?php echo $item['id'] ?>"><button class="btn btn-warning">Sửa</button></a>
											</td>
											<td>
												<?php
												if ($item['status_pro'] == 0) {
												?>
													<a href="stocking.php?outstock=<?php echo $item['id'] ?>"> <span class="badge badge-sm bg-gradient-secondary" style="margin-bottom:22px">Hàng hot</span> </a>
												<?php } else { ?>
													<a href="stocking.php?stock=<?php echo $item['id'] ?>"> <span class="badge badge-sm bg-gradient-success" style="margin-bottom:22px">Hàng thường</span> </a>
												<?php } ?>
											</td>
											<td>
												<button class="btn btn-danger" onclick="deleteProduct(<?php echo $item['id'] ?>)"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Phân Trang -->
			<?= paginarion($number, $page, '') ?>
		</div>


		<script type="text/javascript">
			function deleteProduct(id) {
				var option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')
				if (!option) {
					return;
				}

				console.log(id)
				//ajax - xu ly lenh post
				$.post('ajaxproduct.php', {
					'id': id,
					'action': 'delete'
				}, function(data) {
					location.reload()
				})
			}
		</script>

		<?php
		include('footer.php');
		?>