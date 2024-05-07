<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../config/dbhelper.php');
$con=mysqli_connect("localhost","root","","eshop");
	$sql_lietkebanner = mysqli_query($con,"SELECT * FROM banner");
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
   Liệt kê banner
  </title>
<div class="container-fluid py-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý banner</h2>
			</div>
			<div class="panel-body" style="margin-top: 6%;">
				 <?php if (checkPrivilege('slider.php')) { ?>
				 <div class="row">
				 	 <div class="col-lg-6">
			<a href="slider.php">
				<button class="btn btn-success" style="margin-bottom: 15px;">Thêm banner</button>
			</a>	
		</div>
		</div>
		  <?php } ?>
			<div class="row">
			 <div class="col-12">
			 	<div class="card-body px-0 pb-2">
			 		<div class="table-responsive p-0">
			<table class="table table-light table-hover align-items-center mb-0">
				<thead class="thead-dark">
					<tr>
						<th>Hình Ảnh</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
				  while($row = mysqli_fetch_array($sql_lietkebanner)){
  				?>
		<tr>

			<td>
				<img src="uploads/<?php echo $row['hinhanh'] ?>"  style="max-width: 100%"> 
				<br> 
				<img src="uploads/<?php echo $row['hinhanh2'] ?>"   style="margin-top: 10%; max-width: 100%">
				<br> 
				<img src="uploads/<?php echo $row['hinhanh3'] ?>"   style="margin-top: 10%; max-width: 100%">
			</td>
			<td>
			<a href="editslider.php?id=<?php echo $row['id'] ?>"><button class="btn btn-warning">Sửa</button></a> 
			</td>
		</tr>
		<?php
			  } 
			  ?>
				</tbody>
			</table>
			</div>
		</div>
		</div>
	</div>
		</div>
	</div>

<?php 
include ('footer.php'); 
?>