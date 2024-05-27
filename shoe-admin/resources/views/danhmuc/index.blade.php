@extends('../layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container">
    <h3 class="mt-5">Quản lý danh mục</h3>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCategoryModal">Thêm danh mục</button>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                </tr>
            </thead>
            <tbody id="category-list">
                <!-- Categories will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục Mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addCategoryForm">
          <div class="form-group">
            <label for="categoryName">Tên Danh Mục</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitCategory()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Sửa Danh Mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editCategoryForm">
          <input type="hidden" id="editCategoryId">
          <div class="form-group">
            <label for="editCategoryName">Tên Danh Mục</label>
            <input type="text" class="form-control" id="editCategoryName" name="categoryName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitEditCategory()">Lưu</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    fetchCategories();
});

function submitCategory() {
    var categoryName = $('#categoryName').val();
    if (!categoryName) {
        alert("Please enter a category name.");
        return;
    }

    $.ajax({
        url: 'http://localhost/shoe-api/public/api/danhmuc', // Adjust the API URL
        type: 'POST',
        data: {
            ten: categoryName,
        },
        success: function(response) {
            $('#addCategoryModal').modal('hide');
            fetchCategories(); // Refresh the categories list
            $('#addCategoryForm')[0].reset(); // Clear the form
            alert('Category added successfully!');
        },
        error: function(error) {
            console.error('Error adding category:', error);
            alert('Error adding category. Please try again.');
        }
    });
}

function editCategory(id) {
    // Fetch the current data for the category
    fetch(`http://localhost/shoe-api/public/api/danhmuc/${id}`)
    .then(response => response.json())
    .then(data => {
        $('#editCategoryId').val(data.id);
        $('#editCategoryName').val(data.ten);
        $('#editCategoryModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching category details:', error);
        alert('Could not fetch category details.');
    });
}

function submitEditCategory() {
    var id = $('#editCategoryId').val();
    var categoryName = $('#editCategoryName').val();
    if (!categoryName) {
        alert("Please enter a category name.");
        return;
    }

    $.ajax({
        url: `http://localhost/shoe-api/public/api/danhmuc/${id}`,
        type: 'PUT',
        data: {
            ten: categoryName,
        },
        success: function(response) {
            $('#editCategoryModal').modal('hide');
            fetchCategories(); // Refresh the categories list
            alert('Category updated successfully!');
        },
        error: function(error) {
            console.error('Error updating category:', error);
            alert('Error updating category. Please try again.');
        }
    });
}



function fetchCategories() {
    fetch('http://localhost/shoe-api/public/api/danhmuc') // Adjust the API URL
    .then(response => response.json())
    .then(data => displayCategories(data))
    .catch(error => console.error('Error fetching categories:', error));
}

function displayCategories(categories) {
    const tableBody = document.getElementById('category-list');
    tableBody.innerHTML = ''; // Clear the table body

    categories.forEach(category => {
        const formattedCreatedAt = new Date(category.created_at).toLocaleDateString('en-US');
        const formattedUpdatedAt = new Date(category.updated_at).toLocaleDateString('en-US');
        const row = `
            <tr>
                <td>${category.id}</td>
                <td>${category.ten}</td>
                <td>${formattedCreatedAt}</td>
                <td>${formattedUpdatedAt}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="editCategory(${category.id})"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteCategory(${category.id})"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

function deleteCategory(id) {
    if (confirm(`Are you sure you want to delete category ${id}?`)) {
        $.ajax({
            url: `http://localhost/shoe-api/public/api/danhmuc/${id}`,
            type: 'DELETE',
            success: function(response) {
                fetchCategories(); // Refresh the categories list
                alert('Category deleted successfully!');
            },
            error: function(error) {
                console.error('Error deleting category:', error);
                alert('Error deleting category. Please try again.');
            }
        });
    }
}

</script>
@endsection()