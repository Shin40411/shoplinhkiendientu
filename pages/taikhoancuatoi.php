<?php
session_start();
require_once('../config/dbhelper.php');
if (isset($_SESSION['dangky'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
    $con = mysqli_connect("localhost", "root", "", "eshop");
    $sql_showinfo = mysqli_query($con, "SELECT * FROM signup WHERE id_signup = '$id_khachhang'");
    $fetchData = mysqli_fetch_array($sql_showinfo);
?>
    <section id="myaccount" class="history-order featured-cars">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
                <form action="" id="updateForm" autocomplete="off" method="POST">
                    <h3 class="text-center">Chỉnh sửa thông tin tài khoản</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-center">
                            <img src="assets/images/clients/c1.png" class="avatar img-thumbnail img-circle" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="profile_details_text">Họ và tên: </label>
                                <input type="text" id="personalname" name="personalname" class="form-control" value="<?php echo $fetchData['name'] ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="profile_details_text">Email:</label>
                                <input type="email" id="personalemail" name="personalemail" class="form-control" value="<?php echo $fetchData['phone'] ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="profile_details_text">Địa chỉ:</label>
                                <input type="address" name="personaladdress" class="form-control" value="<?php echo $fetchData['address'] ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="profile_details_text">Mật khẩu:</label>
                                <div class="visiblepass">
                                    <input type="password" id="personalpassword" name="personalpassword" class="form-control" value="<?php echo $fetchData['matkhau'] ?>" >
                                    <span onclick="showPassword()" class="showpass fa fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                            <div class="form-group">
                                <button type="button" id="submitinfo" class="btn btn-success" onclick="editPersonalInfo()">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php
    include('../content/service.php');
    include('../content/main-content.php');
}
?>