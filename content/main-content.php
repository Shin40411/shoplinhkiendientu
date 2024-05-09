<section id="featured-cars" class="featured-cars">
  <div class="container">
    <div class="section-header">
      <p>Linh kiện điện tử</p>
      <h2>Sản phẩm của chúng tôi</h2>
    </div><!--/.section-header-->
    <div class="featured-cars-content">
      <?php
      if (isset($_GET['tukhoa'])) {
      ?>
        <h3>Từ khoá tìm kiếm: <?php echo $_GET['tukhoa']; ?></h3>
      <?php } ?>
      <div class="row">

        <?php
        $limit = 12;
        $page  = 1;
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
        }
        if ($page <= 0) {
          $page = 1;
        }
        $firstIndex = ($page - 1) * $limit;
        $s = '';
        if (isset($_GET['tukhoa'])) {
          $s = $_GET['tukhoa'];
        }
        $additional = '';
        if (!empty($s)) {
          $additional = ' and title like "%' . $s . '%" ';
        }
        $sql = 'select product.id, product.title, product.price, product.thumbnail, product.status_pro, product.id_category, product.updated_at, category.name category_name from product left join category on product.id_category = category.id where 1' . $additional . ' limit ' . $firstIndex . ',' . $limit;
        $productList = executeResult($sql);

        $sql = 'select count(id) as total from product where 1' . $additional;
        $countResult = executeSingleResult($sql);
        $number = 0;
        if ($countResult != null) {
          $count = $countResult['total'];
          $number = ceil($count / $limit);
        }
        $index = 1;

        foreach ($productList as $item) {
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="single-featured-cars">
              <div class="featured-img-box">
                <div class="featured-cars-img">
                  <a class="scroll" href="javascript:void(0);" onclick="loadPage('chitietsanpham', '<?php echo $item['id'] ?>', '<?php echo $item['id_category'] ?>')">
                    <img src="<?php echo 'Admin/template/pages/uploads/' . $item['thumbnail'] ?>">
                  </a>
                </div>
                <div class="featured-model-info">
                  <p>
                    <?php echo $item['title'] ?>
                  </p>
                  <button class="addcart" type="button" onclick="addToCart(<?php echo $item['id'] ?>)" name="themgiohang">+<i class="fa fa-shopping-cart"></i></button>
                </div>
              </div>
              <div class="featured-cars-txt">
                <h2>
                  <a class="scroll" href="javascript:void(0);" onclick="loadPage('chitietsanpham', '<?php echo $item['id'] ?>', '<?php echo $item['id_category'] ?>')">
                    <?php echo $item['title'] ?>
                  </a>
                </h2>
                <h3>Giá: <?php echo number_format($item['price'], 0, ',', '.') . ' vnđ' ?></h3>
              </div>
            </div>
          </div>
        <?php  } ?>
      </div>
      <div class="d-flex justify-center">
        <button type="button" class="btn btn-primary" id="gallery-btn">Hiển thị thêm</button>
      </div>
    </div>
  </div>
</section>