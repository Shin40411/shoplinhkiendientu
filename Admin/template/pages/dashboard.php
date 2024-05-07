<?php
require('function.php');
if (!isset($_SESSION['login'])) {
  header("Location: sign-in.php");
}
?>
<?php
include('header.php');
require_once('../../../db/dbhelper.php');
?>
<?php
$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_doanhthu = mysqli_query($con, "SELECT SUM(doanhthu) AS value_sum FROM statistical WHERE doanhthu > 1");

$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_views = mysqli_query($con, "SELECT SUM(views) AS value_view FROM product WHERE views > 0");

$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_sanpham = mysqli_query($con, "SELECT COUNT(id) AS total from product");

$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_binhluan = mysqli_query($con, "SELECT COUNT(id_comment) AS binhluan from comment");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <title>
    Thống kê
  </title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý thống kê</h2>
      </div>
      <div class="col-lg-12" style="margin-top:10px">

        <div class="row mt-4">
          <div class="col-lg-4 col-md-8 mt-4 mb-4">
            <div class="card z-index-2 ">
              <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">   -->
              <div class="chart">
                <div id="chart" style="height: 250px;width:100%"></div>
              </div>
              <!--  </div> -->
              <div class="card-body">
                <h6 class="mb-0 "><strong>Thống kê đơn hàng theo: <span id="text-date"></span></strong></h6>
                <p class="text-sm ">
                  <select class="select-date">
                    <option value="365ngay">365 ngày qua</option>
                    <option value="90ngay">90 ngày qua</option>
                    <option value="28ngay">28 ngày qua</option>
                    <option value="7ngay">7 ngày qua</option>
                  </select>
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-8 mt-4 mb-4">
            <?php
            while ($row = mysqli_fetch_array($sql_doanhthu)) {
            ?>
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa fa-dollar"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Tổng doanh thu</p>
                    <h4 class="mb-0"><?php echo number_format($row['value_sum'], 0, ',', '.') . ' vnđ' ?></h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">%</span> Số doanh thu bán được</p>
                </div>
              </div>
            <?php } ?>
            <div style="margin-top:57px"></div>
            <?php
            while ($row = mysqli_fetch_array($sql_sanpham)) {
            ?>
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class='fas fa-apple-alt'></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Tổng số sản phẩm</p>
                    <h4 class="mb-0"><?php echo $row['total'] ?> sản phẩm</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">%</span> Số sản phẩm hiện có</p>
                </div>
              </div>
          </div>
        <?php } ?>
        <div class="col-lg-4 col-md-8 mt-4 mb-4">
          <?php
          while ($row = mysqli_fetch_array($sql_views)) {
          ?>
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-eye"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Tổng lượt xem sản phẩm</p>
                  <h4 class="mb-0"><?php echo $row['value_view'] ?> lượt xem</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">%</span> Số lượt xem toàn sản phẩm</p>
              </div>
            </div>
          <?php } ?>

          <?php
          while ($row = mysqli_fetch_array($sql_binhluan)) {
          ?>
            <div style="margin-top:57px"></div>
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-comments-o"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Tổng số bình luận sản phẩm</p>
                  <h4 class="mb-0"><?php echo $row['binhluan'] ?> bình luận</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">%</span> Bình luận của khách hàng mỗi ngày</p>
              </div>
            </div>
          <?php } ?>
        </div>
        </div>
      </div>


    </div>

    <script type="text/javascript">
      $(document).ready(function() {
        thongke();
        var char = new Morris.Bar({

          element: 'chart',

          xkey: 'date',

          ykeys: ['date', 'order', 'sales', 'quantity'],

          labels: ['Trong năm', 'Đơn hàng', 'Doanh thu', 'Số lượng']
        });
        $('.select-date').change(function() {
          var thoigian = $(this).val();
          if (thoigian == '7ngay') {
            var text = '7 ngày qua';
          } else if (thoigian == '28ngay') {
            var text = '28 ngày qua';
          } else if (thoigian == '90ngay') {
            var text = '90 ngày qua';
          } else {
            var text = '365 ngày qua';
          }
          $.ajax({
            url: "charts.php",
            method: "POST",
            dataType: "JSON",
            data: {
              thoigian: thoigian
            },
            success: function(data) {
              char.setData(data);
              $('#text-date').text(text);
            }
          });
        })

        function thongke() {
          var text = '365 ngày qua';
          $('#text-date').text(text);
          $.ajax({
            url: "charts.php",
            method: "POST",
            dataType: "JSON",
            success: function(data) {
              char.setData(data);
              $('#text-date').text(text);
            }
          });
        }
      });
    </script>

    <?php
    include('footer.php');
    ?>