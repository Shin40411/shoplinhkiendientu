    <style>
     .col-md-2 {
    float: left;
}
   </style>
  <div class="col-md-2">
          <div class="card mb-4">
            <h5 class="card-header" style="font-size: 18px"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng của bạn</h5>
            <div class="card-body">
                  <!--  <form name="search" action="search.php" method="post"> -->
                  <ul class="list_sidebars">
                    <?php
                    $number = 0;
                    $total = 0;
                    if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $value){
                      $number += (int)$value["soluong"];
                      $total += (int)$value["soluong"]*(int)$value["price"];
                      }
                    }
                       ?>
                  <li>
               Hiện có:  <span><?php echo $number ?></span> sản phẩm
                  </li>
                    <li>
                      Tổng tiền: <?php echo number_format($total,0,',','.') .' vnđ' ?>
                    </li>
                    <li>
                       <a href="giohang.php"><button class="btn btn-success">Xem giỏ hàng</button></a>
                       <?php if(isset($_SESSION['cart'])){ ?>
                      <a href="cart.php?xoatatca=1"> <button class="btn btn-danger">Xóa hết</button> </a>
                    <?php } ?>
                    </li>
                 </ul>

            <!--   </form> -->
            </div>
          </div>
           <div class="card mb-4">
             <h5 class="card-header" style="text-align:center;font-size: 2.25rem;">Top sản phẩm bán chạy</h5>
            <div class="card-body">
                      <ul class="list_sidebars">
                       <?php
                       $sql = "select product.id as pid,product.title as pdttitle,product.thumbnail as pdtthumb,product.price as pdtprice, product.id_category as pdtidcate from product left join category on category.id=product.id_category where views > 5 and status_pro = 1 limit 3";
                       $product_fav = executeResult($sql);
                         foreach ($product_fav as $item) {
              echo'  <hr>          
                    <a href="detail.php?id='.$item['pid'].'&id_category='.$item['pdtidcate'].'" style="text-decoration: none"><img class="img img-responsive" width="100%" src="'.$item['pdtthumb'].'">
                    <li style="text-transform: initial; text-align:center">'.$item['pdttitle'].'</li> 
                    <li style="text-transform: initial; text-align:center">Giá chỉ '.number_format($item['pdtprice'],0,',','.').' vnđ</li> </a> <hr>'; } 
                    ?>
          </ul>
            </div>
          </div>
        </div>