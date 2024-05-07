<?php 
  session_start();
  function get_user($username,$password){
    $con=mysqli_connect("localhost","root","","eshop");
    $sql =mysqli_query($con,"SELECT * FROM admin WHERE (username='$username' && password='$password')");   
  if(mysqli_num_rows($sql) > 0)
    {
      $row = mysqli_fetch_assoc($sql);
      if($row['permission'] == "0"){
         $row['privileges'] = array(
              "dashboard\.php$",
              "index\.php$",
              "index\.php\?s=$",
              "index\.php\?page=\d+\$",
              "add\.php$",
              "add\.php\?id=\d+$",
              "product\.php$",
              "product\.php\?page=\d+$",
              "addproduct\.php$",
              "addproduct\.php\?id=\d+$",
              "category\.php$",
              "category\.php\?page=\d+$",
              "addcategory\.php$",
              "addcategory\.php\?id=\d+$",
              "news\.php$",
              "news\.php\?page=\d+$",
              "addnews\.php$",
              "edit_post\.php\?idbaiviet=\d+$",
              "comment\.php$",
              "comment\.php\?disid=\d+$",
              "comment\.php\?appid=\d+$",
              "comment\.php\?page=\d+$",
              "bill\.php$",
              "bill\.php\?page=\d+$",
              "shipping\.php$",
              "shipping\.php\?page=\d+$",
              "contact\.php$",
              "Banner-slider\.php$",
              "slider\.php$",
              "editslider\.php\?id=\d+$",
              "upload\.php$",
              "member\.php$",
              "edit_member\.php\?id_admin=\d+$",
              "member\.php\?page=\d+$"
        ); 
      }elseif($row['permission'] == "1"){
         $row['privileges'] = array(
              "dashboard\.php$",
              "index\.php$",
              "index\.php\?page=\d+\$",
              "add\.php$",
              "add\.php\?id=\d+$",
              "product\.php$",
              "product\.php\?page=\d+$",
              "addproduct\.php$",
              "addproduct\.php\?id=\d+$",
              "category\.php$",
              "category\.php\?page=\d+$",
              "addcategory\.php$",
              "addcategory\.php\?id=\d+$",
              "news\.php$",
              "news\.php\?page=\d+$",
              "addnews\.php$",
              "edit_post\.php\?idbaiviet=\d+$",
              "comment\.php$",
              "comment\.php\?appid=\d+$",
              "comment\.php\?page=\d+$",
              "bill\.php$",
              "bill\.php\?page=\d+$",
              "shipping\.php$",
              "shipping\.php\?page=\d+$",
              "contact\.php$",
              "Banner-slider\.php$",
              "editslider\.php\?id=\d+$",
              "upload\.php$"
        ); 
      }elseif($row['permission'] == "2"){
         $row['privileges'] = array(
              "dashboard\.php$",
              "bill\.php$",
              "bill\.php\?page=\d+$",
              "contact\.php$"
        ); 
      }
      $_SESSION['login'] = $row;
      $_SESSION['current_user'] = $row['fullname'];
       $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (password_verify($_POST['password'], $hashed_password)){
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        header("Location: dashboard.php");
    }
  }else{
    echo "<script>alert('Tài khoản hoặc mật khẩu sai! Vui lòng đăng nhập lại.');</script>";
    }
}
?>