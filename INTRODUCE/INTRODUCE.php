
<?php
$con=mysqli_connect("localhost","root","","eshop");
$sql_lh = mysqli_query($con,"SELECT * FROM contact WHERE id=1");
?>

  <?php
    while($row = mysqli_fetch_array($sql_lh)) {
    ?>
      <p><?php echo $row['contactdetail'] ?></p>
      
    <?php 
    }
    ?>
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-layout="standard" data-action="like" data-size="small" data-share="true" style="float:right;margin-top:3%"></div>
