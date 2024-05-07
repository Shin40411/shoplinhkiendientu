<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../config/dbhelper.php');
require_once ('../../../common/utility.php');
$limit = 3;
$page  = 1;
if (isset($_GET['page'])){
$page = $_GET['page'];
}
if($page <= 0) {
      $page = 1;
}
$firstIndex = ($page-1)*$limit;
$con=mysqli_connect("localhost","root","","eshop");
	$sql_lietke_bv = mysqli_query($con,"SELECT * FROM news,category_news WHERE news.id_danhmuc=category_news.id ORDER BY news.id_baiviet ASC".' limit '.$firstIndex.','.$limit);
	$sql = 'select count(id_baiviet) as total from news where 1';
    $countResult = executeSingleResult($sql);
    $number = 0;
    if($countResult != null) {
    $count = $countResult['total'];
    $number = ceil($count/$limit);
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
   Quản lý bài viết
  </title>
<div class="container-fluid py-4">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý bài viết</h2>
			</div>
			<div class="panel-body">
				 <div class="row">
				 	 <div class="col-lg-6">
			<a href="addnews.php">
				<button class="btn btn-success" style="margin-bottom: 15px;">Thêm bài viết</button>
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
						<th>Tên bài viết</th>
						<th>Hình Ảnh</th>
						<th>Danh Mục</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $index = 1;
				  while($row = mysqli_fetch_array($sql_lietke_bv)){
  				?>
		<tr>
		    <td style="text-align:center"><?php echo ++$firstIndex ?></td>
		  <td><?php echo $row['tenbaiviet'] ?></td>
			<td><img src="uploads/<?php echo $row['hinhanh'] ?>" width="95px"></td>
			<td><?php echo $row['name_category'] ?></td>
      </td>
			<td>
			<a href="edit_post.php?idbaiviet=<?php echo $row['id_baiviet'] ?>"><button class="btn btn-warning">Sửa</button></a> 
			</td>
			<td>
			<button class="btn btn-danger" onclick="deletenews(<?php echo $row['id_baiviet'] ?>)"><i class="fa fa-trash"></i></button>
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
			    <?=paginarion($number, $page, '')?>
</div>
<script type="text/javascript">
    function deletenews(id) {
      var option = confirm('Bạn có chắc chắn muốn xóa bài viết này không?')
      if(!option) {
        return;
      }

      console.log(id)
      //ajax - xu ly lenh post
      $.post('ajaxnews.php', {
        'id_baiviet': id,
        'action': 'delete'
      }, function(data) {
        location.reload()
      })
    }
  </script>

<?php 
include ('footer.php'); 
?>