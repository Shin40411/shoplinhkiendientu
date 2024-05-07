<?php 
session_start();
?> 
<?php 
include ('header.php');
require_once ('db/dbhelper.php');
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select * from news where id_baiviet = '.$id;
    $news = executeSingleResult($sql);
  $sql = 'select * from category_news where id = '.$id;
  $category_news = executeSingleResult($sql);
  if($category_news != null) {
        $name_category = $category_news['name_category'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chi tiết bài viết - <?=$news['tenbaiviet']?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="Index_css/style.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

     <div id="fb-root"></div>
</head>
<body>
    <div class="container-fluid">
          <div class="row">
            <?php include('banner-slider/slider.php') ?>
        <div id="main-product"> 
            <?php include('sidebar/sidebar2.php') ?>
             <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
             <div class="main-tab">
        <p style="text-transform:uppercase;font-size:30px;"><?=$news['tenbaiviet']?></p>
                <p><?=$news['tomtat']?></p>
        <img class="img img-responsive" width="100%" src="Admin/template/pages/uploads/<?=$news['hinhanh']?>">
        <p><?=$news['noidung']?></p>
        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-layout="standard" data-action="like" data-size="small" data-share="true" style="float:right;margin-top:3%"></div>
       </div>

       <div class="row">
           <h3>Mẹo vặt trong ngày:</h3>
           <style>
             video {
  width: 100%;
  height: auto;
}
           </style>
           <?php
$con=mysqli_connect("localhost","root","","eshop");
 $fetchVideos = mysqli_query($con,"SELECT location FROM videoqc ORDER BY id_vid DESC");
$result = ($fetchVideos);
if (!$result) {
echo "Lỗi không lấy được dữ liệu";
}
else {
while($row = mysqli_fetch_array($result)) {
$location = $row['location'];
?>
<div>
<video src='<?php echo $location?>' controls width='1036' height='350' allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">";
</div>
<?php } ?>
<?php
}
?>
        </div>
       
        </div>
         <?php include('sidebar/sidebar.php') ?>
            </div>
      <div class="clear"></div>
        </div>
      </div>
      <img class="img img-responsive" width="100%" src="img/istockphoto-515673754-612x612.jpg" style="height: 609px">
  <!-- script -->
     <script src="js/jquery-1.11.1.min.js"></script>

      <?php include('banner-slider/slider-script.php') ?>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="Isxraxa8"></script>

         <?php include('login/script.php') ?>
</body>
</html>
<?php 
    include ('footer.php'); 
?>