@extends('../layout')
@section('content')
<div class="container mt-5">
        <h2>Cập Nhật Sản Phẩm</h2>
        <form id="updateProductForm" enctype="multipart/form-data">
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
                <input type="file" class="form-control" id="images[]" name="images[]" multiple onchange="previewImages(event)" >
            </div>
            <div id="uploadedImages"></div>
            <h3>Chi Tiết Sản Phẩm</h3>
            <table class="table table-bordered" id="productDetailTable">
                <thead>
                    <tr>
                        <th>Màu Sắc</th>
                        <th>Kích Thước</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="productDetailBody">
                    <!-- Dữ liệu chi tiết sản phẩm sẽ được điền vào đây -->
                </tbody>
            </table>

            <!-- Nút Thêm Dòng Mới -->
            <button type="button" class="btn btn-success" id="btn-add-row">Thêm Dòng Mới</button>

            <!-- Nút Cập Nhật -->
            <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        </form>
    </div>
    <!-- Include jQuery first -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Lấy URL hiện tại
        var currentUrl = window.location.href;

        // Tách URL thành các phần dựa trên dấu "?"
        var urlParts = currentUrl.split('?');

        // Kiểm tra nếu có phần query trong URL
        if (urlParts.length > 1) {
            // Lấy phần query (sau dấu "?")
            var query = urlParts[1];

            // Tách query thành các cặp key-value dựa trên dấu "&"
            var queryParams = query.split('&');

            // Khởi tạo biến để lưu trữ productId
            var productId = null;

            // Duyệt qua các cặp key-value để tìm productId
            queryParams.forEach(function (param) {
                // Tách cặp key-value thành key và value dựa trên dấu "="
                var keyValue = param.split('=');
                // Kiểm tra nếu key là "id"
                if (keyValue[0] === 'id') {
                    // Lấy giá trị của key "id" là productId
                    productId = keyValue[1];
                }
            });

            // Kiểm tra xem productId có giá trị hợp lệ hay không
            if (productId !== null && productId !== '') {
                // Sử dụng productId ở đây, ví dụ:
                console.log("ProductId:", productId);
            } else {
                console.error("Invalid productId:", productId);
            }
        } else {
            console.error("No query parameters found in the URL.");
        }


        $(document).ready(function () {
            $.ajax({
                url: 'http://localhost/shoe-api/public/api/sanpham/' + productId,
                type: 'GET',
                success: function (response) {
                    // Điền thông tin sản phẩm vào các trường trong form
                    $('#productId').val(response.id);
                    $('#ten').val(response.ten);
                    $('#gia').val(response.gia);
                    $('#gioithieu').val(response.gioithieu);
                    $('#sanxuat').val(response.sanxuat);
                    $('#docao').val(response.docao);
                    $('#mota').val(response.mota);
                    $('#giamgia').val(response.giamgia);

                    var danhmucs = response.danhmuc;

                    $.ajax({
                        url: 'http://localhost/shoe-api/public/api/danhmuc',
                        type: 'GET',
                        success: function (response) {
                            response.forEach(function (danhmuc) {
                                var isChecked = danhmucs.some(function (item) {
                                    return item.id === danhmuc.id;
                                });

                                $('#danhmuc-checkboxes').append('<div class="form-check"><input class="form-check-input" type="checkbox" name="danhmuc[]" value="' + danhmuc.id + '" id="danhmuc-' + danhmuc.id + '"' + (isChecked ? ' checked' : '') + '><label class="form-check-label" for="danhmuc-' + danhmuc.id + '">' + danhmuc.ten + '</label></div>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Đã có lỗi xảy ra khi tải danh mục. Vui lòng thử lại.');
                        }
                    });

                    var th = response.thuonghieu;

                    $.ajax({
                        url: 'http://localhost/shoe-api/public/api/thuonghieu',
                        type: 'GET',
                        success: function (response) {
                            response.forEach(function (thuonghieu) {
                                var isSelected = th.id == thuonghieu.id

                                $('#thuonghieu_id').append('<option value="' + thuonghieu.id + '"' + (isSelected ? ' selected' : '') + '>' + thuonghieu.ten + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Đã có lỗi xảy ra khi tải thương hiệu. Vui lòng thử lại.');
                        }
                    });


                    // Hiển thị chi tiết sản phẩm
                    response.sanphamsizemausac.forEach(function (chitiet) {
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
                                            <input type="number" class="form-control" name="soluong[]" value="${chitiet.soluong}" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-remove-row">Xóa</button>
                                        </td>
                                    </tr>
                                `;

                        $('#productDetailBody').append(row); // Thêm hàng vào bảng chi tiết sản phẩm

                        var selectMausac = $('[name="mausac[]"]').last(); // Chọn phần tử select màusắc trong hàng vừa thêm
                        var selectSize = $('[name="size[]"]').last();
                        $.ajax({
                            url: 'http://localhost/shoe-api/public/api/mausac',
                            type: 'GET',
                            success: function (response) {
                                response.forEach(function (mausac) {
                                    var option = $('<option>', {
                                        value: mausac.id,
                                        text: mausac.ten,
                                        selected: (chitiet.mausac_id == mausac.id)
                                    });
                                    selectMausac.append(option); // Thêm tùy chọn vào phần tử select
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Đã có lỗi xảy ra khi tải màu sắc. Vui lòng thử lại.');
                            }
                        });




                        // Load size từ API và hiển thị trong combobox cho dòng này
                        $.ajax({
                            url: 'http://localhost/shoe-api/public/api/size',
                            type: 'GET',
                            success: function (response) {
                                response.forEach(function (size) {
                                    var option = $('<option>', {
                                        value: size.id,
                                        text: size.ten,
                                        selected: (chitiet.size_id == size.id)
                                    });
                                    selectSize.append(option);
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Đã có lỗi xảy ra khi tải size. Vui lòng thử lại.');
                            }
                        });
                    });

                    const uploadedImagesDiv = document.getElementById('uploadedImages');
                    response.anhsanpham.forEach(image => {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('imageContainer');

                        const img = document.createElement('img');
                        img.classList.add('oldImage');
                        img.src =  "http://localhost/shoe-api/storage/app/public/uploads/"+image.anhminhhoa;
                        img.style.maxWidth = '100px';

                        const deleteIcon = document.createElement('span');
                        deleteIcon.innerHTML = '&times;';
                        deleteIcon.className = 'deleteIcon';
                        deleteIcon.addEventListener('click', function () {
                            imgContainer.remove();
                        });
                        const oldImagesInput = document.createElement('input');
                        oldImagesInput.type = 'hidden';
                        oldImagesInput.id = 'oldImages[]';
                        oldImagesInput.name = 'oldImages[]';
                        oldImagesInput.value = image.anhminhhoa;

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(deleteIcon);
                        imgContainer.appendChild(oldImagesInput);
                        uploadedImagesDiv.appendChild(imgContainer);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã có lỗi xảy ra khi tải thông tin sản phẩm. Vui lòng thử lại.');
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

            // Xử lý khi submit form
            $('#updateProductForm').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'http://localhost/shoe-api/public/api/sanpham/' + $('#productId').val(),
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        alert("Update thành công!");
                        
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText); // Hiển thị lỗi trong console
                        alert('Đã có lỗi xảy ra. Vui lòng thử lại.'); // Thông báo lỗi
                    }
                });
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