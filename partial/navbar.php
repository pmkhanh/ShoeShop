<header class="bg-white w-100 border border-secondary">
      <div class="container">
        <div class="d-flex align-items-center py-3 justify-content-between">
          <div  class="d-flex align-items-center">
            <div  class="logo gradient-text" style='margin-right: 60px;'>
            <a href="./index.php" style='text-decoration: none'>SPing</a>
        </div>
            <div class="input-group d-none d-md-flex">
              <form action="index.php" method="get">
                <input name='search' autocomplete="off" type="text" class="form-control rounded" placeholder="Tìm kiếm"/>
              </form>
            </div>
          </div>
          <div  class="d-flex">
            <div  class="">
              <ul class="nav d-flex gap-3">
                <li class="nav-item rounded-2 d-flex align-items-center">
                  <a  href="./order.php" style='text-decoration: none'>Quản lý đơn hàng</a>
                </li>

                <li class="nav-item rounded-2 d-flex align-items-center">
                  <?php if(isset($_SESSION['dangnhap'])){ ?>
                  <a  href="./logout.php" style='text-decoration: none'>Đăng xuất</a>
                  <?php }elseif(!isset($_SESSION['dangnhap'])){ ?>
                    <a  href="./login.php" style='text-decoration: none'>Đăng nhập</a>
                    <?php }?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>