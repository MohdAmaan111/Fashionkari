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

            <!-- <form id="bulkDeleteForm" method="post"> -->
            <h5 class="card-title d-flex justify-content-between align-items-center">
              Product List

              <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
                Add
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
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Color</th>
                    <th>Image</th>
                    <th>Quantity</th>
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
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->cat_name ?? 'N/A' }}</td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-circle me-1"></i> Add
                      </button>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-circle me-1"></i> Add
                      </button>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-circle me-1"></i> Add
                      </button>
                    </td>
                    <td>
                      @if($product->status)
                      <span class="status-label active">Active</span>
                      @else
                      <span class="status-label inactive">Inactive</span>
                      @endif
                    </td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-id="{{ $product->prod_id }}" data-name="{{ $product->prod_name }}" data-status="{{ $product->status }}">Edit</a>

                      <!-- <form action="{{ route('admin.product', $product->prod_id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this user?')">Delete</button>
                        </form> -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>

              </table>
              <!-- End Table with stripped rows -->
            </div>
            <!-- </form> -->
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <!-- Product -->
              <div class="col-md-6">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" required>
              </div>

              <!-- Fabric -->
              <div class="col-md-6">
                <label class="form-label">Fabric</label>
                <input type="text" name="fabric_name" class="form-control" required>
              </div>

              <!-- Brand -->
              <div class="col-md-6">
                <label class="form-label">Brand</label>
                <select name="brand_id" class="form-control" required>
                  <option value="">Select Brand</option>
                  @foreach ($brands as $brand)
                  <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Category -->
              <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                  <option value="">Select Category</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Age Group -->
              <div class="col-md-6">
                <label class="form-label">Age Group</label>
                <select name="age_group" class="form-select">
                  <option value="">Select Age Group</option>
                  <option value="Men">Men</option>
                  <option value="Women">Women</option>
                  <option value="Baby">Baby</option>
                  <option value="Boy">Boy</option>
                  <option value="Girl">Girl</option>
                </select>
              </div>

              <!-- Neck Length -->
              <div class="col-md-6">
                <label class="form-label">Neck Type</label>
                <select name="neck_type" class="form-select">
                  <option value="">Select Length</option>
                  <option value="Round Neck">Round Neck</option>
                  <option value="V-Neck">V-Neck</option>
                  <option value="Collar">Collar</option>
                  <option value="Mandarin Collar">Mandarin Collar</option>
                  <option value="High Neck">High Neck</option>
                </select>
              </div>

              <!-- Length -->
              <div class="col-md-6">
                <label class="form-label">Length Type</label>
                <select name="length_type" class="form-select">
                  <option value="">Select Length Type</option>
                  <option value="Crop">Crop</option>
                  <option value="Waist Length">Waist Length</option>
                  <option value="Hip Length">Hip Length</option>
                  <option value="Thigh Length">Thigh Length</option>
                  <option value="Knee Length">Knee Length</option>
                  <option value="Mid-Calf Length">Mid-Calf Length</option>
                  <option value="Ankle Length">Ankle Length</option>
                  <option value="Full Length">Full Length</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Sleeve Type</label>
                <select name="sleeve_type" class="form-select">
                  <option value="">Select Sleeve Type</option>
                  <option value="Full">Full Sleeve</option>
                  <option value="Half">Half Sleeve</option>
                  <option value="Sleeveless">Sleeveless</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Fit Type</label>
                <select name="fit_type" class="form-select">
                  <option value="">Select Fit Type</option>
                  <option value="Slim">Slim Fit</option>
                  <option value="Regular">Regular Fit</option>
                  <option value="Loose">Loose Fit</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Care Instructions</label>
                <select name="care_instructions" class="form-select">
                  <option value="">Select Care Instructions</option>
                  <option value="Machine Wash">Machine Wash</option>
                  <option value="Hand Wash Only">Hand Wash Only</option>
                  <option value="Dry Clean Only">Dry Clean Only</option>
                  <option value="Do Not Bleach">Do Not Bleach</option>
                  <option value="Tumble Dry Low">Tumble Dry Low</option>
                  <option value="Line Dry">Line Dry</option>
                  <option value="Iron at Low Temperature">Iron at Low Temperature</option>
                </select>
              </div>

              <div class="col-md-12">
                <label class="form-label">Product Description</label>
                <textarea name="prod_description" id="prod_description" class="form-control" rows="2"></textarea>
              </div>

              <!-- Toggle Button -->
              <div class="col-md-12 mt-2">
                <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#metaInfoSection" aria-expanded="false" aria-controls="metaInfoSection">
                  <i class="bi bi-info-circle me-1"></i> Add Meta Information (Optional)
                </button>
              </div>

              <!-- Collapsible Meta Info Section -->
              <div class="collapse mt-3" id="metaInfoSection">
                <div class="card card-body border rounded shadow-sm">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Meta Title</label>
                      <input type="text" name="meta_title" class="form-control">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label">Meta Keyword</label>
                      <input type="text" name="meta_keyword" class="form-control" placeholder="">
                    </div>

                    <div class="col-md-12">
                      <label class="form-label">Meta Description</label>
                      <textarea name="meta_description" class="form-control" rows="2"></textarea>
                    </div>
                  </div>
                </div>
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

  <!-- Variant Modal -->
  <div class="modal fade" id="variantModal{{ $product->prod_id }}" tabindex="-1" aria-labelledby="variantModalLabel{{ $product->prod_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.variant.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="product_id" value="{{ $product->prod_id }}">

          <div class="modal-header">
            <h5 class="modal-title" id="variantModalLabel{{ $product->prod_id }}">Add Variant for {{ $product->product_name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <!-- Color -->
            <div class="mb-3">
              <label for="color" class="form-label">Color</label>
              <input type="text" class="form-control" name="color" required>
            </div>

            <!-- Image -->
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" class="form-control" name="image" required>
            </div>

            <!-- Sizes -->
            <div class="mb-3">
              <label class="form-label">Available Sizes & Details</label>
              <div class="table-responsive">
                <table class="table table-bordered" id="sizeTable">
                  <thead>
                    <tr>
                      <th>Size</th>
                      <th>Stock</th>
                      <th>MRP</th>
                      <th>Selling Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                    <tr>
                      <td>
                        <div class="form-check d-flex align-items-center gap-2">
                          <input type="checkbox" name="sizes[{{ $loop->index }}][selected]" value="1" class="form-check-input">
                          <input type="text" name="sizes[{{ $loop->index }}][size]" class="form-control" value="{{ $size }}" style="width: 80px;">
                        </div>
                      </td>
                      <td><input type="number" name="sizes[{{ $loop->index }}][stock]" class="form-control" placeholder="Stock"></td>
                      <td><input type="number" name="sizes[{{ $loop->index }}][mrp]" class="form-control" placeholder="MRP"></td>
                      <td><input type="number" name="sizes[{{ $loop->index }}][selling_price]" class="form-control" placeholder="Selling Price"></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger removeRowBtn">−</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <button type="button" class="btn btn-success mt-2" id="addSizeRowBtn">
                  <i class="fas fa-plus-circle"></i> Add Size
                </button>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Variant</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>

        </form>
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

    // product variants modal
    let sizeIndex = $('#sizeTable tbody tr').length;

    $('#addSizeRowBtn').on('click', function() {
      const newRow = `
        <tr>
          <td>
            <div class="form-check d-flex align-items-center gap-2">
              <input type="checkbox" name="sizes[${sizeIndex}][selected]" value="1" class="form-check-input">
              <input type="text" name="sizes[${sizeIndex}][size]" class="form-control" placeholder="Size" style="width: 80px;">
            </div>
          </td>
          <td><input type="number" name="sizes[${sizeIndex}][stock]" class="form-control" placeholder="Stock"></td>
          <td><input type="number" name="sizes[${sizeIndex}][mrp]" class="form-control" placeholder="MRP"></td>
          <td><input type="number" name="sizes[${sizeIndex}][selling_price]" class="form-control" placeholder="Selling Price"></td>
          <td class="text-center">
            <button type="button" class="btn btn-danger removeRowBtn">−</button>
          </td>
        </tr>
      `;
      $('#sizeTable tbody').append(newRow);
      sizeIndex++;
    });

    $(document).on('click', '.removeRowBtn', function() {
      $(this).closest('tr').remove();
    });
    // product variants modal end


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