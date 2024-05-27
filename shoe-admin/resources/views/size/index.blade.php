@extends('../layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container">
    <h3 class="mt-5">Quản lý size</h3>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSizeModal">Thêm size</button>
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
            <tbody id="size-list">
                <!-- Categories will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSizeModalLabel">Thêm Size Mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addSizeForm">
          <div class="form-group">
            <label for="sizeName">Tên Danh Mục</label>
            <input type="text" class="form-control" id="sizeName" name="sizeName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitSize()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editSizeModal" tabindex="-1" aria-labelledby="editSizeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSizeModalLabel">Sửa Size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editSizeForm">
          <input type="hidden" id="editSizeId">
          <div class="form-group">
            <label for="editSizeName">Tên Size</label>
            <input type="text" class="form-control" id="editSizeName" name="sizeName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitEditSize()">Lưu</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    fetchSize();
});

function submitSize() {
    var sizeName = $('#sizeName').val();
    if (!sizeName) {
        alert("Please enter a size name.");
        return;
    }

    $.ajax({
        url: 'http://localhost/shoe-api/public/api/size', // Adjust the API URL
        type: 'POST',
        data: {
            ten: sizeName,
        },
        success: function(response) {
            $('#addSizeModal').modal('hide');
            fetchSize(); // Refresh the categories list
            $('#addSizeForm')[0].reset(); // Clear the form
            alert('Size added successfully!');
        },
        error: function(error) {
            console.error('Error adding size:', error);
            alert('Error adding size. Please try again.');
        }
    });
}

function editSize(id) {
    // Fetch the current data for the category
    fetch(`http://localhost/shoe-api/public/api/size/${id}`)
    .then(response => response.json())
    .then(data => {
        $('#editSizeId').val(data.id);
        $('#editSizeName').val(data.ten);
        $('#editSizeModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching size details:', error);
        alert('Could not fetch size details.');
    });
}

function submitEditSize() {
    var id = $('#editSizeId').val();
    var sizeName = $('#editSizeName').val();
    if (!sizeName) {
        alert("Please enter a size name.");
        return;
    }

    $.ajax({
        url: `http://localhost/shoe-api/public/api/size/${id}`,
        type: 'PUT',
        data: {
            ten: sizeName,
        },
        success: function(response) {
            $('#editSizeModal').modal('hide');
            fetchSize(); // Refresh the categories list
            alert('Size updated successfully!');
        },
        error: function(error) {
            console.error('Error updating size:', error);
            alert('Error updating size. Please try again.');
        }
    });
}



function fetchSize() {
    fetch('http://localhost/shoe-api/public/api/size') // Adjust the API URL
    .then(response => response.json())
    .then(data => displaySize(data))
    .catch(error => console.error('Error fetching size:', error));
}

function displaySize(sizes) {
    const tableBody = document.getElementById('size-list');
    tableBody.innerHTML = ''; // Clear the table body

    sizes.forEach(size => {
        const formattedCreatedAt = new Date(size.created_at).toLocaleDateString('en-US');
        const formattedUpdatedAt = new Date(size.updated_at).toLocaleDateString('en-US');
        const row = `
            <tr>
                <td>${size.id}</td>
                <td>${size.ten}</td>
                <td>${formattedCreatedAt}</td>
                <td>${formattedUpdatedAt}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="editSize(${size.id})"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSize(${size.id})"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

function deleteSize(id) {
    if (confirm(`Are you sure you want to delete size ${id}?`)) {
        $.ajax({
            url: `http://localhost/shoe-api/public/api/size/${id}`,
            type: 'DELETE',
            success: function(response) {
                fetchSize(); // Refresh the categories list
                alert('Size deleted successfully!');
            },
            error: function(error) {
                console.error('Error deleting size:', error);
                alert('Error deleting size. Please try again.');
            }
        });
    }
}

</script>
@endsection()