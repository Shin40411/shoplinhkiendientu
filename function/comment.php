<?php
if (isset($_POST['cmt'])) {

    $comment = $_POST['comment'];
    if (isset($_SESSION['dangky'])) {
        $id_product = $_GET['id'];
        $account_id = mysqli_fetch_array($con->query("SELECT * FROM signup WHERE name='" . $_SESSION['dangky'] . "'"));
        $account_id = $account_id['id_signup'];
        $st1 = '0';
        $con->query("INSERT INTO comment(comments,id_account,id_product,status) VALUE ('" . $comment . "','" . $account_id . "','" . $id_product . "','" . $st1 . "')");
        echo "<script>alert('Bình luận thành công, chờ phê duyệt!');</script>";
    }
}
?>