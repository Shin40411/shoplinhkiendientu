<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
  unset($_SESSION['dangky']);
}

$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_category = "SELECT * FROM category ORDER BY id DESC";
$query_category = mysqli_query($con, $sql_category);
?>

<div class="top-area">
  <div class="header-area">
    <!-- Start Navigation -->
    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

      <div class="container">

        <!-- Start Header Navigation -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand" href="index.html">linh kiện e-shop<span></span></a>

        </div><!--/.navbar-header-->
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
          <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
            <li class=" scroll active"><a href="#home">trang chủ</a></li>
            <li class="scroll"><a href="#service">dịch vụ</a></li>
            <li class="scroll"><a href="#featured-cars">sản phẩm</a></li>
            <li class="scroll"><a href="#new-cars">khuyến mãi sốc</a></li>
            <!-- <li class="scroll"><a href="#brand">thương hiệu</a></li> -->
            <?php
            if (isset($_SESSION['dangky'])) {
            ?>             
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <span style="color:yellow;font-size:unset">
                    <i style="font-size:15px" class="fa">&#xf007;</i>
                    <?php echo $_SESSION['dangky'] ?>
                  </span>
                </a>
                <div class="dropdown-menu" style="min-width: 200px;" aria-labelledby="navbarDropdown">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="lichsudonhang.php" style="font-size: unset;"><i class="fa fa-cart-arrow-down"></i> Lịch sử đơn hàng</a>
                    </li>
                    <li class="list-group-item">
                    <a class="dropdown-item" style="font-size: unset;" onclick="logout()" href="javascript:void(0);"><i class="fa fa-sign-out"></i> Đăng xuất tài khoản</a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php
            } else {
            ?>
              <li><a href="login/login.php">Đăng nhập</a></li>
            <?php
            }
            ?>
            <li>
              <a>
                <div id="cart-indicator">
                  <button type="button" data-toggle="modal" data-target="#cart"><span class="item-count" id="item-count"></span></button>
                </div>
              </a>
            </li>
          </ul><!--/.nav -->
        </div><!-- /.navbar-collapse -->
      </div><!--/.container-->
    </nav>
    <!-- End Navigation -->
  </div>
  <div class="clearfix"></div>
  <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <?php
        include('Cart-form/Cart-form.php');
        ?>
      </div>
    </div>
  </div>
</div>