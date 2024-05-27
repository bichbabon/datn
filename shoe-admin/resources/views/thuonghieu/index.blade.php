@extends('../layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container">
    <h3 class="mt-5">Quản lý thương hiệu</h3>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBrandModal">Thêm thương hiệu</button>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="brand-list">
                <!-- Brands will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Thêm thương hiệu mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBrandForm">
                    <div class="form-group">
                        <label for="brandName">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="brandName" name="brandName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitAddBrand()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Sửa Thương Hiệu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" id="editBrandId">
                    <div class="form-group">
                        <label for="editCategoryName">Tên Danh Mục</label>
                        <input type="text" class="form-control" id="editBrandName" name="brandName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitEditBrand()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        fetchBrands();
    });

    function fetchBrands() {
        fetch('http://localhost/shoe-api/public/api/thuonghieu')
            .then(response => response.json())
            .then(data => displayBrands(data))
            .catch(error => console.error('Error fetching brands:', error));
    }

    function displayBrands(brands) {
        const tableBody = document.getElementById('brand-list');
        tableBody.innerHTML = ''; // Clear the table body

        brands.forEach(brand => {
            const formattedCreatedAt = new Date(brand.created_at).toLocaleDateString('en-US');
            const formattedUpdatedAt = new Date(brand.updated_at).toLocaleDateString('en-US');
            const row = `
            <tr>
                <td>${brand.id}</td>
                <td>${brand.ten}</td>
                <td>${formattedCreatedAt}</td>
                <td>${formattedUpdatedAt}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="editBrand(${brand.id})"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteBrand(${brand.id})"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
        `;
            tableBody.innerHTML += row;
        });
    }

    function submitAddBrand() {
        var brandName = $('#brandName').val();
        $.ajax({
            url: 'http://localhost/shoe-api/public/api/thuonghieu',
            type: 'POST',
            data: { ten: brandName },
            success: function (response) {
                $('#addBrandModal').modal('hide');
                fetchBrands();
                alert('Brand added successfully!');
                $('#addBrandForm')[0].reset();
            },
            error: function (error) {
                console.error('Error adding brand:', error);
                alert('Error adding brand. Please try again.');
            }
        });
    }

    function editBrand(id) {
        fetch(`http://localhost/shoe-api/public/api/thuonghieu/${id}`)
            .then(response => response.json())
            .then(data => {
                $('#editBrandId').val(data.id);
                $('#editBrandName').val(data.ten);
                $('#editBrandModal').modal('show');
            })
            .catch(error => {
                console.error('Error fetching brand details:', error);
                alert('Could not fetch brand details.');
            });
    }

    function submitEditBrand() {
        var id = $('#editBrandId').val();
        var brandName = $('#editBrandName').val();
        $.ajax({
            url: `http://localhost/shoe-api/public/api/thuonghieu/${id}`,
            type: 'PUT',
            data: { ten: brandName },
            success: function (response) {
                $('#editBrandModal').modal('hide');
                fetchBrands();
                alert('Brand updated successfully!');
            },
            error: function (error) {
                console.error('Error updating brand:', error);
                alert('Error updating brand. Please try again.');
            }
        });
    }

    function deleteBrand(id) {
        if (confirm(`Are you sure you want to delete this brand ${id}?`)) {
            $.ajax({
                url: `http://localhost/shoe-api/public/api/thuonghieu/${id}`,
                type: 'DELETE',
                success: function (response) {
                    fetchBrands();
                    alert('Brand deleted successfully!');
                },
                error: function (error) {
                    console.error('Error deleting brand:', error);
                    alert('Error deleting brand. Please try again.');
                }
            });
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection