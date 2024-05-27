@extends('../layout')

@section('content')
<style>
body {
    margin: 0;
    padding-top: 40px;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
}
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
/* CSS cho container chứa nút Đăng nhập */

</style>
<!-- Nút Đăng nhập, ban đầu được ẩn -->
<div class="login-container center"  id="login-container" style="display: none;">
    <button id="loginButton" class="btn btn-primary">Đăng nhập</button>
</div>


<div class="container container-profile" style="margin-top:50px">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
            <div class="user-avatar" style="position: relative;">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                <!-- Icon to trigger file upload -->
                <i class="fas fa-camera" id="uploadTrigger" style="position: absolute; top: 50%; left: 50%; transform: translate(20px, 15px); cursor: pointer; color: #fff; background: rgba(0, 0, 0, 0.5); border-radius: 50%; padding: 5px;"></i>
                <input type="file" id="imageUpload" style="display: none;">
            </div>
				<h5 class="user-name" id="user_name"></h5>
				<h6 class="user-email" id="user_email"></h6>
			</div>
		</div>
        <a class="flex-c-m stext-101 cl pointer" href="{{route('cart.order')}}" id="donhang" class="btn btn-primary">Quản lý đơn hàng</a>
        <button style="margin-top:100px" id="logoutButton" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
            Đăng xuất
        </button>

	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Thông tin cá nhân</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Họ tên</label>
					<input required type="text" class="form-control" id="ten" placeholder="Nhập họ tên">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="email">Email</label>
					<input required type="email" class="form-control" id="email" placeholder="Nhập email ">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="sdt">Số điện thoại</label>
					<input required type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="diachi">Địa chỉ</label>
					<input required type="name" class="form-control" id="diachi" placeholder="Nhập địa chỉ">
				</div>
			</div>
		</div>
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
					<button type="button" id="updateButton" name="updateButton" class="btn btn-primary">Cập nhật</button>
				</div>
			</div>
		</div>
	</div>
    <div class="card-body">
        <div class="form-group">
        <label for="old_password">Mật khẩu cũ</label>
        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Mật khẩu cũ" required>
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu mới</label>
        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mật khẩu mới" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Nhập lại mật khẩu mới</label>
        <input type="password" class="form-control" id="renew_password" name="renew_password" placeholder="Nhập lại mật khẩu mới" required>
    </div>
    <button type="submit" id="updatePassword"  class="btn btn-primary">Cập nhật mật khẩu</button>

    </div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userId = sessionStorage.getItem('id');
    const contentDiv = document.querySelector('.container-profile'); // Chỉnh lại selector nếu cần
    const loginButton = document.getElementById('login-container');

    if (!userId) {
        contentDiv.style.display = 'none'; // Ẩn nội dung chính
        loginButton.style.display = 'block'; // Hiển thị nút Đăng nhập

        // Bắt sự kiện click nút Đăng nhập để chuyển hướng đến trang Đăng nhập
        document.getElementById("loginButton").addEventListener('click', function() {
            window.location.href = '{{route("login")}}'; // Sử dụng route Laravel
        });
    } else {
        contentDiv.style.display = 'block'; // Hiển thị nội dung chính
        loginButton.style.display = 'none'; // Ẩn nút Đăng nhập
        loadData(); // Gọi hàm loadData nếu người dùng đã đăng nhập
    }
});

document.getElementById('logoutButton').addEventListener('click', function() {
    sessionStorage.clear();
    window.location.href = '{{route("login")}}'; 
});
document.getElementById('updatePassword').addEventListener('click', function() {
    var old_password = document.getElementById('old_password').value.trim();
    var new_password = document.getElementById('new_password').value.trim();
    var renew_password = document.getElementById('renew_password').value.trim();

    // Validate new passwords match
    if (new_password != renew_password) {
        alert("Mật khẩu mới không trùng nhau!");
        return;
    }
    
    // Validate password length
    if (new_password.length < 6) {
        alert("Mật khẩu phải hơn 6 ký tự!");
        return;
    }
    
    // Prepare data to be sent to the server
    var formData = {
        old_password: old_password,
        new_password: new_password
    };

    // Send the request to the server
    fetch('  http://localhost/shoe-api/public/api/khachhang/updatepassword/' + sessionStorage.getItem('id'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json().then(data => ({ status: response.status, data: data })))
    .then(result => {
        if (result.status == 200) {
            console.log('Success:', result.data);
            document.getElementById('old_password').value = ""
            document.getElementById('new_password').value = ""
            document.getElementById('renew_password').value = ""
            alert("Cập nhật mật khẩu thành công!");
        } else {
            alert( "Không đúng mật khẩu!");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Có lỗi xảy ra!");
    });
});




    document.getElementById('updateButton').addEventListener('click', function() {
        // Gather input data
        var ten = document.getElementById('ten').value.trim();
        var email = document.getElementById('email').value.trim();
        var sdt = document.getElementById('sdt').value.trim();
        var diachi = document.getElementById('diachi').value.trim();

        // Basic validation
        if (ten=="" || email=="" || sdt=="" || diachi=="") {
            alert("Vui lòng nhập đủ trường dữ liệu!")
            return;
        }

        // Email validation (simple pattern)
        if (!validateEmail(email)) {
            alert("Email không hợp lệ!")
            return;
        }

        // Prepare data for API request
        var formData = {
            ten: ten,
            email: email,
            sdt: sdt,
            diachi: diachi
        };

        // Fetch API to send data to your server
        fetch('  http://localhost/shoe-api/public/api/khachhang/updateprofile/'+sessionStorage.getItem('id'), {  // Replace YOUR_API_ENDPOINT with your actual API endpoint
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            alert("Cập nhật thông tin thành công!")
        })
        .catch((error) => {
            console.error('Error:', error);
            alert("Có lỗi xảy ra khi cập nhật!")
        });
    });

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
    return re.test(String(email).toLowerCase());
}
document.addEventListener('DOMContentLoaded', function() {
    loadData()

    document.getElementById('uploadTrigger').addEventListener('click', function() {
        document.getElementById('imageUpload').click();
    });
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var formData = new FormData();
        formData.append('image', file); // Adjust 'image' depending on your API's expected parameter
        formData.append('id', sessionStorage.getItem('id'));

        fetch(`  http://localhost/shoe-api/public/api/khachhang/${sessionStorage.getItem('id')}/update-avatar`, { // Adjust this endpoint
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the avatar image
                document.querySelector('.user-avatar img').src = URL.createObjectURL(file);
                alert("Cập nhật ảnh đại diện thành công!")
            } else {
                alert("Cập nhật ảnh đại diện thất bại!")
            }
        })
        .catch(error => console.error('Error:', error));
    });
    
});

function loadData() {
    fetch('  http://localhost/shoe-api/public/api/khachhang/'+sessionStorage.getItem('id'), {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to fetch');
        return response.json();
    })
    .then(user => {
        document.getElementById('ten').value = user.ten || '';
        document.getElementById('email').value = user.email || '';
        document.getElementById('sdt').value = user.sdt || '';
        document.getElementById('diachi').value = user.diachi || '';

        if (document.getElementById('user_name')) {
            document.getElementById('user_name').textContent = user.ten || '';
        }
        if (document.getElementById('user_email')) {
            document.getElementById('user_email').textContent = user.email || '';
        }
        // Set the image if you have an img tag
        var imageUrl = user.anhdaidien;

        // Check if the imageUrl starts with 'https'
        if (imageUrl.startsWith('https')) {
            // If it starts with 'https', use as is
            document.querySelector('.user-avatar img').src = imageUrl;
        } else {
            // If it doesn't start with 'https', prepend the local server path
            document.querySelector('.user-avatar img').src = "  http://localhost/shoe-api/storage/app/public/avatars/" + imageUrl;
        }

    })
    .catch(error => console.error('Error:', error));
}


</script>

@endsection