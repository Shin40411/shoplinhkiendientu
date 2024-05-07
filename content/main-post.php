        <h3>Tin tức chính:</h3>
          <div class="row">
                <?php 
                 $limit = 4;
                $page  = 1;
                if (isset($_GET['page'])){
                  $page = $_GET['page'];
                }
                if($page <= 0) {
                  $page = 1;
                }
                $firstIndex = ($page-1)*$limit;
          $sql = 'select news.id_baiviet, news.tenbaiviet, news.tomtat, news.noidung, news.hinhanh, category_news.name_category category_name from news left join category_news on news.id_danhmuc = category_news.id'.' limit '.$firstIndex.','.$limit;
          $NewsList = executeResult($sql);
          $sql = 'select count(id_baiviet) as total from news where 1';
            $countResult = executeSingleResult($sql);
            $number = 0;
            if($countResult != null) {
            $count = $countResult['total'];
            $number = ceil($count/$limit);
            }
            $index = 1;
          foreach ($NewsList as $item) {
            echo'
                  <div class="col-md-3">
                    <div class="productlists">
                            <img class="img img-responsive" width="100%" src="Admin/template/pages/uploads/'.$item['hinhanh'].'">
                            <p class="title_product">'.$item['tenbaiviet'].'</p>
                        <a href="news.php?id='.$item['id_baiviet'].'" style="text-decoration: none;">
                            <p>Xem ngay</p>
                        </a>
                  </div>
                    </div>';
          }?>
               </div>
          <div class="clear"></div>
          <div style="text-align:center"><?=paginarion($number, $page, '')?></div>
                 <?php include('video.php') ?>