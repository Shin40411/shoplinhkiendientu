<?php
session_start();
require_once('../config/dbhelper.php');
$id = '';
$con = mysqli_connect("localhost", "root", "", "eshop");

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

$sql_likes = mysqli_query($con, "UPDATE product SET views=views+1 WHERE id='" . $id . "'");
?>

<section id="detail-pro" style="padding-top: 100px;" class="history-order featured-cars">
  <div class="container-fluid bg-chitiet">
    <div class="card-prodetails">
      <div class="d-flex flex-wrap">
        <div class="col-md-6">
          <img style="height:auto;max-height:700px;width:100%" width="600" src="<?= 'Admin/template/pages/uploads/' .  $product['thumbnail'] ?>">
        </div>
        <div class="col-md-6">
          <ul class="product_content d-flex flex-wrap">
            <li class="gia">Mã sản phẩm: E-<?= $product['id'] ?></li>
            <li class="ten">
              <h1><b><?= $product['title'] ?></b></h1>
            </li>
            <li class="gia"><span style="font-size: 1.25em;"><?php echo number_format($product['price'], 0, ',', '.') . 'vnđ'; ?></span></li>
            <li class="gia">
              <?php echo $product['views'] ?> lượt xem
            </li>
            <li>
              <button class="btn btn-lg btn-addtocart" type="button" onclick="addToCart(<?php echo $product['id'] ?>)" name="themgiohang"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
            </li>
          </ul>
          <div class="row col-mt-10">
            <div class="col-md-12">
              <div id="Thông tin sản phẩm" class="tabcontent">
                <?= $product['content'] ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php
            // if (isset($_SESSION['dangky'])) {
            ?>
            <div class="card">
              <h5 class="card-header">Để lại bình luận:</h5>
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <textarea class="form-control" id="comment" rows="3" placeholder="Bình luận của bạn..." required></textarea>
                  </div>
                  <button type="button" onclick="commentsend('<?php echo $id ?>')" class="btn btn-lg btn-addtocart" id="cmt" name="cmt">Gửi bình luận</button>
                </div>
              </form>
            </div>
            <?php
            // }
            ?>
            <div class="commentrow panel panel-info">
              <?php
              $sts = 1;
              $query_binhluan = mysqli_query($con, "SELECT * FROM signup a JOIN comment b on a.id_signup=b.id_account JOIN product c on b.id_product=c.id WHERE status=" . $sts . " AND id_product=" . $_GET['id']);
              while ($row = mysqli_fetch_array($query_binhluan)) {
              ?>
                <div class="media mb-4">
                  <div class="media-body">
                    <h5 class="mt-0">
                      <i class="fa fa-user"></i> <?php echo htmlentities($row['name']); ?>
                    </h5>
                    <?php echo htmlentities($row['comments']); ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12 relatedp">
          <h3>Sản Phẩm Tương Tự:</h3>

          <?php
          if (isset($_GET['id_category'])) {
            $id_category = $_GET['id_category'];
          }
          $sql = "SELECT product.id, product.title, product.price, product.thumbnail, product.status_pro, product.id_category, product.updated_at, category.name category_name FROM product LEFT JOIN category on product.id_category = category.id WHERE product.id_category ='$id_category' AND not(product.id = '$id') LIMIT 4";
          $productList = executeResult($sql);
          foreach ($productList as $item) {
          ?>

            <div class="col-md-3" style="float:left">
              <div class="productlist">
                <?php if ($item['status_pro'] == 0) { ?>
                  <a href="javascript:void(0);" onclick="loadPage('chitietsanpham', '<?php echo $item['id'] ?>', '<?php echo $item['id_category'] ?>', '#detail-pro')" style="text-decoration: none;" title="xem sản phẩm">
                    <img class="img img-responsive" width="100%" src="<?php echo 'Admin/template/pages/uploads/' .  $item['thumbnail'] ?>">
                    <p class="title_product"><?php echo $item['title'] ?></p>
                    <p class="price_product"><?php echo number_format($item['price'], 0, ',', '.') . ' vnđ' ?></p>
                  </a>
                <?php
                } else {
                ?>
                  <a href="javascript:void(0);" onclick="loadPage('chitietsanpham', '<?php echo $item['id'] ?>', '<?php echo $item['id_category'] ?>', '#detail-pro')" style="text-decoration: none;" title="xem sản phẩm">
                    <img class="img img-responsive" width="100%" src="<?php echo 'Admin/template/pages/uploads/' .  $item['thumbnail'] ?>">
                    <p class="title_product"><?php echo $item['title'] ?></p>
                    <p class="price_product"><?php echo number_format($item['price'], 0, ',', '.') . ' vnđ' ?></p>
                  </a>
                <?php
                }
                ?>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include('../content/service.php');
include('../content/main-content.php');
?>