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
$sql_lietke_dh = mysqli_query($con, "SELECT * FROM orders,signup WHERE orders.id_khachhang=signup.id_signup ORDER BY orders.id ASC" . ' limit ' . $firstIndex . ',' . $limit);
$sql = 'select count(id) as total from orders where 1';
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
        Quản lý đơn hàng
    </title>
    <!--   <style>
main.main-content.position-relative.max-height-vh-100.h-100.border-radius-lg {
    margin-left: 125px;
}
  </style> -->
    <div class="container-fluid py-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản Lý đơn hàng</h2>
            </div>
            <div class="" style="margin-top:50px"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-light table-hover align-items-center mb-0">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th width="40px">Mã đơn hàng</th>
                                            <th style="text-align: center;">Họ tên</th>
                                            <th>Email</th>
                                            <th>Hình thức thanh toán</th>
                                            <th>Tình trạng</th>
                                            <th>Ngày đặt</th>
                                            <th width="50px">In đơn</th>
                                            <!-- <th width="50px"></th> -->
                                        </tr>
                                    </thead>
                                    <?php
                                    $index = 1;
                                    while ($item = mysqli_fetch_array($sql_lietke_dh)) {
                                    ?>
                                        <tr>

                                            <td style="text-align: center;"><?php echo $item['code_order'] ?></td>
                                            <td style="text-align: center;"><?php echo $item['name'] ?></td>
                                            <td style="padding-left:6px;"><?php echo $item['phone'] ?></td>
                                            <td style="padding-left:45px;"><?php echo $item['order_payment'] ?></td>
                                            <td style="padding-left:37px;">
                                                <?php if ($item['status'] == 1) {
                                                    echo '<a href="solve.php?code=' . $item['code_order'] . '"><button class="btn btn-success" ><i class="fa fa-refresh fa-spin"></i></button></a>';
                                                } else {
                                                    echo '<i class="fa fa-check"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="padding-left:0px;"><?php echo $item['order_date'] ?></td>
                                            <td style="padding-left: 42px;"><a href="bill_printing.php?action=xemdonhang&code=<?php echo $item['code_order'] ?>" target="_blank"><i class="fa fa-print" style="font-size: 22px;vertical-align: middle;"></i></a></td>
                                            <!-- <td align="center">
            <button class="btn btn-danger" onclick="deleteBill(
                <?php
                                        // echo $item['id']
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
                <?= paginarion($number, $page, '') ?>
            </div>
        </div>

        <script type="text/javascript">
            function deleteBill(id) {
                var option = confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')
                if (!option) {
                    return;
                }

                console.log(id)
                //ajax - xu ly lenh post
                $.post('ajaxbill.php', {
                    'id': id,
                    'action': 'delete'
                }, function(data) {
                    location.reload()
                })
            }
        </script>
        <?php
        include('footer.php');
        ?>