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
   Quản lý danh mục bài viết
  </title>
<div class="container-fluid py-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý danh mục bài viết</h2>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
      <a href="addcategory.php">
        <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Danh Mục</button>
      </a>
          </div>
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

   
    $sql = 'select * from category_news where 1 limit '.$firstIndex.','.$limit;

    $category_newsList = executeResult($sql);

    $sql = 'select count(id) as total from category_news where 1';
    $countResult = executeSingleResult($sql);
    $number = 0;
    if($countResult != null) {
    $count = $countResult['total'];
    $number = ceil($count/$limit);
    }

foreach ($category_newsList as $item) {  
  echo'<tr>
      <td style="text-align: center;">'.(++$firstIndex).'</td>
      <td>'.$item['name_category'].'</td>
      <td width="50px">
      <a href="addcategory.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a> 
      </td>
      <td width="50px">
      <button class="btn btn-danger" onclick="deletecategory_news('.$item['id'].')"><i class="fa fa-trash"></i></button>
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

  <script type="text/javascript">
    function deletecategory_news(id) {
      var option = confirm('Bạn có chắc chắn muốn xóa danh mục này không?')
      if(!option) {
        return;
      }

      console.log(id)
      //ajax - xu ly lenh post
      $.post('ajaxcategory.php', {
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
