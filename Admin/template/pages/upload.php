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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
   Video quảng cáo
  </title>
<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản lý video quảng cáo</h2>
      </div>
         <div style="margin-top:50px"></div>
         <div class="panel-body">
               <!-- <div class="row">
          <div class="col-lg-6">
      <a href="">
        <button class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-upload"></i></button>
      </a>
          </div>   
        </div> -->
        <div class="row">
            <div class="col-lg-6">
     <form method="post" action="" enctype='multipart/form-data'>
<input type='file' name='file' />
<input type='submit' class="btn btn-success" value='Upload' name='upload'>
<?php
$con=mysqli_connect("localhost","root","","eshop");
 $fetchVideos = mysqli_query($con,"SELECT * FROM videoqc ORDER BY id_vid DESC");
 while($item = mysqli_fetch_array($fetchVideos)){
?>
<button class="btn btn-danger" onclick="deleteVideo(<?php echo $item['id_vid'] ?>)"><i class="fa fa-trash"></i></button>
<?php
} 
?>
</form>
</div>
</div>
<?php require 'action.php';?>
<div class="row">
    <div class="col-12">
<?php require 'view.php';?>
</div>
   </div> 
         </div>
        </div>
        <script type="text/javascript">
    function deleteVideo(id) {
        var option = confirm('Bạn có chắc chắn muốn xóa video này không?')
        if(!option) {
            return;
        }
        console.log(id)
        //ajax - xu ly lenh post
        $.post('ajaxvid.php', {
            'id_vid': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
  </script>
<?php 
  include ('footer.php'); 
?>