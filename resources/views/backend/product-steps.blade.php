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

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

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
                <table id="productTable" class="table  table-hover table-responsive display nowrap">
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
                      <td>{{ $product->cat_name ?? 'N/A' }}</td>
                      <td>{{ $product->mrp }}</td>
                      <td>{{ $product->selling_price }}</td>
                      @php
                      $images = json_decode($product->images, true);
                      @endphp
                      <td>
                        <div style="width: 60px; height: 50px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                          <img src="{{ asset('uploads/products/' . $images[0]) }}" alt="{{ $product->prod_name }}"
                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                      </td>

                      <td>{{ $product->stock }}</td>
                      <td>
                        @if($product->status)
                        <span class="status-label active">Active</span>
                        @else
                        <span class="status-label inactive">Inactive</span>
                        @endif
                      </td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-id="{{ $product->prod_id }}" data-name="{{ $product->prod_name }}" data-status="{{ $product->status }}">Edit</a>

                        <form action="{{ route('admin.product', $product->prod_id) }}" method="POST" class="d-inline">
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
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <form id="multiStepForm" method="POST" action="" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <!-- Step 1 => Basic Information -->
            <div class="form-step step-1">

              <div class="">
                <h5>Basic Information</h5>
              </div>

              <div class="">
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

                  <div class="col-md-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="2"></textarea>
                  </div>
                </div>

                <div class="mt-2">
                  <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
              </div>
            </div>

            <!-- Step 2 => Product Information -->
            <div class="form-step step-2 d-none">
              <div class="">
                <h5 class="mb-3">Product Information</h5>
              </div>

              <div class="row g-3">
                <!-- Fabric Name -->
                <div class="col-md-6">
                  <label class="form-label">Fabric Name</label>
                  <input type="text" name="fabric_name" class="form-control" required>
                </div>

                <!-- Color -->
                <div class="col-md-6">
                  <label class="form-label">Available Colors</label>
                  <input type="text" name="fabric_name" class="form-control" required>
                </div>

                <!-- Size -->
                <div class="col-md-12">
                  <label class="form-label">Available Sizes & Quantity</label>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Size</th>
                          <th>Select</th>
                          <th>Stock</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                        <tr>
                          <td>{{ $size }}</td>
                          <td>
                            <input type="checkbox" name="sizes[{{ $size }}][selected]" value="1">
                          </td>
                          <td>
                            <input type="number" name="sizes[{{ $size }}][stock]" class="form-control" placeholder="Stock for {{ $size }}">
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Style -->
                <div class="col-md-6">
                  <label class="form-label">Style</label>
                  <input type="text" name="style" class="form-control">
                </div>

                <!-- Sleeve Type -->
                <div class="col-md-6">
                  <label class="form-label">Sleeve Type</label>
                  <select name="sleeve_type" class="form-select">
                    <option value="">Select Sleeve Type</option>
                    <option value="Full">Full Sleeve</option>
                    <option value="Half">Half Sleeve</option>
                    <option value="Sleeveless">Sleeveless</option>
                  </select>
                </div>

                <!-- Neck Length -->
                <div class="col-md-6">
                  <label class="form-label">Neck Length</label>
                  <input type="text" name="neck_length" class="form-control">
                </div>

                <!-- Length -->
                <div class="col-md-6">
                  <label class="form-label">Length</label>
                  <select name="length" class="form-select">
                    <option value="">Select Length</option>
                    <option value="Short">Short</option>
                    <option value="Medium">Medium</option>
                    <option value="Long">Long</option>
                  </select>
                </div>
              </div>
            </div>


            <!-- Step 3 => Upload Images -->
            <div class="form-step step-3 d-none">
              <div class="">
                <h5>Upload Images</h5>
              </div>

              <div class="">
                <div class="row g-3">
                  <div class="col-md-12">
                    <label class="form-label">Images</label>
                    <input type="file" id="imageInput" class="form-control" name="images[]" multiple required>
                    <div id="imageList" class="mt-2 d-flex flex-wrap gap-2"></div>
                  </div>
                </div>

                <div class="mt-2">
                  <button type="button" class="btn btn-secondary prev-step">Back</button>
                  <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
              </div>
            </div>

            <!-- Step 4 => Pricing and quantity -->
            <div class="form-step step-4 d-none">

              <div class="">
                <h5>Pricing and quantity</h5>
              </div>

              <div class="">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">MRP</label>
                    <input type="number" name="mrp" class="form-control" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Stock</label>
                  <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="mt-2">
                  <button type="button" class="btn btn-secondary prev-step">Back</button>
                  <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
              </div>


            </div>

            <!-- Step 5 => Tags -->
            <div class="form-step step-5 d-none">
              <div class="">
                <h5>Tags</h5>
              </div>

              <div class="">
                <div class="row g-3">

                  <div class="col-md-6">
                    <label class="form-label">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="">
                  </div>
                </div>

                <div class="mt-2">
                  <button type="button" class="btn btn-secondary prev-step">Back</button>
                  <button type="submit" class="btn btn-success">Publish Product</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="submit" class="btn btn-primary">Save Product</button> -->
          </div>
        </form>

        <!-- <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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
                <label class="form-label">Images</label>
                <input type="file" id="imageInput" class="form-control" name="images[]" multiple required>
                <div id="imageList" class="mt-2 d-flex flex-wrap gap-2"></div>
              </div>


              <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Meta Keyword</label>
                <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="">
              </div>

              <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="2"></textarea>
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
        </form> -->
      </div>
    </div>
  </div>


</main><!-- End #main -->

<script>
  $('#addProductBtn').on('click', function() {
    var addModal = new bootstrap.Modal($('#addProductModal')[0]);
    addModal.show();
  });


  $(document).ready(function() {

    // steps navigation
    let currentStep = 0;
    const $steps = $('.form-step');

    function showStep(index) {
      $steps.addClass('d-none');
      $steps.eq(index).removeClass('d-none');
    }

    $('.next-step').click(function() {
      if (currentStep < $steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });

    $('.prev-step').click(function() {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });

    // Initialize first step
    showStep(currentStep);
  });
</script>


@endsection