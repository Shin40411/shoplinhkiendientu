 <h3>>> <?=$name?></h3>
   <div class="row">
              <!--   <ul class="product_list"> -->
                   <?php 
          $sql = 'select product.id, product.title, product.price, product.thumbnail, product.status_pro, product.id_category, product.updated_at, category.name category_name from product left join category on product.id_category = category.id where category.id ='.$id;
          $productList = executeResult($sql);
          foreach ($productList as $item) { ?>
             <div class="col-md-3">
               <div class="productlist">
                  <?php if($item['status_pro']==0){?>
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product"><?php echo $item['title'] ?></p>
                            <p class="price_product">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
                                <div class="out-of-stock-label">Hết hàng</div>

                               <?php }else{ ?>

                                <a href="detail.php?id=<?php echo $item['id'] ?>&id_category=<?php echo $item['id_category'] ?>" style="text-decoration: none;" title="xem sản phẩm">
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product"><?php echo $item['title'] ?></p>
                            <p class="price_product">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
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
          <!--       </ul> -->
        </div>
                 <div class="clear"></div>

           <div class="row">
           <h3>Mẹo vặt trong ngày:</h3>
           <style>
             video {
  width: 100%;
  height: auto;
}
           </style>
           <?php
$con=mysqli_connect("localhost","root","","eshop");
 $fetchVideos = mysqli_query($con,"SELECT location FROM videoqc ORDER BY id_vid DESC");
$result = ($fetchVideos);
if (!$result) {
echo "Lỗi không lấy được dữ liệu";
}
else {
while($row = mysqli_fetch_array($result)) {
$location = $row['location'];
?>
<div>
<video src='<?php echo $location?>' controls width='1036' height='350' allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">";
</div>
<?php } ?>
<?php
}
?>
        </div>