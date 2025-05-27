@extends('backend.layout.app')

@section('content')

<main id="main" class="main">

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

            <form id="bulkDeleteForm" method="post">
              <h5 class="card-title d-flex justify-content-between align-items-center">
                Customer List

                <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                  Add
                  <i class="bi bi-plus-circle fs-5"></i>
                </button>
              </h5>
          </div>
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
                  <th>Phone</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Postal Code</th>
                  <th>Action</th>
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
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-id="{{ $customer->cus_id }}" data-name="{{ $customer->cus_name }}" data-status="{{ $customer->status }}">Edit</a>

                    <form action="" method="POST" class="d-inline">
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

  <!-- Add Product Modal -->
  <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('customer.register') }}" method="POST">
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
                @error('customer_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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


</main><!-- End #main -->

@endsection