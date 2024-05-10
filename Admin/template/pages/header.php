<?php
    if(isset($_GET['action'])=='logout'){
      unset($_SESSION['login']);
      header('Location: sign-in.php');
    }
?>

  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/admin.css" rel="stylesheet" />

  <link href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
  
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


  <!-- favicon -->
  <link rel="shortcut icon" type="image/png" href="../assets/img/Free.png"/>

</head>
     <?php 
include ('permission.php');
$regexResult = checkPrivilege();
if(!$regexResult){
  // header('Location: ' . $_SERVER['HTTP_REFERER']);
  echo "<script>alert('Bạn không có quyền truy cập.');</script>";
  echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
  // echo "<h1 style='color:red;line-height: 88px;text-align: center;text-decoration: none;'>Về lại <a href='dashboard.php'>trang chủ.</a></h1>";
  exit;
}
?>
<style type="text/css">
  div#sidenav-collapse-main {
    height: 80vh;
}
</style>
<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        <img src="../assets/img/icons/flags/BR.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Hi, <?php if(isset($_SESSION['current_user'])){
              echo $_SESSION['current_user']; } ?></span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

             <?php if (checkPrivilege('dashboard.php')) { ?>
           <li class="nav-item">
          <a class="nav-link text-white" href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-dashboard"></i>
            </div>
            <span class="nav-link-text ms-1">Thống kê</span>
          </a>
        </li>
        <?php } ?>

        <?php if (checkPrivilege('index.php')) { ?>
        <li class="nav-item">
          <a class="nav-link text-white " href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-list"></i>
            </div>
            <span class="nav-link-text ms-1">Danh mục sản phẩm</span>
          </a>
        </li>
        <?php } ?>

        <?php if (checkPrivilege('product.php')) { ?>
        <li class="nav-item">
          <a class="nav-link text-white " href="product.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-atom"></i>
            </div>
            <span class="nav-link-text ms-1">Sản phẩm</span>
          </a>
        </li>
          <?php } ?>

          <?php if (checkPrivilege('category.php')) { ?>
         <!-- <li class="nav-item">
          <a class="nav-link text-white " href="category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
             <i class="fa fa-list-ul"></i>
            </div>
            <span class="nav-link-text ms-1">Danh mục bài viết</span>
          </a>
        </li> -->
          <?php } ?>

           <?php if (checkPrivilege('news.php')) { ?>
         <!-- <li class="nav-item">
          <a class="nav-link text-white " href="news.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sticky-note-o"></i>
            </div>
            <span class="nav-link-text ms-1">Bài viết</span>
          </a>
        </li> -->
        <?php } ?>

        <?php if (checkPrivilege('comment.php')) { ?>
         <li class="nav-item">
          <a class="nav-link text-white " href="comment.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="far fa-user"></i>
            </div>
            <span class="nav-link-text ms-1">Đánh giá</span>
          </a>
        </li>
        <?php } ?>

         <?php if (checkPrivilege('bill.php')) { ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="bill.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="far fa-file-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Đơn hàng</span>
          </a>
        </li>
        <?php } ?>

        <?php if (checkPrivilege('shipping.php')) { ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="shipping.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class='fas fa-shipping-fast'></i>
            </div>
            <span class="nav-link-text ms-1">Giao hàng</span>
          </a>
        </li>
        <?php } ?>

         <?php if (checkPrivilege('contact.php')) { ?>
        <!-- <li class="nav-item">
          <a class="nav-link text-white" href="contact.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-address-book"></i>
            </div>
            <span class="nav-link-text ms-1">Liên hệ</span>
          </a>
        </li> -->
        <?php } ?>

          <?php if (checkPrivilege('Banner-slider.php')) { ?>
        <!-- <li class="nav-item">
          <a class="nav-link text-white" href="Banner-slider.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-sliders-h"></i>
            </div>
            <span class="nav-link-text ms-1">Banner</span>
          </a>
        </li> -->
           <?php } ?>
      <?php if (checkPrivilege('upload.php')) { ?>
           <!-- <li class="nav-item">
          <a class="nav-link text-white" href="upload.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-play"></i>
            </div>
            <span class="nav-link-text ms-1">Video</span>
          </a>
        </li> -->
        <?php } ?>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
 <!--        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Trang</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Quản trị</li>
          </ol>
        </nav> -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>

           
            <ul class="navbar-nav  justify-content-end" style="padding-left:277px">
                <?php if (checkPrivilege('member.php')) { ?>
            <li class="nav-item d-flex align-items-center">
              <a href="member.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Quản lý thành viên</span>
              </a>
            </li>
             <?php } ?>
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
             
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:void(0);" onclick="logout()" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-power-off"></i>
                <span class="d-sm-inline d-none">Đăng xuất</span>
              </a>
            </li>
          </ul>
           

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
