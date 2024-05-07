  <?php
  session_start();
  try {
    if (isset($_POST['phone']) && isset($_POST['password'])) {
      $phone = $_POST['phone'];
      $password = md5($_POST['password']);
      $con = mysqli_connect("localhost", "root", "", "eshop");
      $sql = "SELECT * FROM signup WHERE phone='" . $phone . "' AND passwords='" . $password . "' LIMIT 1";
      $row = mysqli_query($con, $sql);
      $count = mysqli_num_rows($row);

      if ($count > 0) {
        $row_data = mysqli_fetch_array($row);
        $_SESSION['dangky'] = $row_data['name'];
        $_SESSION['phone'] = $row_data['phone'];
        $_SESSION['id_khachhang'] = $row_data['id_signup'];
        echo json_encode(array("success" => true));
      } else {
        echo json_encode(array("success" => false, "message" => "Tài khoản không tồn tại"));
      }
    }
    } catch (Exception $ex) {
      echo json_encode(array("success" => false, "message" => $ex->getMessage()));
  }
  ?>
  