<div class="row">
  <div class="col-md-12">
    <div class="model-search-content">
      <div class="row">
        <form action="" autocomplete="off" method="POST">
          <div class="col-md-offset-1 col-md-2 col-sm-12">
            <div class="single-model-search">
              <h2>Thời gian sản xuất</h2>
              <div class="model-select-icon">
                <select class="form-control" id="searchyear">
                  <option value="">Chọn năm</option>
                  <option value="2024">2024</option>
                  <option value="2023">2023</option>
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                </select>
              </div>
            </div>
            <div class="single-model-search">
              <h2>Giá tiền</h2>
              <div class="model-select-icon">
                <select class="form-control" id="searchprice">
                  <option value="">Trong khoảng</option>
                  <option value="0">Cao -> thấp</option>
                  <option value="1">Thấp -> cao</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-offset-1 col-md-2 col-sm-12">
            <div class="single-model-search">
              <h2>Lượt xem</h2>
              <div class="model-select-icon">
                <select class="form-control" id="searchviews">
                  <option value="">Trong khoảng</option>
                  <option value="0">Cao -> thấp</option>
                  <option value="1">Thấp -> cao</option>
                </select>
              </div>
            </div>
            <div class="single-model-search">
              <h2>Danh mục</h2>
              <div class="model-select-icon">
                <select class="form-control" id="cate">
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="single-model-search text-center">
              <button class="welcome-btn model-search-btn" type="button" id="searchsubmission" onclick="search()">
                <i class="fa fa-search" style="font-size: 30px"></i>
              </button>
            </div>
          </div>
          <div class="col-md-offset-1 col-md-2 col-sm-12">
            <div class="single-model-search" style="display: flex;height:200px">
              <div style="align-self: center;">
                <h2>Từ khóa</h2>
                <div>
                  <input type="text" id="searchkeyword" style="width: 225px;max-width: 100%;" class="form-control" placeholder="Nhập từ khóa...">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

