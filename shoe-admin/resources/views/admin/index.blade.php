@extends('../layout')

@section('content')
<style>
    .btn-status, .btn-role, .btn-action {
        cursor: pointer;
        pointer-events: auto;
    }
</style>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAdminModal">Thêm Admin</button>
<div class="card">
    <h5 class="card-header">Danh sách Admin</h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th>Chức vụ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="adminList">
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetchAdmins();
});

function fetchAdmins() {
    fetch('http://localhost/shoe-api/public/api/admins')
        .then(response => response.json())
        .then(data => displayAdmins(data))
        .catch(error => console.error('Error:', error));
}

function displayAdmins(admins) {
    const adminList = document.getElementById('adminList');
    adminList.innerHTML = ""
    admins.forEach(admin => {
        const row = document.createElement('tr');
        const imageCell = document.createElement('td');
        const image = document.createElement('img');
        image.src = "http://localhost/shoe-api/storage/app/public/avatars/"+admin.anhdaidien;
        image.style.width = '40px';
        image.style.height = 'auto';
        image.style.borderRadius = '50%';
        imageCell.appendChild(image);

        const nameCell = document.createElement('td');
        nameCell.textContent = admin.tendangnhap;

        const statusCell = document.createElement('td');
        const statusBtn = document.createElement('button');
        statusBtn.className = `btn btn-status btn-${admin.tinhtrang === 'hoatdong' ? 'success' : 'secondary'}`;
        statusBtn.textContent = capitalizeFirstLetter(admin.tinhtrang);
        statusCell.appendChild(statusBtn);

        const roleCell = document.createElement('td');
        const roleBtn = document.createElement('button');
        roleBtn.className = `btn btn-role ${getRoleButtonClass(admin.chucvu)}`;
        roleBtn.textContent = capitalizeFirstLetter(admin.chucvu);
        roleCell.appendChild(roleBtn);

        const actionsCell = document.createElement('td');
        const editBtn = document.createElement('button');
        editBtn.setAttribute('title', 'Edit');
        editBtn.setAttribute('data-bs-toggle', 'modal');
        editBtn.setAttribute('data-bs-target', '#editAdminModal');
        editBtn.className = 'btn btn-action btn-warning';
        editBtn.innerHTML = '<i class="ti ti-edit"></i>'; // Font Awesome edit icon
        editBtn.onclick = function() { 
            document.getElementById('editUsername').value = admin.tendangnhap;
            document.getElementById('id').value = admin.id;
            document.getElementById('editStatus').value = admin.tinhtrang;
            document.getElementById('editRole').value = admin.chucvu;
         };
        actionsCell.appendChild(editBtn);

        const resetPasswordBtn = document.createElement('button');
        resetPasswordBtn.setAttribute('title', 'Reset password');
        resetPasswordBtn.setAttribute('data-bs-toggle', 'modal');
        resetPasswordBtn.setAttribute('data-bs-target', '#resetPasswordModal');
        resetPasswordBtn.className = 'btn btn-action btn-info';
        resetPasswordBtn.innerHTML = '<i class="ti ti-refresh"></i>'; // Font Awesome reset icon
        resetPasswordBtn.onclick = function() { 
            document.getElementById('id2').value = admin.id;
         };
        actionsCell.appendChild(resetPasswordBtn);

        row.appendChild(imageCell);
        row.appendChild(nameCell);
        row.appendChild(statusCell);
        row.appendChild(roleCell);
        row.appendChild(actionsCell);

        adminList.appendChild(row);
    });
}

function getRoleButtonClass(role) {
    switch(role.toLowerCase()) {
        case 'nhanvien':
            return 'btn-info';
        case 'quanly':
            return 'btn-primary';
        case 'admin':
            return 'btn-danger';
        default:
            return 'btn-secondary';
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function saveAdminChanges() {
    const id = document.getElementById('id').value
    // Tạo đối tượng JavaScript với dữ liệu từ form
    const adminData = {
        tendangnhap: document.getElementById('editUsername').value,
        tinhtrang: document.getElementById('editStatus').value,
        chucvu: document.getElementById('editRole').value
    };

    // Gửi yêu cầu fetch đến API để tạo mới một admin
    fetch('http://localhost/shoe-api/public/api/admin/update/'+id, {  // URL phụ thuộc vào thiết kế của API backend
        method: 'POST',  // Phương thức POST dùng để tạo mới dữ liệu
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',  // Đảm bảo API trả về dữ liệu dạng JSON
        },
        body: JSON.stringify(adminData)  // Chuyển đổi dữ liệu form thành chuỗi JSON
    })
    .then(response => {
        if (!response.ok) {  // Kiểm tra nếu có lỗi từ phía server, ví dụ như lỗi validation
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        fetchAdmins()
        alert("Sửa thành công!")
        $('#editAdminModal').modal('hide');  // Đóng modal sau khi cập nhật
        // Tải lại danh sách admin hoặc cập nhật giao diện người dùng tương ứng
    })
    .catch((error) => {
        alert("Sửa thất bại!")
        alert('Error creating admin.');  // Hiển thị thông báo lỗi
    });
}

function submitNewPassword() {
    const id = document.getElementById('id2').value;
    const password = document.getElementById('newPassword').value;
    const confirmNewPassword = document.getElementById('confirmNewPassword').value;

    // Đảm bảo mật khẩu mới được nhập đúng và xác nhận
    if (password =="" || confirmNewPassword =="") {
        alert('Passwords do not empty.');
        return;
    }
    if (password !== confirmNewPassword) {
        alert('Passwords do not match.');
        return;
    }

    // Yêu cầu đến server để đặt lại mật khẩu
    // Thay thế URL_API với đường dẫn API đúng của bạn
    fetch('http://localhost/shoe-api/public/api/admin/updatepassword/'+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({"matkhau":password})  
    })
    .then(response => response.json())
    .then(data => {
        alert("Reset mật khẩu thành công!")
        $('#resetPasswordModal').modal('hide');
        document.getElementById('newPassword').value = "";
        document.getElementById('confirmNewPassword').value = "";
    })
    .catch(error => {
        alert("Reset mật khẩu thất bại!")
        alert('Failed to reset password.');
    });
}

function addNewAdmin() {
    const newAdminData = {
        tendangnhap: document.getElementById('newAdminName').value,
        matkhau: document.getElementById('newAdminPassword').value,
        anhdaidien: document.getElementById('anhdaidien').files[0], // Get the selected file
        tinhtrang: document.getElementById('newAdminStatus').value,
        chucvu: document.getElementById('newAdminRole').value
    };

    const formData = new FormData();
    formData.append('tendangnhap', newAdminData.tendangnhap);
    formData.append('matkhau', newAdminData.matkhau);
    formData.append('anhdaidien', newAdminData.anhdaidien);
    formData.append('tinhtrang', newAdminData.tinhtrang);
    formData.append('chucvu', newAdminData.chucvu);

    fetch('http://localhost/shoe-api/public/api/admin/create', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        fetchAdmins();
        $('#addAdminModal').modal('hide');
        alert("Thêm admin thành công!")
        showToast("Admin", "", "bg-success");
    })
    .catch((error) => {
        alert("Thêm admin thất bại!")
        console.error('Error creating admin:', error);
        alert('Error creating admin.');
    });
}



</script>

<!-- Modal for Editing Admin -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Sửa Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAdminForm">
                    <input type="hidden" id="id" name="id"/>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="editStatus">
                            <option value="hoatdong">Hoạt động</option>
                            <option value="vohieuhoa">Vô hiệu hóa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Chức vụ</label>
                        <select class="form-select" id="editRole">
                            <option value="nhanvien">Nhân viên</option>
                            <option value="quanly">Quản lý</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <!-- Additional fields can be added here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="saveAdminChanges()">Lưu lại</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Đặt lại mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="resetPasswordForm">
                <input type="hidden" id="id2" name="id2"/>
                    <div class="form-password-toggle">
                        <label class="form-label" for="newPassword">Mật khẩu mới</label>
                        <div class="input-group">
                          <input
                            type="password"
                            class="form-control"
                            id="newPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password2"
                          />
                          <span id="basic-default-password2" class="input-group-text cursor-pointer"
                            ><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="form-password-toggle">
                        <label class="form-label" for="confirmNewPassword">Nhập lại mật khẩu mới</label>
                        <div class="input-group">
                          <input
                            type="password"
                            class="form-control"
                            id="confirmNewPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password2"
                          />
                          <span id="basic-default-password2" class="input-group-text cursor-pointer"
                            ><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitNewPassword()">Lưu lại</button>
            </div>
        </div>
    </div>
</div>


<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminModalLabel">Thêm Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAdminForm">
                    <div class="mb-3">
                        <label for="newAdminName" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="newAdminName" required>
                    </div>
                    <div class="form-password-toggle">
                        <label class="form-label" for="newAdminPassword">Mật khẩu</label>
                        <div class="input-group">
                          <input
                            type="password"
                            class="form-control"
                            id="newAdminPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password2"
                          />
                          <span id="basic-default-password2" class="input-group-text cursor-pointer"
                            ><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="anhdaidien" class="form-label">Ảnh</label>
                        <input type="file" class="form-control" id="anhdaidien" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="newAdminStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="newAdminStatus">
                            <option value="hoatdong">Hoạt động</option>
                            <option value="vohieuhoa">Vô hiệu hóa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="newAdminRole" class="form-label">Chức vụ</label>
                        <select class="form-select" id="newAdminRole">
                            <option value="nhanvien">Nhân viên</option>
                            <option value="quanly">Quản lý</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <!-- Additional fields can be added here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="addNewAdmin()">Thêm</button>
            </div>
        </div>
    </div>
</div>



@endsection
