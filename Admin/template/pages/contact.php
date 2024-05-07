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
   Thông tin liên hệ
  </title>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản lý thông tin liên hệ</h2>
			</div>
			<?php
			$con=mysqli_connect("localhost","root","","eshop");
				$sql_lh = mysqli_query($con,"SELECT * FROM contact WHERE id=1");
			?>
			<div class="panel-body" style="margin-top:2%">
				<?php
	 	while($row = mysqli_fetch_array($sql_lh)) {
	 	?>
			<form method="post" action="xulylienhe.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
						<div class="form-group">
					  <label for="noidung">Thông tin liên hệ:</label>					 
					 <textarea class="form-control" style="resize: none" rows="10" name="thongtinlienhe"><?php echo $row['contactdetail'] ?></textarea>
					</div>		
					<input type="submit" name="submitlienhe" value="Lưu" style="width:10%; height:40px;">
				</form>
		<?php 
		}
	  ?>
			</div>						
		</div>
	</div>
  </div>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" ></script>

  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

   <script>
           CKEDITOR.replace( 'thongtinlienhe' );
   </script>

</body>
<?php 
include ('footer.php');
?>
</html>