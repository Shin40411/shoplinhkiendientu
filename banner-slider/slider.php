<?php 
$con=mysqli_connect("localhost","root","","eshop");
$sql_banner = mysqli_query($con,"SELECT * FROM banner");
?>

<style>
  div#myCarousel {
    width: 100%;
}
</style>

<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <ol class="carousel-indicators"> 
   <li data-target="#myCarousel" data-slide-to="0"></li> 
   <li data-target="#myCarousel" data-slide-to="1" class="active"></li> 
   <li data-target="#myCarousel" data-slide-to="2"></li> 
  </ol> 
  <div class="carousel-inner"> 
    <?php
    while($row = mysqli_fetch_array($sql_banner)) {
    ?>
   <div class="item"> 
    <img class="img img-responsive" style="height: 408px" width="100%" src="Admin/template/pages/uploads/<?=$row['hinhanh']?>" alt="Thiết kế 1"> 
    <div class="carousel-caption"> 

    </div> 
   </div> 
   <div class="item active"> 
    <img class="img img-responsive" style="height: 408px" width="100%" src="Admin/template/pages/uploads/<?=$row['hinhanh2']?>" alt="Thiết kế 2"> 
    <div class="carousel-caption"> 
         <div id="text-box-1145942056" class="text-box banner-layer text-box-circle x5 md-x5 lg-x5 y5 md-y5 lg-y5 res-text">
              <div data-parallax="-2" data-parallax-fade="true" class="parallax-active" style="transform: translate3d(0px, -2.28px, 0px); backface-visibility: hidden; opacity: 0.99;">                  <div class="text box-shadow-2 dark">
              
              <div class="text-inner text-center">
                  
<h4 class="uppercase"><strong>TẾT ĐOAN NGỌ</strong></h4>
<h4><span>Mùng 05/05</span></h4>
<a href="category.php?id=18" target="_self" class="button-white" style=" text-decoration: none">
     <button class="btn btn-success" style="width:103%;"><span style="font-size:10px;">Đặt sản phẩm</span></button>
  </a>

              </div>
           </div>
              </div>              
<style scope="scope">

#text-box-1145942056 .text {
  background-color: #072e099e;
  font-size: 66%;
}
#text-box-1145942056 .text-inner {
  padding: 30px 30px 30px 30px;
}
#text-box-1145942056 {
  width: 60%;
}


@media (min-width:550px) {

  #text-box-1145942056 {
    width: 20%;
  }

}
</style>
    </div>
    </div> 
   </div> 
   <div class="item"> 
    <img class="img img-responsive" style="height: 408px" width="100%" src="Admin/template/pages/uploads/<?=$row['hinhanh3']?>" alt="Thiết kế 3"> 
   <div class="carousel-caption"> 
         <a href="category.php?id=18"></a>
    </div> 
   </div> 
  </div>
  <?php 
    }
    ?>
   <a class="left carousel-control" href="http://hocwebgiare.com/#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="http://hocwebgiare.com/#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> 
 </div> 
