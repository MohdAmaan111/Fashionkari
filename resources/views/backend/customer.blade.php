@extends('backend.layout.app')

@section('content')

<main id="main" class="main">

  <!-- Toast container for displaying success messages -->
  <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body" id="successToastMessage">
          <!-- Success message will go here -->
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div><!-- Toast container end -->

  <div class="pagetitle">
    <h1>Customers Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Customers</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card border rounded-3">
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between align-items-center">
              Customer List
              <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                Register
                <i class="bi bi-plus-circle fs-5"></i>
              </button>
            </h5>
          </div>
          </h5>
          <form id="bulkDeleteForm" method="post">
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
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($customers as $customer)
                  <tr>
                    <td>
                      <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                    </td>
                    <td>{{ $customer->cus_id ?? 'N/A' }}</td>
                    <td>{{ $customer->cus_name ?? 'N/A' }}</td>
                    <td>{{ $customer->email ?? 'N/A' }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>{{ $customer->address ?? 'N/A' }}</td>
                    <td>{{ $customer->city ?? 'N/A' }}</td>
                    <td>{{ $customer->state ?? 'N/A' }}</td>
                    <td>{{ $customer->country ?? 'N/A' }}</td>
                    <td>{{ $customer->postal_code ?? 'N/A' }}</td>
                    <td>
                      <button type="button" class="btn btn-outline-primary btn-sm rounded-circle shadow-sm view-customer-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#viewCustomerModal"
                        data-id="{{ $customer->cus_id }}"
                        data-name="{{ $customer->cus_name }}"
                        data-email="{{ $customer->email }}"
                        data-phone="{{ $customer->phone }}"
                        data-address="{{ $customer->address }}"
                        data-city="{{ $customer->city }}"
                        data-state="{{ $customer->state }}"
                        data-country="{{ $customer->country }}"
                        data-postal_code="{{ $customer->postal_code }}">
                        <i class="bi bi-eye fs-6"></i> <!-- Font Awesome icon -->
                      </button>
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

  <!-- Register Customer Modal -->
  <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div id="success_message" class="alert alert-success" style="display: none;"></div>

        <!-- <form action="{{ route('admin.customer.register') }}" method="POST"> -->
        <form id="customerRegisterForm">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label">Customer Name</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control" required>
                <!-- cutomer name error -->
                <div id="error_customer_name" class="text-danger"></div>
              </div>

              <div class="col-md-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                <!-- email error -->
                <div id="error_email" class="text-danger"></div>
              </div>

              <div class="col-md-12">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                <!-- password error -->
                <div id="error_password" class="text-danger"></div>
              </div>

              <div class="col-md-12">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Register Customer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Customer Details Modal -->
  <div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewCustomerModalLabel">Customer Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>ID:</strong> <span id="modal-cus-id"></span></p>
          <p><strong>Name:</strong> <span id="modal-cus-name"></span></p>
          <p><strong>Email:</strong> <span id="modal-cus-email"></span></p>
          <p><strong>Phone:</strong> <span id="modal-cus-phone"></span></p>
          <p><strong>Address:</strong> <span id="modal-cus-address"></span></p>
          <p><strong>City:</strong> <span id="modal-cus-city"></span></p>
          <p><strong>State:</strong> <span id="modal-cus-state"></span></p>
          <p><strong>Country:</strong> <span id="modal-cus-country"></span></p>
          <p><strong>Postal Code:</strong> <span id="modal-cus-postal_code"></span></p>
        </div>
      </div>
    </div>
  </div>

</main><!-- End #main -->

<script>
  $(document).ready(function() {
    // alert("jQuery is working!");
  });

  // Shows a success toast using Bootstrap with a custom message
  function showSuccessToast(message) {
    const toastEl = document.getElementById('successToast');
    const toastMessage = document.getElementById('successToastMessage');

    toastMessage.textContent = message;

    // Initialize and show Bootstrap toast
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }

  // Handles click event to display individual customer information in a modal
  $(document).on('click', '.view-customer-btn', function() {
    $('#modal-cus-id').text($(this).data('id'));
    $('#modal-cus-name').text($(this).data('name'));
    $('#modal-cus-email').text($(this).data('email'));
    $('#modal-cus-phone').text($(this).data('phone'));
    $('#modal-cus-address').text($(this).data('address'));
    $('#modal-cus-city').text($(this).data('city'));
    $('#modal-cus-state').text($(this).data('state'));
    $('#modal-cus-country').text($(this).data('country'));
    $('#modal-cus-postal_code').text($(this).data('postal_code'));
  });

  // To register customer with ajax
  $('#customerRegisterForm').on('submit', function(e) {
    e.preventDefault(); // prevent page reload

    // Clear old errors
    $('#error_customer_name, #error_email, #error_password').text('');

    $.ajax({
      url: "{{ route('admin.customer.register') }}", // Your controller route
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        // ✅ Show success toast
        showSuccessToast(response.message);

        // ✅ Reset form
        // $('#customerRegisterForm')[0].reset();

        // ✅ Reload after 2 seconds
        setTimeout(function() {
          location.reload();
        }, 2000);
      },
      error: function(xhr) {
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;
          if (errors.customer_name) {
            $('#error_customer_name').text(errors.customer_name[0]);
          }
          if (errors.email) {
            $('#error_email').text(errors.email[0]);
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