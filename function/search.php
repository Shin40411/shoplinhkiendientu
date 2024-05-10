<?php
require_once('../config/dbhelper.php');

function getCategory()
{
    $excecute = array();
    $sql_cate = 'select * from category';
    $excecute = executeResult($sql_cate);

    return json_encode($excecute);
}

function searching()
{
    $con = mysqli_connect("localhost", "root", "", "eshop");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = json_decode(file_get_contents("php://input"), true);
        $yearproduce = $data['yearproduce'];
        $views = $data['views'];
        $price = $data['price'];
        $category = $data['category'];
        $keyword = $data['keyword'];

        $conditions = [];

        if (!empty($keyword)) {
            $conditions[] = "(title LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        }

        if (!empty($yearproduce)) {
            $conditions[] = "(YEAR(created_at) = $yearproduce)";
        }

        if (!empty($category)) {
            $conditions[] = "(id_category = '$category')";
        }

        $whereClause = implode(" AND ", $conditions);

        $orderPrice = ($price == "0") ? "price DESC" : "price ASC";
        $orderViews = ($views == "0") ? "views DESC" : "views ASC";

        $sql_searching = mysqli_query(
            $con,
            "SELECT * 
            FROM product 
            " . ($whereClause ? "WHERE $whereClause" : "") . "
            ORDER BY $orderViews, $orderPrice"
        );

        $countlst = mysqli_num_rows($sql_searching);

        $renderHtml = '';
        $renderHtml .= '<section class="featured-cars">';
        $renderHtml .= '<div class="container">';
        $renderHtml .= '<div class="section-header">';
        $renderHtml .= '<h2>Tìm thấy ' . $countlst . ' kết quả</h2>';
        $renderHtml .= '</div>';
        $renderHtml .= '<div class="featured-cars-content">';

        while ($item = mysqli_fetch_assoc($sql_searching)) {
            $arrayCount[] = $item;
            $renderHtml .= '<div class="col-lg-3 col-md-4 col-sm-6">';
            $renderHtml .= '<div class="single-featured-cars searchresult">';
            $renderHtml .= '<div class="featured-img-box">';
            $renderHtml .= '<div class="featured-cars-img">';
            $renderHtml .= "<a class='scroll' href='javascript:void(0);' onclick=\"loadPage('chitietsanpham', '{$item['id']}', '{$item['id_category']}', '#detail-pro')\">";
            $renderHtml .= "<img src='Admin/template/pages/uploads/{$item['thumbnail']}'/>";
            $renderHtml .= '</a>';
            $renderHtml .= '</div>';
            $renderHtml .= '<div class="featured-model-info">';
            $renderHtml .= '<p>' . $item['title'] . '</p>';
            $renderHtml .= "<button class='addcart' type='button' onclick='addToCart({$item['id']})' name='themgiohang'>+<i class='fa fa-shopping-cart'></i></button>";
            $renderHtml .= '</div>';
            $renderHtml .= '</div>';
            $renderHtml .= '<div class="featured-cars-txt">';
            $renderHtml .= '<h2>';
            $renderHtml .= "<a class='scroll' href='javascript:void(0);' onclick=\"loadPage('chitietsanpham', '{$item['id']}', '{$item['id_category']}', '#detail-pro')\">{$item['title']}</a>";
            $renderHtml .= '</h2>';
            $renderHtml .= "<h3>Giá: " . number_format($item['price'], 0, ',', '.') . " vnđ</h3>";
            $renderHtml .= '</div>';
            $renderHtml .= '</div>';
            $renderHtml .= '</div>';
        }
        $renderHtml .= '</div>';
        $renderHtml .= '</div>';
        $renderHtml .= '</div>';

        $arrayHtml = array(
            'RenderHtml' => $renderHtml
        );

        return json_encode($arrayHtml);
    }
}

if (isset($_GET['function']) || isset($_POST['function'])) {
    $function = isset($_GET['function']) ? $_GET['function'] : $_POST['function'];
    switch ($function) {
        case 'getCategory':
            echo getCategory();
            break;
        case 'searching':
            echo searching();
            break;
        default:
            echo 'Invalid function';
            break;
    }
}
