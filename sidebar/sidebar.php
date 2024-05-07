   <style>
     .col-md-3 {
    float: right;
}
  .checked {
  color: orange;
}
   </style>

    <div class="col-md-3">

          

      <div class="card my-4">
                <h5 class="card-header" style="text-align:center;font-size: 2.25rem;">Danh mục sản phẩm</h5>
 <div class="card-body">
               <ul class="list_sidebar">
                   <?php
                        $sql = "SELECT * FROM category ORDER BY id ASC";
                        $categoryList = executeResult($sql);
                         foreach ($categoryList as $item) {
              echo'               
                    <li style="text-transform: initial; text-align:center"><a href="category.php?id='.$item['id'].'">'.$item['name'].'</a></li>'; } 
                    ?>
                       
               </ul>
           </div>

               <h5 class="card-header" style="text-align:center;font-size: 2.25rem;">Danh mục tin tức</h5>
             <div class="card-body">
               <ul class="list_sidebar">
                   <?php
                        $sql = "SELECT * FROM category_news ORDER BY id ASC";
                        $category_newsList = executeResult($sql);
                         foreach ($category_newsList as $item) {
              echo'               
                    <li style="text-transform: initial; text-align:center"><a href="category_news.php?id='.$item['id'].'">'.$item['name_category'].'</a></li>'; } 
                    ?>
                       
               </ul>

           </div>
           </div>
           <div class="card my-4">
              <h5 class="card-header" style="text-align:center;font-size: 2.25rem;">Đánh giá tiêu biểu của khách hàng</h5>
<?php 
 $sts=1;
 $con=mysqli_connect("localhost","root","","eshop");
 $query_binhluan=mysqli_query($con,"SELECT * FROM signup a JOIN comment b on a.id_signup=b.id_account JOIN product c on b.id_product=c.id WHERE status=1 limit 4");
while($row=mysqli_fetch_array($query_binhluan)){
?>
              <div class="card-body">
                <div class="media-body">    
                <h5 class="mt-0"> 
               <i class="fa fa-user"></i>  <?php echo htmlentities($row['name']);?> 
            </h5>
              <?php echo htmlentities($row['comments']);?> 

              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
             </div>
              </div>
              <?php } ?>
           </div>
         </div>

