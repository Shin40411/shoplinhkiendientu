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
echo "<div>";
echo "<video src='".$location."' controls width='1036' height='350' >";
echo "</div>"; }
}
?>