<section id="new-cars" class="new-cars">
  <div class="container">
    <div class="section-header">
      <p>Sản <span>phẩm</span> khuyến <span>mãi</span></p>
      <h2>combo giảm giá sốc</h2>
    </div><!--/.section-header-->
    <div class="new-cars-content">
      <div class="owl-carousel owl-theme" id="new-cars-carousel">
        <?php
        $sql = 'select * from product where status_pro = 0';
        $productList = executeResult($sql);
        foreach ($productList as $item) {
        ?>
          <div class="new-cars-item">
            <div class="single-new-cars-item">
              <div class="row">
                <div class="col-md-7 col-sm-12">
                  <div class="new-cars-img">
                  <img src="<?php echo $item['thumbnail'] ?>">
                  </div><!--/.new-cars-img-->
                </div>
                <div class="col-md-5 col-sm-12">
                  <div class="new-cars-txt">
                    <h2><a href="#"><?php echo $item['title'] ?></a></h2>
                    <p>
                    <?php echo $item['content'] ?>
                    </p>
                    <button class="welcome-btn new-cars-btn" onclick="window.location.href='#'">
                      Xem chi tiết
                    </button>
                  </div>
                </div><!--/.col-->
              </div>
            </div>
          </div>
        <?php } ?>
      </div><!--/#new-cars-carousel-->
    </div><!--/.new-cars-content-->
  </div><!--/.container-->

</section>