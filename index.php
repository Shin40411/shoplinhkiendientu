<?php
session_start();
?>
<?php
include('header.php');
require_once('db/dbhelper.php');
require_once('common/utility.php');
$id = '';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = 'select * from product where id = ' . $id;
  $product = executeSingleResult($sql);
  $sql = 'select * from category where id = ' . $id;
  $category = executeSingleResult($sql);
  if ($category != null) {
    $name = $category['name'];
  }
}
?>

<body>
  <section id="home" class="welcome-hero">

    <!-- top-area Start -->
    <?php
    include('menu.php');
    ?>
    <!-- top-area End -->

    <div class="container">
      <div class="welcome-hero-txt">
        <h2>Nơi uy tính cho mọi nhà</h2>
        <p>
          Khám phá thế giới kỹ thuật số với linh kiện điện tử chất lượng cao, tạo nên những dự án sáng tạo không giới hạn. Hãy đến với chúng tôi và biến ý tưởng của bạn thành hiện thực!
        </p>
        <button class="welcome-btn" onclick="window.location.href='#'">Liên hệ</button>
      </div>
    </div>

    <div class="container">
      <?php include('common/sort.php'); ?>
    </div>

  </section>

  <!--service start -->
  <?php include('main-content/service.php'); ?>
  <!--service end-->

  <!--coupons start -->
  <?php include('main-content/coupons.php'); ?>
  <!--coupons end -->

  <!--featured start -->
  <?php
  include('main-content/main-content.php');
  ?>
  <!--featured end -->

  <!-- clients-say strat -->
  <?php
  include('main-content/feedback.php');
  ?>
  <!-- clients-say end -->

  <!--brand strat -->
  <?php
  include('main-content/brand.php');
  ?>
  <!--brand end -->

  <!--blog start -->
  <section id="blog" class="blog"></section>
  <!--blog end -->

  <?php include('footer.php'); ?>

  <script src="assets/js/cart/cart.js" ></script>

  <script src="assets/js/logout.js" ></script>

  <script src="assets/js/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

  <script src="assets/js/bootstrap.min.js"></script>

  <script src="assets/js/bootsnav.js"></script>

  <script src="assets/js/owl.carousel.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <script src="assets/js/custom.js"></script>

</body>

</html>