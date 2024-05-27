<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin dashboard</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                    <input type="email" class="form-control" id="tendangnhap" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="matkhau">
                  </div>
                  </div>
                  <a onclick="submitLogin(event)" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng nhập</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function submitLogin(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    const tendangnhap = document.getElementById('tendangnhap').value;
    const matkhau = document.getElementById('matkhau').value;

    fetch('http://localhost/shoe-api/public/api/admin/login', { // Adjust this URL to your actual login API endpoint
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tendangnhap: tendangnhap,
            matkhau: matkhau
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Đăng nhập thành công!') {
            // Redirect to the homepage if login is successful
            localStorage.setItem('admin_id', data.admin.id);
            // Redirect to the homepage or dashboard
            window.location.href = '{{ route('home') }}'; 
        } else {
            // Display an error message if login fails
            alert(data.message || 'Login failed');
        }
    })
    .catch(error => {
        console.error('Error during login:', error);
        alert('Login failed');
    });
}
  </script>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>