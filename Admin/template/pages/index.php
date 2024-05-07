<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../db/dbhelper.php');
require_once ('../../../common/utility.php');
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
   Quản lý danh mục sản phẩm
  </title>
<div class="container-fluid py-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý danh mục sản phẩm</h2>
      </div>
      <div class="panel-body">
        <div class="row">
          <?php if (checkPrivilege('add.php')) { ?>
          <div class="col-lg-6">
      <a href="add.php">
        <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Danh Mục</button>
      </a>
          </div>
           <?php } ?>
         <!--  <div class="col-lg-6">
        <form method="get">
        <div class="form-group" style="width:200px; float:right;">
        <input type="text" placeholder="Tìm kiếm..." class="form-control" id="s" name="s">
        </div>
        </form>
          </div> -->
        </div>          
      <table class="table table-light table-hover">
        <thead class="thead-dark">
          <tr>
            <th width="40px;">STT</th>
            <th>Tên Danh Mục</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
<?php
//lấy danh sách danh mục từ database
$limit = 3;
$page  = 1;
if (isset($_GET['page'])){
  $page = $_GET['page'];
}
if($page <= 0) {
  $page = 1;
}
    $firstIndex = ($page-1)*$limit;

    // $s = '';
    // if(isset($_GET['s'])){
    //   $s = $_GET['s'];
    // }

    // $additional = '';

    // if(!empty($s)){
    //   $additional = ' and name like "%'.$s.'%" ';
    // } 
    $sql          = 'select * from category where 1 '.'limit '.$firstIndex.','.$limit;

    $categoryList = executeResult($sql);

    $sql = 'select count(id) as total from category where 1'/*.$additional*/;
    $countResult = executeSingleResult($sql);
    $number = 0;
    if($countResult != null) {
    $count = $countResult['total'];
    $number = ceil($count/$limit);
    }

foreach ($categoryList as $item) {	
	echo'<tr>
		  <td style="text-align: center;">'.(++$firstIndex).'</td>
			<td>'.$item['name'].'</td>
			<td width="50px">
			<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a> 
			</td>
			<td width="50px">
			<button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')"><i class="fa fa-trash"></i></button>
			</td>
		</tr>';
}
?>
				</tbody>
			</table>
   <!-- Phân Trang -->
<?=paginarion($number, $page, '')?>
		</div>
	</div>
</div>

  <script type="text/javascript">
  	function deleteCategory(id) {
  		var option = confirm('Bạn có chắc chắn muốn xóa danh mục này không?')
  		if(!option) {
  			return;
  		}

  		console.log(id)
  		//ajax - xu ly lenh post
  		$.post('ajax.php', {
  			'id': id,
  			'action': 'delete'
  		}, function(data) {
  			location.reload()
  		})
  	}
  </script>

<?php 
  include ('footer.php'); 
?>
