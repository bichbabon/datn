@extends('../layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container">
    <h3 class="mt-5">Quản lý màu sắc </h3>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMauSacModal">Thêm  màu sắc</button>
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
            <tbody id="mausac-list">
                <!-- Categories will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMauSacModal" tabindex="-1" aria-labelledby="addMauSacModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMauSacModalLabel">Thêm màu sắc mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addMauSacForm">
          <div class="form-group">
            <label for="mauSacName">Tên màu sắc</label>
            <input type="text" class="form-control" id="mauSacName" name="mauSacName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitMauSac()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editMauSacModal" tabindex="-1" aria-labelledby="editMauSacModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMauSacModalLabel">Sửa màu sắc</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editMauSacForm">
          <input type="hidden" id="editMauSacId">
          <div class="form-group">
            <label for="editMauSacName">Tên màu sắc</label>
            <input type="text" class="form-control" id="editMauSacName" name="mauSacName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="submitEditMauSac()">Lưu</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    fetchMauSac();
});

function submitMauSac() {
    var mauSacName = $('#mauSacName').val();
    if (!mauSacName) {
        alert("Please enter a mausac name.");
        return;
    }

    $.ajax({
        url: 'http://localhost/shoe-api/public/api/mausac', // Adjust the API URL
        type: 'POST',
        data: {
            ten: mauSacName,
        },
        success: function(response) {
            $('#addMauSacModal').modal('hide');
            fetchMauSac(); // Refresh the categories list
            $('#addMauSacForm')[0].reset(); // Clear the form
            alert('mausac added successfully!');
        },
        error: function(error) {
            console.error('Error adding mausac:', error);
            alert('Error adding mausac. Please try again.');
        }
    });
}

function editMauSac(id) {
    // Fetch the current data for the category
    fetch(`http://localhost/shoe-api/public/api/mausac/${id}`)
    .then(response => response.json())
    .then(data => {
        $('#editMauSacId').val(data.id);
        $('#editMauSacName').val(data.ten);
        $('#editMauSacModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching mausac details:', error);
        alert('Could not fetch mausac details.');
    });
}

function submitEditMauSac() {
    var id = $('#editMauSacId').val();
    var mauSacName = $('#editMauSacName').val();
    if (!mauSacName) {
        alert("Please enter a mausac name.");
        return;
    }

    $.ajax({
        url: `http://localhost/shoe-api/public/api/mausac/${id}`,
        type: 'PUT',
        data: {
            ten: mauSacName,
        },
        success: function(response) {
            $('#editMauSacModal').modal('hide');
            fetchMauSac(); // Refresh the categories list
            alert('mausac updated successfully!');
        },
        error: function(error) {
            console.error('Error updating mausac:', error);
            alert('Error updating mausac. Please try again.');
        }
    });
}



function fetchMauSac() {
    fetch('http://localhost/shoe-api/public/api/mausac') // Adjust the API URL
    .then(response => response.json())
    .then(data => displayMauSac(data))
    .catch(error => console.error('Error fetching mausac:', error));
}

function displayMauSac(sizes) {
    const tableBody = document.getElementById('mausac-list');
    tableBody.innerHTML = '';

    sizes.forEach(mausac => {
        const formattedCreatedAt = new Date(mausac.created_at).toLocaleDateString('en-US');
        const formattedUpdatedAt = new Date(mausac.updated_at).toLocaleDateString('en-US');
        const row = `
            <tr>
                <td>${mausac.id}</td>
                <td>${mausac.ten}</td>
                <td>${formattedCreatedAt}</td>
                <td>${formattedUpdatedAt}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="editMauSac(${mausac.id})"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteMauSac(${mausac.id})"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

function deleteMauSac(id) {
    if (confirm(`Are you sure you want to delete mausac ${id}?`)) {
        $.ajax({
            url: `http://localhost/shoe-api/public/api/mausac/${id}`,
            type: 'DELETE',
            success: function(response) {
                fetchMauSac(); // Refresh the categories list
                alert('mausac deleted successfully!');
            },
            error: function(error) {
                console.error('Error deleting mausac:', error);
                alert('Error deleting mausac. Please try again.');
            }
        });
    }
}

</script>
@endsection()