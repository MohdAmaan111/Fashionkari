@extends('backend.layout.app')

@section('content')

<main id="main" class="main">

  <!-- Success Message -->
  <div id="successMessage" style="display:none; position:fixed; top:20px; right:20px; background:#28a745; color:#fff; padding:10px 20px; border-radius:5px; z-index:9999;">
  </div>

  <div class="pagetitle">
    <h1>Users Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card border rounded-3">
          <div class="card-body">

            <form id="bulkDeleteForm" method="post">
              <h5 class="card-title d-flex justify-content-between align-items-center">
                User List

                <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                  Register
                  <i class="bi bi-plus-circle fs-5"></i>
                </button>
              </h5>
              <!-- Product table data start -->
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table id="productTable" class="table  table-hover table-responsive display nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created_at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </td>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email}}</td>
                      <td>{{ $user->created_at }}</td>

                      <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-status="{{ $user->status }}">Edit</a>

                        <form action="{{ route('admin.user', $user->prod_id) }}" method="POST" class="d-inline">
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

  <!-- Register User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <form action="{{ route('admin.register') }}" method="POST"> -->
        <form id="userRegisterForm">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Register User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <!-- Form Fields -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
              <!-- name error -->
              <div id="error_name" class="text-danger"></div>

              <label for="email" class="form-label mt-3">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <!-- email error -->
              <div id="error_email" class="text-danger"></div>

              <label for="username" class="form-label mt-3">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
              <!-- username error -->
              <div id="error_username" class="text-danger"></div>

              <label for="password" class="form-label mt-3">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <!-- password error -->
              <div id="error_password" class="text-danger"></div>

              <label for="password_confirmation" class="form-label mt-3">Confirm Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</main><!-- End #main -->

<script>
  // To register user with ajax
  $('#userRegisterForm').on('submit', function(e) {
    e.preventDefault(); // prevent page reload

    // Clear old errors
    $('#error_name, #error_email, #error_username, #error_password').text('');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
      }
    });

    $.ajax({
      url: "{{ route('admin.register') }}", // Your controller route
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        // ✅ Show success toast
        $('#successMessage')
          .text(response.message)
          .fadeIn(200)
          .delay(1500)
          .fadeOut(400);

        // ✅ Reload after 2 seconds
        setTimeout(function() {
          location.reload();
        }, 2000);
      },
      error: function(xhr) {
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;
          if (errors.name) {
            $('#error_name').text(errors.name[0]);
          }
          if (errors.email) {
            $('#error_email').text(errors.email[0]);
          }
          if (errors.username) {
            $('#error_username').text(errors.username[0]);
          }
          if (errors.password) {
            $('#error_password').text(errors.password[0]);
          }
        }
      }
    });
  });
</script>

@endsection