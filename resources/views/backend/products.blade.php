@extends('backend.layout.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Product Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card border rounded-3">
          <div class="card-body">

            <form id="bulkDeleteForm" method="post">
              <h5 class="card-title">Product List

                <!-- Example single danger button -->
                <div class="btn-group float-end">
                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Actions
                  </button>
                  <ul class="dropdown-menu py-0">
                    <li><a class="dropdown-item" href="javascript:void(0);" id="addProductBtn">Add Category</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="bulkUploadProductBtn" data-bs-toggle="modal" data-bs-target="#bulkUploadProductModal">Bulk Upload</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="addCategoryBtn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="return confirm('Are you sure to delete selected categories?')">Bulk Delete</a></li>
                  </ul>
                </div>
              </h5>
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table id="productTable" class="table table-striped table-hover table-responsive display nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>MRP</th>
                      <th>Offer Price</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                </table>
                <!-- End Table with stripped rows -->
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->

<script>
  document.getElementById('addProductBtn').addEventListener('click', function() {
    var myModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
    myModal.show();
  });
</script>

@endsection