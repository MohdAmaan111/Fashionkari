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
                    <li><a class="dropdown-item" href="javascript:void(0);" id="addProductBtn">Add Product</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="bulkUploadProductBtn" data-bs-toggle="modal" data-bs-target="#bulkUploadProductModal">Bulk Upload</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="addCategoryBtn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="return confirm('Are you sure to delete selected categories?')">Bulk Delete</a></li>
                  </ul>
                </div>
              </h5>
              <!-- Product table data start -->
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table id="productTable" class="table table-striped table-hover table-responsive display nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>MRP</th>
                      <th>Selling Price</th>
                      <th>Image</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>
                        <div class="form-check"><input type="checkbox" class="form-check-input product-checkbox" id="select-all"></div>
                      </td>
                      <td>{{ $product->prod_id }}</td>
                      <td>{{ $product->prod_name }}</td>
                      <td>{{ $product->category->name ?? 'N/A' }}</td>
                      <td>{{ $product->mrp }}</td>
                      <td>{{ $product->selling_price }}</td>
                      <td>
                        <div style="width: 60px; height: 50px; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc;">
                          <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image"
                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                      </td>

                      <td>{{ $product->stock }}</td>
                      <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
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
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                  <option value="">Select Category</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">MRP</label>
                <input type="number" name="mrp" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Selling Price</label>
                <input type="number" name="selling_price" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Meta Keyword</label>
                <input type="text" name="meta_keyword" class="form-control">
              </div>

              <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="2"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</main><!-- End #main -->

<script>
  document.getElementById('addProductBtn').addEventListener('click', function() {
    var addModal = new bootstrap.Modal(document.getElementById('addProductModal'));
    addModal.show();
  });
</script>


@endsection