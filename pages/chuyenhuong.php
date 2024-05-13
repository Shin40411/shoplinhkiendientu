<?php
session_start();
require_once('../config/dbhelper.php');
$con = mysqli_connect("localhost", "root", "", "eshop");
if (isset($_SESSION['dangky'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
    $sql_getacc = mysqli_query($con, "SELECT * FROM signup WHERE id_signup='$id_khachhang'");
    $getpoint = 0;
    $row = mysqli_fetch_assoc($sql_getacc);
    $getpoint = $row['points'];
?>
    <section id="account-navigation" class="history-order featured-cars">
        <div class="container">
            <div class="row d-flex justify-center">
                <div class="mg-off panel panel-footer">
                    <label class="helloAccount">
                        Xin chào <br> <b style="color: yellow;"> <?php echo $_SESSION['dangky'] ?> </b>
                    </label>
                    <hr class="mg-off-0">
                    <div class="col-md-12">
                        <div>
                            <i class="fa fa-navicon" style="font-size: 20px;margin-right: 20px;float:left"></i>
                            <i class="fa fa-user-circle-o" style="font-size: 20px;"></i>
                            <span>
                                Bạn hiện đang có <?php echo $getpoint ?> điểm.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="nvabox">
                    <div class="col-md-6">
                        <a href="javascript:void(0);" onclick="loadPage('taikhoancuatoi','','','#myaccount')">
                            <div class="bg-info boxnavigation">
                                <i class="fa fa-address-card" style="font-size: 16px;"> Chỉnh sửa thông tin tài khoản</i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0);" onclick="loadPage('lichsudonhang','','', '#orderclient')">
                            <div class="bg-success boxnavigation">
                                <i class="fa fa-shopping-basket" style="font-size: 16px;"> Xem lịch sử mua hàng</i>
                            </div>
                        </a>
                    </div>
                    <!-- <div class="col-md-6">
                        <a href="javascript:void(0);">
                            <div class="bg-primary boxnavigation">
                                <i class="fa fa-phone" style="font-size: 16px;"> Hỗ trợ kỹ thuật qua hotline</i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                    </div> -->
                </div>
            </div>
        </div>
    </section>
<?php
    include('../content/service.php');
    include('../content/main-content.php');
}
?>