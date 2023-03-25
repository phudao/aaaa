<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GIAO CA ĐIỆN TỬ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Giao Ca
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nhật kí</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addlog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ghi nhật ký</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/report_weekly" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Báo cáo</p>
                </a>
              </li>
              
              <!--<li class="nav-item">
                <a href="http://localhost:8000/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Người dùng</p>
                </a>
              </li>-->
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Ca kíp trực
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/calendar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lịch trực</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/changepassword" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đổi mật khẩu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>