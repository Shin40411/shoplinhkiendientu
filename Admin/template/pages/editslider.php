<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../config/dbhelper.php');
?>
<?php 
include ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
   Sửa banner
  </title>
	<div class="container-fluid py-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php
				$con=mysqli_connect("localhost","root","","eshop");
					$sql_suabanner = mysqli_query($con,"SELECT * FROM banner WHERE id='$_GET[id]' LIMIT 1");
				?>
				<h2 class="text-center">Sửa banner</h2>
			</div>
			<div class="panel-body" style="margin-top: 6%;">
				<?php
				while($row = mysqli_fetch_array($sql_suabanner)) {
				?>
			<form method="post" action="control_banner.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
					
						<div class="form-group">
					  <label for="hinhanh">Banner 1:</label>					 
					  <input type="file" name="hinhanh">
					   <img src="uploads/<?php echo $row['hinhanh'] ?>" width="150px">
					</div>	
					
				
						<div class="form-group">
					  <label for="hinhanh2">Banner 2:</label>					 
					  <input type="file" name="hinhanh2">
					   <img src="uploads/<?php echo $row['hinhanh2'] ?>" width="150px">
					</div>	
					
						<div class="form-group">
					  <label for="hinhanh3">Banner 3:</label>					 
					  <input type="file" name="hinhanh3">
					   <img src="uploads/<?php echo $row['hinhanh3'] ?>" width="150px">
					</div>	
					
					<input type="submit" name="suabanner" value="Lưu" style="width:10%; height:40px;">
				</form>
				<?php
				 } 
				 ?>
			</div>						
		</div>

	<!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" ></script>

	
</body>
<?php 
include ('footer.php');
?>
</html>