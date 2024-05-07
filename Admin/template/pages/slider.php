<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../db/dbhelper.php');
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
   Thêm banner
  </title>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm banner</h2>
			</div>
			<div class="panel-body">
			<form method="post" action="control_banner.php" enctype="multipart/form-data">
					<div class="form-group">
					  <label for="hinhanh">Banner 1:</label>					 
					  <input type="file" name="hinhanh">
					</div>	
					<div class="form-group">
					  <label for="hinhanh2">Banner 2:</label>					 
					  <input type="file" name="hinhanh2">
					</div>	
					</div>
					<div class="form-group">
					  <label for="hinhanh3">Banner 3:</label>					 
					  <input type="file" name="hinhanh3">
					</div>	
					<input type="submit" name="thembanner" value="Lưu" style="width:7%; height:40px;">
				</form>
			</div>						
		</div>
	</div>
  </div>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" ></script>
</body>
<?php 
include ('footer.php');
?>
</html>