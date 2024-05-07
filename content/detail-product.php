<h3><?=$product['title']?>:</h3>
         <div class="row">
             <div class="col-md-4">
             
              <img style="height:177px" width="100%" src="<?=$product['thumbnail']?>">

          </div>  
                <form method="POST" action="cart.php?id=<?php echo $product['id'] ?>"> 
              <div class="col-md-12">
           <ul class="product_content">
                  <li class="ten"><?=$product['title']?></li>
                  <li class="gia">Giá: <?php echo number_format($product['price'],0,',','.').'vnđ'; ?></li>
                  <li class="gia">Mã sản phẩm: 0<?=$product['id']?></li>
                  <li class="gia">
                    <i class="fa fa-eye"></i>:
               Có <?php echo $product['views'] ?> người đã xem qua
                  </li>
                <li>    
                    <input class="dathang" type="submit" name="themgiohang" value="Thêm giỏ hàng">
                </li>
              </ul>
               </div>
          </form>
      </div>
         
          <!-- tabbars -->
          <div class="col-md-12">
            <div class="tab">
  <button class="tablinks active">Thông tin sản phẩm</button>
  <button class="tablinks">Đánh giá sản phẩm</button>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="Thông tin sản phẩm" class="tabcontent"> 
        <?=$product['content']?>
        </div>
    </div>
</div>

<div id="Đánh giá sản phẩm" class="tabcontent">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-4">
            <h5 class="card-header">Để lại bình luận:</h5>
            <div class="card-body">

              <form name="Comment" method="post">
                    
                <div class="form-group">
                    <?php if(isset($_SESSION['dangky'])){ ?>
                  <textarea class="form-control" name="comment" rows="3" placeholder="Bình luận của bạn..." required></textarea>
                  <?php }else{?>
                    <a style="text-decoration:none" href="../login/sign_up.php"><textarea class="form-control" name="comment" rows="3" placeholder="Bình luận của bạn..." required></textarea></a>
                <?php } ?>
                </div>
            
                <button type="submit" class="btn btn-primary" name="cmt">Gửi</button>
              </form>
            </div>
          </div>
<?php 
 $sts=1;
 $con=mysqli_connect("localhost","root","","eshop");
 $query_binhluan=mysqli_query($con,"SELECT * FROM signup a JOIN comment b on a.id_signup=b.id_account JOIN product c on b.id_product=c.id WHERE status=".$sts." AND id_product=".$_GET['id']);
while ($row=mysqli_fetch_array($query_binhluan)) {
?>
          <div class="media mb-4">
            <div class="media-body">    
                <h5 class="mt-0">
              <i class="fa fa-user"></i> <?php echo htmlentities($row['name']);?> 
            </h5>
              <?php echo htmlentities($row['comments']);?>   
             </div>
          </div>
<?php } ?>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
           <h3>Sản Phẩm Tương Tự:</h3>
     
               <?php 
               if(isset($_GET['id_category'])){
                 $id_category = $_GET['id_category'];
             }
          $sql = "SELECT product.id, product.title, product.price, product.thumbnail, product.status_pro, product.id_category, product.updated_at, category.name category_name FROM product LEFT JOIN category on product.id_category = category.id WHERE product.id_category ='$id_category' AND not(product.id = '$id') LIMIT 4";
          $productList = executeResult($sql);
          foreach ($productList as $item) { ?>

             <div class="col-md-3" style="float:left">
                 <div class="productlist">
               <?php if($item['status_pro']==0){?>
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product" style="text-align:center"><?php echo $item['title'] ?></p>
                            <p class="price_product" style="text-align:center">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
                                <div class="out-of-stock-label">Hết hàng</div>

                               <?php }else{ ?>

                                 <a href="detail.php?id=<?php echo $item['id'] ?>&id_category=<?php echo $item['id_category'] ?>" style="text-decoration: none;" title="xem sản phẩm">
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product" style="text-align:center"><?php echo $item['title'] ?></p>
                            <p class="price_product" style="text-align:center">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
                        </a>
                        <form method="POST" action="cart.php?id=<?php echo $item['id'] ?>"> 
                          <a href="#" title="Thêm vào giỏ">
             <button class="addcart" type="submit" name="themgiohang">+<i class="fa fa-shopping-cart"></i></button> 
             </a>  
             </form>       
                        <?php  } ?>

                               
                 </div>

                  
                    </div> 

                    <?php  }  ?>
       
</div>
        </div>

       