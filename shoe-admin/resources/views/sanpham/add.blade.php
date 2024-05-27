@extends('../layout')
@section('content')
<div class="container mt-5">
    <h2>Thêm Sản Phẩm</h2>
    <form id="addProductForm" enctype="multipart/form-data">
        <input type="hidden" id="productId" name="productId">
        <div class="mb-3">
            <label for="ten" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="ten" name="ten" required>
        </div>
        <div class="mb-3">
            <label for="danhmuc" class="form-label">Danh Mục</label>
            <div id="danhmuc-checkboxes"></div>
        </div>
        <div class="mb-3">
            <label for="gia" class="form-label">Giá</label>
            <input type="text" class="form-control" id="gia" name="gia" pattern="[0-9]*[.,]?[0-9]+" required>
        </div>
        <div class="mb-3">
            <label for="thuonghieu" class="form-label">Thương Hiệu</label>
            <select class="form-select" id="thuonghieu_id" name="thuonghieu_id" required>
                <!-- Options will be dynamically added by JavaScript -->
            </select>
        </div>
        <div class="mb-3">
            <label for="gioithieu" class="form-label">Giới Thiệu</label>
            <textarea class="form-control" id="gioithieu" name="gioithieu" required></textarea>
        </div>
        <div class="mb-3">
            <label for="sanxuat" class="form-label">Sản Xuất</label>
            <input type="text" class="form-control" id="sanxuat" name="sanxuat" required>
        </div>
        <div class="mb-3">
            <label for="docao" class="form-label">Độ Cao</label>
            <input type="text" class="form-control" id="docao" name="docao" pattern="[0-9]*[.,]?[0-9]+" required>
        </div>
        <div class="mb-3">
            <label for="mota" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="mota" name="mota" required></textarea>
        </div>
        <div class="mb-3">
            <label for="giamgia" class="form-label">Giảm Giá</label>
            <input type="text" class="form-control" id="giamgia" name="giamgia" pattern="[0-9]*[.,]?[0-9]+" required>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="images[]" name="images[]" multiple
                onchange="previewImages(event)">
        </div>
        <div id="uploadedImages"></div>
        <h3>Chi Tiết Sản Phẩm</h3>
        <table class="table table-bordered" id="productDetailTable">
            <thead>
                <tr>
                    <th>Màu Sắc</th>
                    <th>Kích Thước</th>
                    <th>Số lượng</th>
                    
                </tr>
            </thead>
            <tbody id="productDetailBody">
                <!-- Dữ liệu chi tiết sản phẩm sẽ được điền vào đây -->
            </tbody>
        </table>

        <!-- Nút Thêm Dòng Mới -->
        <button type="button" class="btn btn-success" id="btn-add-row">Thêm Dòng Mới</button>

        <!-- Nút Cập Nhật -->
        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </form>
</div>
<!-- Include jQuery first -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>

    $(document).ready(function () {
        $.ajax({
            url: 'http://localhost/shoe-api/public/api/thuonghieu',
            type: 'GET',
            success: function (response) {
                response.forEach(function (thuonghieu) {
                    $('#thuonghieu_id').append('<option value="' + thuonghieu.id + '"' + '>' + thuonghieu.ten + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Đã có lỗi xảy ra khi tải thương hiệu. Vui lòng thử lại.');
            }
        });

        $.ajax({
            url: 'http://localhost/shoe-api/public/api/danhmuc',
            type: 'GET',
            success: function (response) {
                response.forEach(function (danhmuc) {
                    $('#danhmuc-checkboxes').append('<div class="form-check"><input class="form-check-input" type="checkbox" name="danhmuc[]" value="' + danhmuc.id + '" id="danhmuc-' + danhmuc.id + '"' + '><label class="form-check-label" for="danhmuc-' + danhmuc.id + '">' + danhmuc.ten + '</label></div>');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Đã có lỗi xảy ra khi tải danh mục. Vui lòng thử lại.');
            }
        });

        // Thêm dòng mới cho chi tiết sản phẩm
        $('#btn-add-row').click(function () {
            var row = `
                    <tr>
                        <td>
                            <select class="form-select" name="mausac[]" required>
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="size[]" required>
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="soluong[]" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-remove-row">Xóa</button>
                        </td>
                    </tr>
                `;
            $('#productDetailTable tbody').append(row);

            // Load màu sắc từ API và hiển thị trong combobox cho dòng mới
            $.ajax({
                url: 'http://localhost/shoe-api/public/api/mausac',
                type: 'GET',
                success: function (response) {
                    response.forEach(function (mausac) {
                        $('[name="mausac[]"]').last().append('<option value="' + mausac.id + '">' + mausac.ten + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã có lỗi xảy ra khi tải màu sắc. Vui lòng thử lại.');
                }
            });

            // Load size từ API và hiển thị trong combobox cho dòng mới
            $.ajax({
                url: 'http://localhost/shoe-api/public/api/size',
                type: 'GET',
                success: function (response) {
                    response.forEach(function (size) {
                        $('[name="size[]"]').last().append('<option value="' + size.id + '">' + size.ten + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã có lỗi xảy ra khi tải size. Vui lòng thử lại.');
                }
            });
        });

        // Xóa dòng trong bảng chi tiết sản phẩm
        $('#productDetailTable').on('click', '.btn-remove-row', function () {
            $(this).closest('tr').remove();
        });


    });

    // Xử lý khi submit form
    $('#addProductForm').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'http://localhost/shoe-api/public/api/themsanpham',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                alert("Update thành công!");
                this.reset()
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Hiển thị lỗi trong console
                alert('Đã có lỗi xảy ra. Vui lòng thử lại.'); // Thông báo lỗi
            }
        });
    });
    function previewImages(event) {
        const files = event.target.files;

        const uploadedImagesDiv = document.getElementById('uploadedImages');

        for (const file of files) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('imageContainer');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';

                const deleteIcon = document.createElement('span');
                deleteIcon.innerHTML = '&times;';
                deleteIcon.className = 'deleteIcon';
                deleteIcon.addEventListener('click', function () {
                    imgContainer.remove();
                });

                imgContainer.appendChild(img);
                imgContainer.appendChild(deleteIcon);
                uploadedImagesDiv.appendChild(imgContainer);
            };

            reader.readAsDataURL(file); // Read the image file as a data URL
        }
    }
</script>
@endsection()