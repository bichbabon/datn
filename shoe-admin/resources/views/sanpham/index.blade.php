@extends('../layout')
@section('content')
<style>
    /* Additional styles for table columns */
    .name-column {
        max-width: 200px !important; /* fixed width */
        overflow: hidden; /* hide overflow */
        text-overflow: ellipsis; /* show ellipsis (...) when text overflows */
        white-space: nowrap; /* no text wrapping */
    }
</style>
<div class=" d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
        <button type="button" class="btn btn-primary m-1" onclick="addProduct()">Thêm sản phẩm</button>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Id</h6>
                </th>
                <th class="border-bottom-0 name-column">
                    <h6 class="fw-semibold mb-0">Tên</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Ảnh</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Giá tiền</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Hành động</h6>
                </th>
                </tr>
            </thead>
            <tbody id="product-list">
                
            </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul id="pagination" class="pagination">
                    <!-- Pagination Links will be inserted here by JavaScript -->
                </ul>
            </nav>
        </div>
        </div>
    </div>
    </div>
    <script>
        function fetchProduct(url){
            fetch(url)
            .then(response => response.json())
            .then(data => {
                displayProducts(data.data);
                setupPagination(data)
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    document.addEventListener('DOMContentLoaded', function(){
        fetchProduct("http://localhost/shoe-api/public/api/sanpham")
    });

    function displayProducts(products){
        const tableBody = document.getElementById('product-list');
        tableBody.innerHTML = ''; // Clear existing table rows.
        products.forEach(product => {
            const row = tableBody.insertRow();
            row.id = `row-${product.id}`;
            row.innerHTML = `
                <td class="border-bottom-0" id="row-${product.id}">
                    <h6 class="fw-semibold mb-0 fs-4">${product.id}</h6>
                </td>
                <td class="border-bottom-0 ">
                    <h6 class="fw-semibold mb-0 fs-4 name-column">${product.ten}</h6>
                </td>
                <td><img src="http://localhost/shoe-api/storage/app/public/uploads/${product.anhsanpham[0].anhminhhoa}" style="width: 100px; height: auto;"></td>
                <td>${Number(product.gia).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</td>
                <td>
                    <button class="btn btn-primary" onclick="editProduct(${product.id})"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteProduct(${product.id})"><i class="ti ti-trash"></i></i></button>
                </td>
            `;
        });
    }
    function setupPagination(data) {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = ''; // Clear existing links
        data.links.forEach(link => {
            let li = document.createElement('li');
            li.className = 'page-item ' + (link.active ? 'active' : '');
            if (!link.url) {
                li.classList.add('disabled'); // Adds disabled class if no URL is present
            }

            let a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerHTML = link.label; // Changed from innerText to innerHTML
            a.addEventListener('click', (e) => {
                e.preventDefault();
                if (link.url) {
                    console.log("Fetching page from URL:", link.url);
                    fetchProduct(link.url); // Directly use the URL from the link
                }
            });

            // Add a check to disable click functionality if no URL
            if (!link.url) {
                a.classList.add('disabled'); // Optionally add disabled class
                a.onclick = (event) => event.preventDefault(); // Prevent click
            }

            li.appendChild(a);
            pagination.appendChild(li);
        });
    }

    function addProduct(){
        window.location.href ="{{route("sanpham.add")}}";
    }

    function editProduct(id) {
        console.log('Editing product', id);
        window.location.href ="{{route("sanpham.edit")}}?id="+id;
    }

    function deleteProduct(id) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
            console.log('Deleting product', id);
            // Gửi yêu cầu AJAX đến server để xóa sản phẩm
            fetch(`http://localhost/shoe-api/public/api/sanpham/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                console.log("Xóa thành công:", data);
                alert("Sản phẩm đã được xóa.");
                // Refresh dữ liệu trên trang hoặc xóa dòng sản phẩm ra khỏi bảng
                // Ví dụ: xóa dòng sản phẩm trong bảng
                document.querySelector(`#row-${id}`).remove();
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Lỗi khi xóa sản phẩm.");
            });
        }
    }

    </script>
@endsection()