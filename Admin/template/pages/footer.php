 <footer class="footer py-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-4 mb-lg-0 mb-2">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                 <i class="fa fa-lemon"></i> 
                <a href="../../../index.php" class="font-weight-bold">ShopTraiCay.vn</a>
                chất lượng tươi ngon.
              </div>
            </div>
            <div class="col-lg-8" style="padding-right:40px">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted">Liên hệ</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link pe-0 text-muted">Chính sách</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link pe-0 text-muted">Blog</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      </div>
  </main>
    
     <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Cấu hình giao diện</h5>
          <p>Tùy chọn cấu hình.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
 <!--        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a> -->
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Nền thanh menu</h6>
          <p class="text-sm">Chọn giữa 3 loại nền thanh menu.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" style="font-size:14px" data-class="bg-gradient-dark" onclick="sidebarType(this)">Tối</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" style="font-size:14px" data-class="bg-transparent" onclick="sidebarType(this)">Trong suốt</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" style="font-size:14px" data-class="bg-white" onclick="sidebarType(this)">Trắng</button>
        </div>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Cố định thanh menu trên</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Sáng / Tối</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
      </div>
    </div>
  </div>
<?php 
include ('script.php'); 
?>
      
</body>

</html>