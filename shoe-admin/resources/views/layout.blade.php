<!doctype html>
<html lang="en">
<script>
    // Hàm kiểm tra session ID
    function checkSession() {
      // Giả sử session ID được lưu trong localStorage
      const sessionId = localStorage.getItem('admin_id');
      console.log(sessionId);

      // Kiểm tra nếu không có session ID
      if (!sessionId || sessionId === 'undefined' || sessionId === 'null' || sessionId.trim() === '') {
        // Chuyển hướng đến trang đăng nhập
        window.location.href = '{{ route('login') }}';
      }
      else {
        document.body.style.display = 'block';
      }
    }

    document.addEventListener('DOMContentLoaded', checkSession);

    function logOut() {
      // Clear the local storage
      localStorage.removeItem('khachhang_id');

      // Redirect to login page
      window.location.href = '{{ route('login') }}';
    }
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  </script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>


<body>
  
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="{{ asset('assets/images/logo.png') }}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Trang chủ</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("home")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Doanh thu</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Quản lý sản phẩm</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("sanpham.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Sản phẩm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("danhmuc.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Danh mục</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("thuonghieu.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Thương hiệu</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("size.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Size</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("mausac.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Màu sắc</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Người dùng</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("admin.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Admin</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("khachhang.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Khách hàng</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Thêm</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route("donhang.index")}}" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Đơn hàng</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">-------------------------</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">-------------------------</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img id="admin-avatar" src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35"
                    class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{ route("admin.profile") }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a onclick="logOut()" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>
  <script>
    function formatCurrencyVND(value) {
			return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
		}
    // Trong file JavaScript
document.addEventListener('DOMContentLoaded', function() {
    loadAdminAvatar();
});

function loadAdminAvatar() {
    fetch('http://localhost/shoe-api/public/api/admin/'+localStorage.getItem('admin_id'), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            // Thêm bất kỳ tiêu đề xác thực nào nếu cần
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch admin avatar');
        }
        return response.json();
    })
    .then(data => {
        // Đường dẫn ảnh avatar được trả về từ API
        const adminAvatarUrl = data.anhdaidien;
        // Cập nhật thuộc tính src của phần tử img
        document.getElementById('admin-avatar').src = "http://localhost/shoe-api/storage/app/public/avatars/"+adminAvatarUrl;
    })
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi khi không thể tải ảnh avatar của admin
    });
}

  </script>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>

</body>

</html>