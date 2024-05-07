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
   Thêm bài viết
  </title>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm Bài Viết</h2>
			</div>
			<div class="panel-body">
			<form method="post" action="control.php" enctype="multipart/form-data">
					<div class="form-group">
					  <label for="tenbaiviet">Tên Bài viết:</label>
					  <input type="text" name="id" hidden="true">
					  <input required="true" type="text" class="form-control"  name="tenbaiviet" >
					</div>
					<div class="form-group">
					  <label for="hinhanh">Thumbnail:</label>					 
					  <input type="file" name="hinhanh">
					</div>	
					<div class="form-group">
					  <label for="tomtat">Tóm tắt:</label>			 
					 <textarea class="form-control" style="resize: none" rows="5" name="tomtat"></textarea>
					</div>
						<div class="form-group">
					  <label for="noidung">Nội dung:</label>					 
					 <textarea class="form-control" style="resize: none" rows="5" name="noidung"></textarea>
					</div>		
					<div class="form-group">
					  <label for="danhmuc">Chọn Danh Mục:</label>					 
					  <select class="form-control" name="danhmuc" >
					  	<option>-- Lựa chọn danh mục --</option>		
					  		<?php
					$con=mysqli_connect("localhost","root","","eshop");
	    		$sql_danhmuc = mysqli_query($con,"SELECT * FROM category_news ORDER BY id DESC");
	    		while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
	    		?>
	    		<option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name_category'] ?></option>
	    		<?php
	    		} 
	    		?>		  	
					  </select>
					</div>	
					<input type="submit" name="thembaiviet" value="Lưu" style="width:10%; height:40px;">
				</form>
			</div>						
		</div>
	</div>
  </div>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" ></script>

  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

   <script>
           CKEDITOR.replace( 'tomtat' );
   </script>

   <script>
           CKEDITOR.replace( 'noidung' );
   </script>

</body>
<?php 
include ('footer.php');
?>
</html>