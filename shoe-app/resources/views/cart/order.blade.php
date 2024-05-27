@extends('../layout')

@section('content')
<div class="bg0 m-t-23 p-b-50">
</div>
<div class="bg0 m-t-23 p-b-50">
</div>
<div class="container mt-3 pb-5">
    <h1>Danh Sách Đơn Hàng</h1>
    <table class="table table-striped"> <!-- Sử dụng Bootstrap cho bảng -->
        <thead class="thead-dark"> <!-- Thêm class cho thead -->
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Phương Thức Thanh Toán</th>
                <th>Tình Trạng</th>
                <th>Hành Động</th> <!-- Thêm cột cho nút xem chi tiết -->
            </tr>
        </thead>
        <tbody id="orderTableBody">
            <!-- Các dòng đơn hàng sẽ được thêm vào đây -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" style="z-index: 100000 !important;" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đặt hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Order details will be loaded here -->
                <p><strong>ID:</strong> <span id="modalOrderId"></span></p>
                <p><strong>Tên:</strong> <span id="modalCustomerName"></span></p>
                <p><strong>Địa chỉ:</strong> <span id="modalAddress"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="modalPhone"></span></p>
                <p><strong>Phương thức thanh toán:</strong> <span id="modalPaymentMethod"></span></p>
                <p><strong>Trạng thái:</strong> <span id="modalStatus"></span></p>
                <h4>Sản phẩm</h4>
                <ul id="modalProductsList"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var statusMapping = {
        'choxacnhan': 'Chờ xác nhận',
        'xacnhan': 'Xác nhận',
        'danggiaohang': 'Đang giao hàng',
        'hoanthanh': 'Hoàn thành',
        'huy': 'Hủy',
        'trahang': 'Trả hàng'
    };

    fetch('http://localhost/shoe-api/public/api/donhang/khachhang/' + sessionStorage.getItem('id'))
        .then(response => response.json())
        .then(orders => {
            const tableBody = document.getElementById('orderTableBody');
            orders.forEach(order => {
                let actionButtons = `<button class="btn btn-info" onclick="viewDetails(${order.id})">Xem Chi Tiết</button>`;

                // Sử dụng đối chiếu trạng thái để xác định hiển thị nút
                const displayStatus = statusMapping[order.tinhtrang] || order.tinhtrang;

                if (['choxacnhan', 'xacnhan', 'danggiaohang'].includes(order.tinhtrang)) {
                    actionButtons += ` <button class="btn btn-danger" onclick="updateOrderStatus(${order.id}, 'huy')">Hủy</button>
                    `;
                    if (order.tinhtrang === 'danggiaohang') {
                    actionButtons += ` <button class="btn btn-success" onclick="updateOrderStatus(${order.id}, 'hoanthanh')">Đã nhận hàng</button>`;
                }
                }

                if (order.tinhtrang === 'hoanthanh') {
                    actionButtons += ` <button class="btn btn-warning" onclick="updateOrderStatus(${order.id}, 'trahang')">Trả hàng</button>`;
                }

                const row = `<tr>
                    <td>${order.id}</td>
                    <td>${order.ten}</td>
                    <td>${order.diachi}</td>
                    <td>${order.sdt}</td>
                    <td>${order.pttt}</td>
                    <td>${displayStatus}</td>
                    <td>${actionButtons}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
});

function updateOrderStatus(orderId, newStatus) {
    fetch(`http://localhost/shoe-api/public/api/donhang/updatestatus/${orderId}`, {
        method: 'POST', // Or 'PATCH' depending on your API design
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ tinhtrang: newStatus })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        alert('Đơn hàng đã được cập nhật thành công!');
        location.reload(); // Refresh the page to show the updated status
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.');
    });
}


function viewDetails(orderId) {
    // Fetch order details from the server
    fetch(`http://localhost/shoe-api/public/api/chitietdonhang/${orderId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Populate the modal with order data
            document.getElementById('modalOrderId').textContent = data.order.id;
            document.getElementById('modalCustomerName').textContent = data.order.ten;
            document.getElementById('modalAddress').textContent = data.order.diachi;
            document.getElementById('modalPhone').textContent = data.order.sdt;
            document.getElementById('modalPaymentMethod').textContent = data.order.pttt;
            document.getElementById('modalStatus').textContent = data.order.tinhtrang;

            // Populate products list
            const productsList = document.getElementById('modalProductsList');
            productsList.innerHTML = '';  // Clear previous products list
            data.products.forEach(product => {
                const li = document.createElement('li');
                li.textContent = `${product.ten} - Price: ${formatCurrencyVND(product.gia_ban)} x ${product.soluong}`;
                productsList.appendChild(li);
            });

            // Show the modal
            $('#orderDetailsModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to fetch order details.');
        });
}

</script>

<!-- Add these lines in the <head> section of your HTML if not already present -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

@endsection
