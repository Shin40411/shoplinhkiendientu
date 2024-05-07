<?php 
session_start();
?> 
<?php 
include ('layout/header.php');
require_once ('../config/dbhelper.php');
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select * from product where id = '.$id;
    $product = executeSingleResult($sql);
  $sql = 'select * from category where id = '.$id;
  $category = executeSingleResult($sql);
  if($category != null) {
        $name = $category['name'];
    }
}
?>

<?php 
    if(isset($_POST['cmt'])){

$comment=$_POST['comment'];
if(isset($_SESSION['dangky'])){
  $id_product = $_GET['id'];
  $con=mysqli_connect("localhost","root","","eshop");
  $account_id = mysqli_fetch_array($con->query("SELECT * FROM signup WHERE name='".$_SESSION['dangky']."'"));
   $account_id = $account_id['id_signup'];
   $st1='0';
              $con->query("INSERT INTO comment(comments,id_account,id_product,status) VALUE ('".$comment."','".$account_id."','".$id_product."','".$st1."')");
  echo "<script>alert('Bình luận thành công, chờ phê duyệt!');</script>";
}
}
?>
<?php
  $con=mysqli_connect("localhost","root","","eshop");
  $sql_likes = mysqli_query($con,"UPDATE product SET views=views+1 WHERE id='".$id."'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$product['title']?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="Index_css/style.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
  <style>
p{
  text-align: inherit;
 }
</style>
  <div class="container-fluid">
      <div class="row">
            <?php include('banner-slider/slider.php') ?>
        <div id="main-product"> 
           <?php include('sidebar/sidebar2.php') ?>
            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
       <div class="main-tab">
        <?php include('main-detail/detail-product.php') ?>
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

     <?php include('detail-product/tab-script.php') ?>

        <?php include('login/script.php') ?>

</body>
</html>
<?php 
    include ('footer.php'); 
?>