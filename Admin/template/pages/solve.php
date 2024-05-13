<?php
include('../../../config/dbhelper.php');
require('../../../Carbon/autoload.php');
$now = date('Y-m-d');
function stackPoints(&$points, $stackAmount)
{
    $points += $stackAmount;
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $con = mysqli_connect("localhost", "root", "", "eshop");
    $sql = mysqli_query($con, "UPDATE orders SET status=0 WHERE code_order='" . $code . "'");
    $sql_getid = mysqli_query($con, "SELECT id_khachhang FROM orders WHERE code_order='" . $code . "'");

    if ($sql_getid) {
        $currentpoint = 0;
        $id_kh = 0;

        $row = mysqli_fetch_assoc($sql_getid);
        $id_kh = $row['id_khachhang'];

        $sql_getaccount = mysqli_query($con, "SELECT * FROM signup WHERE id_signup='" . $id_kh . "'");

        $row_point = mysqli_fetch_assoc($sql_getaccount);
        $currentpoint = $row_point['points'];

        $sql_getApplyPoint = mysqli_query($con, "SELECT apply_point FROM orders WHERE code_order='" . $code . "'");

        $getApplyPoint = mysqli_fetch_assoc($sql_getApplyPoint);

        //thống kê
        $sql_lietke_dh = mysqli_query(
            $con,
            "SELECT * 
        FROM order_detail,product 
        WHERE order_detail.product_id=product.id 
        AND order_detail.code_order='$code' 
        ORDER BY order_detail.id DESC"
        );

        $sql_thongke = mysqli_query($con, "SELECT * FROM statistical WHERE ngaydat='$now'");

        $soluongmua = 0;
        $doanhthu   = 0;
        while ($row = mysqli_fetch_array($sql_lietke_dh)) {
            $soluongmua += $row['soluongmua'];
            $doanhthu += $row['price'];
        }
        if (mysqli_num_rows($sql_thongke) == 0) {
            $soluongban = $soluongmua;
            if ($getApplyPoint == true) {
                $doanhthu = $doanhthu - $currentpoint;//neu co ap dung tich diem thi tru so diem tich
                $donhang    = 1;
                $sql_update_thongke = mysqli_query(
                    $con,
                    "INSERT INTO statistical (ngaydat,soluongban,doanhthu,donhang) VALUE('$now','$soluongban','$doanhthu','$donhang')"
                );
                if ($sql_update_thongke) {
                    $currentpoint = 0;
                }
            } else {
                $doanhthu = $doanhthu;
                $donhang    = 1;
                $sql_update_thongke = mysqli_query(
                    $con,
                    "INSERT INTO statistical (ngaydat,soluongban,doanhthu,donhang) VALUE('$now','$soluongban','$doanhthu','$donhang')"
                );
            }
        } elseif (mysqli_num_rows($sql_thongke) != 0) {
            while ($row_tk   = mysqli_fetch_array($sql_thongke)) {
                $soluongban = $row_tk['soluongban'] + $soluongban;
                if ($getApplyPoint == true) {
                    $doanhthu   = $row_tk['doanhthu'] + $doanhthu;
                    $doanhthu = $doanhthu - $currentpoint; //neu co ap dung tich diem thi tru so diem tich
                    $donhang    = $row_tk['donhang'] + 1;
                    $sql_update_thongke = mysqli_query($con, "UPDATE statistical SET soluongban='$soluongban',doanhthu='$doanhthu',donhang='$donhang' WHERE ngaydat='$now'");
                    if ($sql_update_thongke) {
                        $currentpoint = 0;
                    }
                } else {
                    $doanhthu   = $row_tk['doanhthu'] + $doanhthu;
                    $donhang    = $row_tk['donhang'] + 1;
                    $sql_update_thongke = mysqli_query($con, "UPDATE statistical SET soluongban='$soluongban',doanhthu='$doanhthu',donhang='$donhang' WHERE ngaydat='$now'");
                }
            }
        }

        //cong diem tich luy sau khi ket doanh thu
        $points = 10;
        if ($sql_getaccount) {
            stackPoints($currentpoint, $points);

            $sql_updatepoint = mysqli_query($con, "UPDATE signup SET points='" . $currentpoint . "' WHERE id_signup='" . $id_kh . "'");
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
