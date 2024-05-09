<?php
session_start();
if (!isset($_SESSION['dangky'])) {
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Linh kiện e-shop | Đăng nhập</title>
    <link rel="shortcut icon" type="image/icon" href="../../assets//logo/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/login.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="back-to-home">
            <a href="../../index.php" class="comeback">
                <i class="fa fa-arrow-left"></i>
                Quay lại</a>
        </div>
        <div class="container">
            <div class="container__form container--signup">
                <form action="#" class="form signup" method="POST" id="form1">
                    <h2 class="form__title">Đăng ký tài khoản</h2>
                    <input type="text" placeholder="Họ và tên" autocomplete="off" name="hovaten" class="input" required />
                    <!-- <i class="fa fa-user"></i> -->
                    <input type="email" placeholder="Email" autocomplete="off" name="email" class="input" required />
                    <!-- <i class="fa fa-email"></i> -->
                    <input type="address" placeholder="Địa chỉ" autocomplete="off" name="diachi" class="input" />
                    <!-- <i class="fa fa-address"></i> -->
                    <input type="password" placeholder="Mật khẩu" name="matkhau" class="input" required />
                    <!-- <i class="fa fa-key"></i> -->
                    <button type="submit" class="btn" name="dangky">
                    <i class="spinner"></i>
                    <span class="state">Đăng ký</span>
                    </button>
                </form>
            </div>
            <div class="container__form container--signin">
                <form class="form login" method="POST" id="form2">
                    <h2 class="form__title">Đăng nhập tài khoản</h2>
                    <input type="text" name="phone" class="input" placeholder="Email của tài khoản..." autocomplete="off" autofocus required />
                    <!-- <i class="fa fa-user"></i> -->
                    <input type="password" autocomplete="off" class="input pass" name="password" placeholder="Mật khẩu" required />
                    <!-- <i class="fa fa-key"></i> -->
                    <!-- <a href="#">Quên mật khẩu?</a> -->
                    <button type="submit" class="btn" name="dangnhap">
                        <i class="spinner"></i>
                        <span class="state">Đăng nhập</span>
                    </button>
                </form>
            </div>
            <div class="container__overlay">
                <div class="overlay">
                    <div class="overlay__panel overlay--left">
                        <div class="d-flex">
                            <h3 class="animate-charcter"><i>Linh kiện E-shop</i></h3>
                        </div>
                        <button class="btn" id="signIn">Đăng nhập tài khoản</button>
                    </div>
                    <div class="overlay__panel overlay--right">
                        <div class="d-flex">
                            <h3 class="animate-charcter"><i>Linh kiện E-shop</i></h3>
                        </div>
                        <button class="btn" id="signUp">Đăng ký tài khoản</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../../assets/js/login.js"></script>
</body>

</html>

<?php 
}else{
    header('Location: ../../index.php');
    exit;
}
?>