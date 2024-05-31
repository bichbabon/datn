@extends('../layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="container">
    <h5 class="card-title fw-semibold mb-4">Quản lý đơn hàng</h5>
    <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Id</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Người nhận hàng</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">PTTT</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Ngày đặt</h6>

                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Tình trạng</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0"></h6>
                    </th>
                </tr>
            </thead>
            <tbody id="orders">
                <!-- Thêm các dòng dữ liệu khác tương tự ở đây -->
            </tbody>
        </table>
    </div>
</div>
<div id="orders"></div>

<!-- Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nội dung chi tiết đơn hàng sẽ được thêm vào đây -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="printInvoiceBtn" class="btn btn-primary">In Hóa Đơn</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Lắng nghe sự kiện khi người dùng nhấp vào một đơn hàng
    $(document).on('click', '.view-order-detail', function () {
        var orderId = $(this).data('order-id');

        // Gọi API để lấy chi tiết đơn hàng dựa vào orderId
        $.ajax({
            url: `http://localhost/shoe-api/public/api/chitietdonhang/${orderId}`,
            method: 'GET',
            success: function (response) {
                // Hiển thị chi tiết đơn hàng trong modal
                displayOrderDetail(response);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    // Hàm để hiển thị chi tiết đơn hàng trong modal
    // Hàm để hiển thị chi tiết đơn hàng trong modal
    function displayOrderDetail(orderDetail) {
        var modalBody = $('#orderDetailModal').find('.modal-body');
        modalBody.empty(); // Xóa nội dung cũ trước khi hiển thị

        // Hiển thị thông tin đơn hàng
        var orderHtml = `
        <p><strong>Người nhận hàng:</strong> ${orderDetail.order.ten}</p>
        <p><strong>Địa chỉ:</strong> ${orderDetail.order.diachi}</p>
        <p><strong>Số điện thoại:</strong> ${orderDetail.order.sdt}</p>
        <p><strong>Phương thức thanh toán:</strong> ${orderDetail.order.pttt}</p>
        <p><strong>Ngày đặt:</strong> ${new Date(orderDetail.order.created_at).toLocaleDateString('vi-VN')}</p>
        <p><strong>Tình trạng:</strong> ${orderDetail.order.tinhtrang}</p>
    `;

        modalBody.append(orderHtml);

        // Hiển thị bảng danh sách sản phẩm
        var productsTable = `
        <h5>Chi tiết sản phẩm:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
    `;
        var totalAmount = 0;
        orderDetail.products.forEach(function (product) {
            totalAmount += parseFloat(product.gia_ban*product.soluong);
            var productRow = `
            <tr>
                <td>${product.ten}</td>
                <td>${parseFloat(product.gia_ban).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</td>
                <td><img src="http://localhost/shoe-api/storage/app/public/uploads/${product.anhsanpham[0].anhminhhoa}" alt="${product.ten}" style="max-width: 100px;"></td>
                <td>${product.soluong}</td>
             </tr>
        `;
            productsTable += productRow;
        });
        productsTable += `
            </tbody>
        </table>
    `;
        modalBody.append(productsTable);

        // Hiển thị tổng tiền
        var totalHtml = `<p><strong>Tổng tiền:</strong> ${totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</p>`;
        modalBody.append(totalHtml);

        // Hiển thị modal
        $('#orderDetailModal').modal('show');
        if (orderDetail.order.tinhtrang === 'hoanthanh') {
                    document.getElementById('printInvoiceBtn').style.display = 'block';
                    document.getElementById('printInvoiceBtn').onclick = function () {
                        printInvoice(orderDetail.order.id);
                    };
                } else {
                    document.getElementById('printInvoiceBtn').style.display = 'none';
                }
    }
    function printInvoice(orderId) {
        window.open(`http://localhost/shoe-api/public/api/inhoadon/${orderId}`, '_blank');
    }




    $(document).ready(function () {
        // Danh sách các trạng thái hợp lệ
        var validStatus = ['Chờ xác nhận', 'Xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Hủy','Trả hàng'];
        var validStatus2 = ['choxacnhan', 'xacnhan', 'danggiaohang', 'hoanthanh', 'huy','trahang'];

        // Gọi API để lấy thông tin đơn hàng
        $.ajax({
            url: 'http://localhost/shoe-api/public/api/donhang/getall',
            method: 'GET',
            success: function (response) {
                displayOrders(response);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });

        // Hàm để hiển thị thông tin đơn hàng
        function displayOrders(orders) {
            var ordersDiv = $('#orders');
            ordersDiv.empty(); // Xóa nội dung cũ trước khi hiển thị

            // Duyệt qua mỗi đơn hàng và hiển thị thông tin
            orders.forEach(function (order) {
                var date = new Date(order.created_at).toLocaleDateString('vi-VN');
                var orderInfo = `
                <tr>
                    <td class="border-bottom-0">
                        <span class="fw-normal">#${order.id}</span>                          
                    </td>
                    <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">${order.ten}</p>
                    </td>
                    <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> ${order.pttt}</p>
                    </td>
                    <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">${date}</p>
                    </td>
                    <td class="border-bottom-0">
                        <select class="form-select form-select-sm update-status" data-order-id="${order.id}">
                        ${validStatus.map((status, index) => `
                            <option value="${validStatus2[index]}" ${order.tinhtrang === validStatus2[index] ? 'selected' : ''}>${status}</option>
                        `).join('')}

                        </select>
                    </td>
                    <td class="border-bottom-0">
                    <button type="button" class="btn btn-sm btn-info view-order-detail" data-order-id="${order.id}">Xem chi tiết</button>

                    </td>
                </tr>
                `;
                ordersDiv.append(orderInfo);
            });

            // Lắng nghe sự kiện thay đổi trạng thái
            $('.update-status').change(function () {
                var orderId = $(this).data('order-id');
                var newStatus = $(this).val();
                updateOrderStatus(orderId, newStatus);
            });
        }

        // Hàm để cập nhật trạng thái đơn hàng
        function updateOrderStatus(orderId, newStatus) {
            $.ajax({
                url: `http://localhost/shoe-api/public/api/donhang/updatestatus/${orderId}`,
                method: 'POST',
                data: {
                    tinhtrang: newStatus
                },
                success: function (response) {
                    alert('Cập nhật trạng thái đơn hàng thành công!');
                    // Sau khi cập nhật, gọi lại API để cập nhật lại danh sách đơn hàng
                    $.ajax({
                        url: 'http://localhost/shoe-api/public/api/donhang/getall',
                        method: 'GET',
                        success: function (response) {
                            displayOrders(response);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

    });
</script>

@endsection()