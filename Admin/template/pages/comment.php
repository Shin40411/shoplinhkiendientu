<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
include ('header.php');
require_once ('../../../config/dbhelper.php');
require_once ('../../../common/utility.php');
?>
<?php 
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
$sql_cmt = mysqli_query($con,"SELECT * FROM comment,signup,product WHERE comment.id_account=signup.id_signup AND comment.id_product=product.id ORDER BY comment.id_comment ASC".' limit '.$firstIndex.','.$limit);
 $sql = 'select count(id_comment) as total from comment where 1';
    $countResult = executeSingleResult($sql);
    $number = 0;
    if($countResult != null) {
    $count = $countResult['total'];
    $number = ceil($count/$limit);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
   Quản lý bình luận
  </title>
<div class="container-fluid py-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý bình luận sản phẩm</h2>
      </div>
         <div style="margin-top:50px"></div>
         <div class="panel-body">
          <div class="row">
             <div class="col-12">
            <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table table-light table-hover align-items-center mb-0">
        <thead class="thead-dark">
          <tr>
                <th width="40px">STT</th>
                <th width="40px">Tài khoản</th>
                <th width="40px">Sản phẩm</th>
                <th width="40px">Bình luận</th>
                <th width="40px">Tình trạng</th>
                <th width="40px" style="padding-right: 0px;padding-left: 0px;"></th>
                <th width="40px" style="padding-right: 0px;padding-left: 0px;"></th>
          </tr>
        </thead>
                    <?php 
                $index = 1;
                while($item = mysqli_fetch_array($sql_cmt)){
                    ?>
        <tr>        
                <td style="padding-left:30px;"><?php echo ++$firstIndex ?></td>
                <td style="padding-left:2px;"><?php echo $item['name']?></td>
                <td style="padding-left:22px;"><?php echo $item['title']?></td>
                <td style="padding-left:25px;"><?php echo $item['comments']?></td>
                <td style="padding-left:25px;">
                     <?php 
                    if($item['status']==0){
                                echo 'Chờ duyệt';
                            }else{
                                echo 'Đã duyệt';
                            }
                            ?>
                </td>
                <td style="padding-left:27px;">
                    <?php 
                    if($item['status']==0){
                        ?>
                               <a href="approved.php?disid=<?php echo $item['id_comment']?>"><button class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-check"></i></button></a>
                           <?php }else{ ?>
                               <a href="approved.php?appid=<?php echo $item['id_comment']?>"><button class="btn btn-danger" style="margin-bottom: 15px;"><i class="fa fa-close"></i></button></a>
                            <?php
                            }
                            ?>
                </td>
                <td style="padding-left:27px;">
                  <button class="btn btn-danger" onclick="deleteComment(<?php echo $item['id_comment'] ?>)"><i class="fa fa-trash"></i></button>
                </td>
          </tr>
                 <?php
                  } 
                  ?>
      </table>
      </div>
        </div>
        </div>
    </div>
            <!-- Phân Trang -->
       <?=paginarion($number, $page, '')?>
         </div>
        </div>

      <script type="text/javascript">
    function deleteComment(id) {
        var option = confirm('Bạn có chắc chắn muốn xóa bình luận này không?')
        if(!option) {
            return;
        }
        console.log(id)
        //ajax - xu ly lenh post
        $.post('ajaxcmt.php', {
            'id_comment': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
  </script>
<?php 
  include ('footer.php'); 
?>