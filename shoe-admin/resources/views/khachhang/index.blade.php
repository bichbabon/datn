@extends('../layout')

@section('content')
<style>
    /* Basic styling for the dropdown */
    .select-dropdown {
        width: 100%;
        font-size: 16px;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Color-coded option styling */
    option.active {
        color: green; /* Active status */
    }
    option.inactive {
        color: orange; /* Inactive status */
    }
    option.blocked {
        color: red; /* Blocked status */
    }

    /* Styling for selected option based on the class */
    .form-select.active {
        background-color: #DFF0D8;
    }
    .form-select.inactive {
        background-color: #FCF8E3;
    }
    .form-select.blocked {
        background-color: #F2DEDE;
    }

</style>
<nav
    
>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav flex-row align-items-center ms-auto">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                    type="text"
                    id="searchInput"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                    onkeyup="filterCustomers()"
                />
            </div>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive">
        <table class="table" id="customerTable">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody id="customerList">
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('http://localhost/shoe-api/public/api/khachhang')
            .then(response => response.json())
            .then(data => displayCustomers(data))
            .catch(error => console.error('Error:', error));
    });

    function displayCustomers(customers) {
        const customerList = document.getElementById('customerList');
        customers.forEach(customer => {
            const row = document.createElement('tr');
            const nameCell = document.createElement('td');
            nameCell.textContent = customer.ten;

            const phoneCell = document.createElement('td');
            phoneCell.textContent = customer.sdt;

            const emailCell = document.createElement('td');
            emailCell.textContent = customer.email;

            const statusCell = document.createElement('td');
            const statusSelect = document.createElement('select');
            statusSelect.classList.add("form-select", "dropdown-toggle"); // Bootstrap's form-select for basic styling

            const statusColors = {
                hoatdong: '#DFF0D8',   // Light green
                vohieuhoa: '#F2DEDE'   // Light red
            };

            ['hoatdong', 'vohieuhoa'].forEach(status => {
                const option = document.createElement('option');
                option.value = status;
                option.textContent = status;
                option.selected = customer.tinhtrang === status;

                // Set initial background colors for options
                option.style.backgroundColor = statusColors[status];
                
                statusSelect.appendChild(option);
            });

            // Set the initial background color of the select element
            statusSelect.style.backgroundColor = statusColors[customer.status];

            // Update background color on change
            statusSelect.onchange = function () {
                // Update the status in the backend
                updateStatus(customer.id, this.value);

                // Change the select background and option background colors
                this.style.backgroundColor = statusColors[this.value];
                Array.from(this.options).forEach(option => {
                    option.style.backgroundColor = statusColors[option.value];
                });
            };

            statusCell.appendChild(statusSelect);




            const imageCell = document.createElement('td');
            const image = document.createElement('img');
            const baseUrl = "http://localhost/shoe-api/storage/app/public/avatars/"; // Đây là URL cơ sở của bạn
            const imagePath = customer.anhdaidien; // Đường dẫn phần còn lại của ảnh

            // Kiểm tra nếu đường dẫn ảnh không bắt đầu bằng "http://" hoặc "https://"
            if(customer.anhdaidien){
                if (!imagePath.startsWith("http://") && !imagePath.startsWith("https://")) {
                    // Nếu không, kết hợp đường dẫn với URL cơ sở
                    image.src = baseUrl + imagePath;
                } else {
                    // Nếu đã là đường dẫn đầy đủ, không cần thêm gì
                    image.src = imagePath;
                }
            }
            image.style.width = '100px';
            imageCell.appendChild(image);

            

            const actionsCell = document.createElement('td');
            // Add other actions here if necessary

            row.appendChild(imageCell);
            row.appendChild(nameCell);
            row.appendChild(phoneCell);
            row.appendChild(emailCell);
            row.appendChild(statusCell);
            row.appendChild(actionsCell);

            customerList.appendChild(row);
        });
    }
    

    function updateStatus(customerId, tinhtrang) {
        fetch(`http://localhost/shoe-api/public/api/khachhang/updatestatus/${customerId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ tinhtrang })
        })
        .then(response => {
            if (response.ok) {
                alert("Cập nhật trạng thái thành công!")
                console.log('Status updated successfully');
            } else {
                alert("Cập nhật trạng thái thất bại!")
                console.error('Failed to update status');
            }
        });
    }

    function filterCustomers() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('customerTable');
        const rows = table.getElementsByTagName('tr');
        
        // Lặp qua tất cả các hàng và lọc theo cột
        for (let i = 1; i < rows.length; i++) { // Bắt đầu từ 1 để bỏ qua hàng tiêu đề
            const cells = rows[i].getElementsByTagName('td');
            let matched = false; // Giả định ban đầu là hàng không khớp
            
            // Lặp qua tất cả các ô trong hàng
            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        matched = true; // Đánh dấu là tìm thấy khớp trong hàng
                        break; // Dừng lặp qua các ô còn lại vì đã tìm thấy khớp
                    }
                }
            }

            // Ẩn hoặc hiển thị hàng dựa trên kết quả tìm kiếm
            rows[i].style.display = matched ? '' : 'none';
        }
    }

</script>
@endsection
