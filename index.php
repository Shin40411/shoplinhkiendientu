<?php
session_start();
?>
<?php
include('layout/header.php');
require_once('config/dbhelper.php');
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

  <!-- top-area Start -->
  <?php
  include('layout/menu.php');
  ?>

  <div id="app">
    <?php include('pages/home.php') ?>
  </div>
  <div id="cancelmodal" class="cancel-order">
  </div>

  <?php include('layout/footer.php'); ?>

  <script src="assets/js/layout.js"></script>

  <script src="assets/js/cart/cart.js"></script>

  <script src="assets/js/logout.js"></script>

  <script src="assets/js/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

  <script src="assets/js/bootstrap.min.js"></script>

  <script src="assets/js/bootsnav.js"></script>

  <script src="assets/js/owl.carousel.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <script src="assets/js/custom.js"></script>

</body>

</html>