@extends('backend.layout.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Category Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  @if(session('success'))
  <!-- <p style="color:green;">{{ session('success') }}</p> -->
  @endif

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card border rounded-3">
          <div class="card-body">

            <form id="bulkDeleteForm" method="post">
              <h5 class="card-title d-flex justify-content-between align-items-center">
                Category List

                <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                  Add
                  <i class="bi bi-plus-circle fs-5"></i>
                </button>
              </h5>
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table id="productTable" class="table table-striped table-hover table-responsive display nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </th>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    <tr>
                      <td>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </td>
                      <td>{{ $category->cat_id }}</td>
                      <td>{{ $category->cat_name }}</td>
                      <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                      <td>{{ $category->created_at->format('Y-m-d') }}</td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary edit-category" data-id="{{ $category->cat_id }}" data-name="{{ $category->cat_name }}" data-status="{{ $category->status }}">Edit</a>

                        <form action="{{ route('admin.category', $category->cat_id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this user?')">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>

                </table>
                <!-- End Table with stripped rows -->
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('admin.category.store') }}" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form Fields -->
            @csrf
            <div class="mb-3">
              <label for="categoryName" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" name="cat_name" required>

              <label for="status" class="form-label">Status:</label>
              <select class="form-select" id="status" name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <!-- Add more fields as needed -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Category Modal -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="update_category.php" method="POST"> <!-- adjust to your Laravel route if needed -->
        <input type="hidden" name="cat_id" id="editCatId">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <!-- Category Name -->
            <div class="mb-3">
              <label for="editCatName" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="editCatName" name="cat_name" required>
            </div>
            <!-- Status -->
            <div class="mb-3">
              <label for="editStatus" class="form-label">Status</label>
              <select class="form-select" id="editStatus" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>


</main><!-- End #main -->

<script>
  document.getElementById('addCategoryBtn').addEventListener('click', function() {
    var myModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
    myModal.show();
  });

  document.querySelectorAll('.edit-category').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const status = this.getAttribute('data-status');

      // Fill modal fields
      document.getElementById('editCatId').value = id;
      document.getElementById('editCatName').value = name;
      document.getElementById('editStatus').value = status;

      // Show the modal
      const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
      editModal.show();
    });
  });
</script>

@endsection