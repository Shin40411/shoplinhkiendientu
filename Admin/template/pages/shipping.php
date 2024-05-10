<?php
require('function.php');
if (!isset($_SESSION['login'])) {
  header('Location: sign-in.php');
}
?>
<?php
include('header.php');
require_once('../../../config/dbhelper.php');
require_once('../../../common/utility.php');
?>
<?php
$limit = 3;
$page  = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
if ($page <= 0) {
  $page = 1;
}
$firstIndex = ($page - 1) * $limit;
$con = mysqli_connect("localhost", "root", "", "eshop");
$sql_ship = mysqli_query($con, "SELECT * FROM shipping,signup WHERE shipping.id_dangky=signup.id_signup ORDER BY shipping.id_shipping ASC" . ' limit ' . $firstIndex . ',' . $limit);
$sql = 'select count(id_shipping) as total from shipping where 1';
$countResult = executeSingleResult($sql);
$number = 0;
if ($countResult != null) {
  $count = $countResult['total'];
  $number = ceil($count / $limit);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
    Thông tin giao hàng
  </title>
  <div class="container-fluid py-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý thông tin giao hàng</h2>
      </div>
      <div style="margin-top:50px"></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-12">
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-light table-hover align-items-center mb-0">
                  <thead class="thead-dark">
                    <tr>
                      <th>STT</th>
                      <th>Email người gửi</th>
                      <th>Họ tên người nhận</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ người nhận</th>
                      <th>Ghi chú</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <?php
                  $index = 1;
                  while ($item = mysqli_fetch_array($sql_ship)) {
                  ?>
                    <tr>
                      <td style="padding-left:32px"><?php echo ++$firstIndex ?></td>
                      <td><?php echo $item['phone'] ?></td>
                      <td style="padding-left:33px;"><?php echo $item['fullname'] ?></td>
                      <td style="padding-left:30px"><?php echo $item['phone_number'] ?></td>
                      <td style="padding-left:30px"><?php echo $item['addresses'] ?></td>
                      <td><?php echo $item['note'] ?></td>
                      <!-- <td>
                        <button class="btn btn-danger" onclick="deleteShipping(
                    <?php
                    // echo $item['id_shipping']
                    ?>
                     )"><i class="fa fa-trash"></i></button>
                      </td> -->
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Phân Trang -->
        <?= paginarion($number, $page, '') ?>
      </div>
    </div>

    <script type="text/javascript">
      function deleteShipping(id) {
        var option = confirm('Bạn có chắc chắn muốn xóa thông tin này không?')
        if (!option) {
          return;
        }
        console.log(id)
        //ajax - xu ly lenh post
        $.post('ajaxship.php', {
          'id_shipping': id,
          'action': 'delete'
        }, function(data) {
          location.reload()
        })
      }
    </script>
    <?php
    include('footer.php');
    ?>