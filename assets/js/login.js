var working = false;

const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

$('.login').on('submit', function (e) {
  e.preventDefault();
  if (working) return;
  var phone = $('[name="phone"]').val();
  var password = $('[name="password"]').val();
  var $this = $(this),
    $state = $this.find('button > .state');
  $.ajax({
    url: 'sign_in.php',
    type: 'POST',
    data: { phone: phone, password: password },
    dataType: 'json',
    beforeSend: function () {
      $this.addClass('loading');
      $state.html('Đang xác thực...');
      working = true;
    },
    success: function (response) {
      if (response.success) {
        setTimeout(function () {
          $this.addClass('ok');
          $state.html('Chào mừng bạn trở lại!');
          setTimeout(function () {
            window.location = "../../index.php";
            $state.html('Đăng nhập');
            $this.removeClass('ok loading');
            working = false;
          }, 900);
        }, 3000);
      } else {
        setTimeout(function () {
          $this.addClass('error');
          $state.html(response.message);
          setTimeout(function () {
            $state.html('Đăng nhập');
            $this.removeClass('error loading');
            working = false;
          }, 4000);
        }, 3000);
        working = false;
      }
    },
    error: function (xhr, status, error) {
      console.error("Lỗi khi gửi yêu cầu đăng nhập: " + error);
      $state.html('Đăng nhập');
      $this.removeClass('loading');
      working = false;
    }
  });
});

$('.signup').on('submit', function (e) {
  e.preventDefault();
  if (working) return;
  var hovaten = $('[name="hovaten"]').val();
  var email = $('[name="email"]').val();
  var matkhau = $('[name="matkhau"]').val();
  var diachi = $('[name="diachi"]').val();

  var $this = $(this),
    $state = $this.find('button > .state');
  $.ajax({
    url: 'sign_up.php',
    type: 'POST',
    data: { hovaten: hovaten, email: email, matkhau: matkhau, diachi: diachi },
    dataType: 'json',
    beforeSend: function () {
      $this.addClass('loading');
      $state.html('Đang xử lý...');
      working = true;
    },
    success: function (response) {
      if (response.success) {
        setTimeout(function () {
          $this.addClass('ok');
          $state.html('Đăng ký tài khoản thành công! Lui lòng đăng nhập lại tài khoản của bạn!');
          setTimeout(function () {
            $state.html('Đăng ký');
            $this.removeClass('ok loading');
            container.classList.remove("right-panel-active");
            working = false;
          }, 2000);
        }, 3000);
      } else {
        setTimeout(function () {
          $this.addClass('error');
          $state.html(response.message);
          setTimeout(function () {
            $state.html('Đăng ký');
            $this.removeClass('error loading');
            working = false;
          }, 4000);
        }, 3000);
        working = false;
      }
    },
    error: function (xhr, status, error) {
      console.error("Lỗi khi gửi yêu cầu đăng ký: " + xhr.responseText);
      $state.html('Đăng ký');
      $this.removeClass('loading');
      working = false;
    }
  });
});



fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => e.preventDefault());