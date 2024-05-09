<div class="container">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
        <form action="" method="POST">
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
                        <input type="text" name="personalname" class="form-control" value="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Email:</label>
                        <input type="email" name="personalemail" class="form-control" value="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Số điện thoại:</label>
                        <input type="tel" name="personalphone" class="form-control" value="" required pattern=[0-9]{10}>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Địa chỉ:</label>
                        <input type="address" name="personaladdress" class="form-control" value="" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="profile_details_text">Mật khẩu:</label>
                        <div class="visiblepass">
                            <input type="password" id="personalpassword" name="personalpassword" class="form-control" value="" required>
                            <span onclick="showPassword()" class="showpass fa fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Cập nhật">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>