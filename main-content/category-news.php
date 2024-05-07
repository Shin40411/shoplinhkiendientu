 <h3>>> <?=$name_category?></h3>
                 <div class="row">
                   <?php 
          $sql = 'select id_baiviet, tenbaiviet, tomtat, noidung, hinhanh, category_news.name_category  from news left join category_news on news.id_danhmuc = category_news.id where category_news.id ='.$id;
          $NewsList = executeResult($sql);
          foreach ($NewsList as $item) {
            echo'           
            <div class="col-md-3">
                 <div class="productlists">
              <img class="img img-responsive" width="100%" src="Admin/template/pages/uploads/'.$item['hinhanh'].'">
              <p class="title_product">'.$item['tenbaiviet'].'</p>
              <a href="news.php?id='.$item['id_baiviet'].'" style="text-decoration: none;">
              <p>Xem ngay</p>
              </a>
            </div>
                 </div> ';
          }
          ?>
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