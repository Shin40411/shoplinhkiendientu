<?php
require('function.php');
if (!isset($_SESSION['login'])) {
  header("Location: sign-in.php");
}
?>
<?php
require_once('../../../config/dbhelper.php');
require_once('../../../common/utility.php');
?>
<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>
    Quản lý thành viên
  </title>
  <div class="container-fluid py-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Quản Lý thành viên</h2>
      </div>
      <div class="" style="margin-top:50px"></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-6">
            <a href="addmember.php">
              <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Thành Viên</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-light table-hover align-items-center mb-0">
                  <thead class="thead-dark">
                    <tr>
                      <th width="40px;">STT</th>
                      <th>Tài khoản</th>
                      <th style="padding-left:20px;">Họ và tên</th>
                      <!-- <th>Mật khẩu</th> -->
                      <th>Vai trò</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
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
                    $sql_member = mysqli_query($con, 'select * from admin where permission!=0' . ' limit ' . $firstIndex . ',' . $limit);
                    $sql = 'select count(id_admin) as total from admin where 1';
                    $countResult = executeSingleResult($sql);
                    $number = 0;
                    if ($countResult != null) {
                      $count = $countResult['total'];
                      $number = ceil($count / $limit);
                    }
                    $index = 1;
                    while ($item = mysqli_fetch_array($sql_member)) {
                    ?>
                      <tr>
                        <td style="text-align: center;"><?php echo ++$firstIndex ?></td>
                        <td style="padding-left:29px;"><?php echo $item['username'] ?></td>
                        <td style="padding-left:36px;"><?php echo $item['fullname'] ?></td>
                        <!-- <td style="padding-left:24px;"> -->
                        <?php
                        // echo $item['password'] 
                        ?>
                        <!-- </td> -->
                        <td style="padding-left:26px;">
                          <?php if ($item['permission'] == 1) {
                            echo 'Quản lý';
                          } else {
                            echo 'Nhân viên';
                          }
                          ?>
                        </td>
                        <td width="50px">
                          <a href="edit_member.php?id_admin=<?php echo $item['id_admin'] ?>"><button class="btn btn-warning">Sửa</button></a>
                        </td>
                        <td width="50px">
                          <button class="btn btn-danger" onclick="deleteMem(<?php echo $item['id_admin'] ?>)"><i class="fa fa-trash"></i></button>
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
        <?= paginarion($number, $page, '') ?>
      </div>
    </div>

    <script type="text/javascript">
      function deleteMem(id_admin) {
        var option = confirm('Bạn có chắc chắn muốn xóa thành viên này không?')
        if (!option) {
          return;
        }

        console.log(id_admin)
        //ajax - xu ly lenh post
        $.post('ajaxmem.php', {
          'id_admin': id_admin,
          'action': 'delete'
        }, function(data) {
          location.reload()
        })
      }
    </script>
    <?php
    include('footer.php');
    ?>