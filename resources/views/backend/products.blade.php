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

              <button type="button" id="addProductBtn" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2">
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
                    <td>{{ $product->category->cat_name ?? 'N/A' }}</td>

                    <td>
                      @if ($product->variants->isNotEmpty())
                      <div>{{ $product->variants->first()->color }}</div>
                      @else
                      <button class="btn-icon-outline-blue" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                      @endif
                    </td>
                    <td>
                      @php
                      $firstVariant = $product->variants->first();
                      $variantImages = json_decode($firstVariant->images ?? '[]', true);
                      @endphp

                      @if ($product->variants->isNotEmpty())
                      <img src="{{ asset('uploads/products/' . $variantImages[0]) }}" width="40">
                      @else
                      <button class="btn-icon-outline-blue" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                      @endif
                    </td>
                    <td>
                      @if ($product->variants->isNotEmpty())
                      {{ $product->variants->sum('stock') }} pcs
                      @else
                      <button class="btn-icon-outline-blue" data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                      @endif
                    </td>

                    <td>
                      @if($product->status)
                      <span class="status-label active">Active</span>
                      @else
                      <span class="status-label inactive">Inactive</span>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="javascript:void(0);"
                              class="dropdown-item edit-product-btn"
                              data-id="{{ $product->prod_id }}"
                              data-name="{{ $product->product_name }}"
                              data-fabric="{{ $product->fabric_name }}"
                              data-brand="{{ $product->brand_id }}"
                              data-category="{{ $product->category_id }}"
                              data-age="{{ $product->age_group }}"
                              data-neck="{{ $product->neck_type }}"
                              data-length="{{ $product->length_type }}"
                              data-sleeve="{{ $product->sleeve_type }}"
                              data-fit="{{ $product->fit_type }}"
                              data-care="{{ $product->care_instructions }}"
                              data-description="{{ $product->prod_description }}"
                              data-meta-title="{{ $product->meta_title }}"
                              data-meta-keyword="{{ $product->meta_keyword }}"
                              data-meta-description="{{ $product->meta_description }}">
                              Edit Product
                            </a>
                          </li>
                          @php
                          $firstVariant = $product->variants->first();
                          $color = $firstVariant->color ?? '';

                          $sizesArray = $product->variants->map(function ($variant) {
                          return [
                          'size' => $variant->size,
                          'stock' => $variant->stock,
                          'mrp' => $variant->mrp,
                          'selling_price' => $variant->selling_price,
                          ];
                          });
                          @endphp
                          <li>
                            <a href="javascript:void(0);"
                              class="dropdown-item edit-variant-btn"
                              data-id="{{ $product->prod_id }}"
                              data-color="{{ $color }}"
                              data-variants='@json($sizesArray)'>
                              Edit Variants
                            </a>
                          </li>
                        </ul>
                      </div>
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

        <form action="{{ route('admin.product.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="product_id" id="editProductId">

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

              <!-- Sleeve -->
              <div class="col-md-6">
                <label class="form-label">Sleeve Type</label>
                <select name="sleeve_type" class="form-select">
                  <option value="">Select Sleeve Type</option>
                  <option value="Full">Full Sleeve</option>
                  <option value="Half">Half Sleeve</option>
                  <option value="Sleeveless">Sleeveless</option>
                </select>
              </div>

              <!-- Fit Type -->
              <div class="col-md-6">
                <label class="form-label">Fit Type</label>
                <select name="fit_type" class="form-select">
                  <option value="">Select Fit Type</option>
                  <option value="Slim">Slim Fit</option>
                  <option value="Regular">Regular Fit</option>
                  <option value="Loose">Loose Fit</option>
                </select>
              </div>

              <!-- Care Instructions -->
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

              <!-- Product Description -->
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

  @foreach ($products as $product)
  <!---- Your product row ---->

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
              <label for="imageUpload" class="form-label">Image</label>
              <div class="d-flex gap-3 flex-wrap">

                <!-- Image 1 -->
                <div>
                  <div class="image-preview" id="imagePreviewBox1_{{ $product->prod_id }}">
                    <div class="img-holder text-center">
                      <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                      <small>Click to select</small>
                    </div>
                  </div>
                  <input type="file" name="images[]" id="imageInput1_{{ $product->prod_id }}" accept="image/*" style="display: none;">
                </div>

                <!-- Image 2 -->
                <div>
                  <div class="image-preview" id="imagePreviewBox2_{{ $product->prod_id }}">
                    <div class="img-holder text-center">
                      <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                      <small>Click to select</small>
                    </div>
                  </div>
                  <input type="file" name="images[]" id="imageInput2_{{ $product->prod_id }}" accept="image/*" style="display: none;">
                </div>

                <!-- Image 3 -->
                <div>
                  <div class="image-preview" id="imagePreviewBox3_{{ $product->prod_id }}">
                    <div class="img-holder text-center">
                      <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                      <small>Click to select</small>
                    </div>
                  </div>
                  <input type="file" name="images[]" id="imageInput3_{{ $product->prod_id }}" accept="image/*" style="display: none;">
                </div>
              </div>

            </div>

            <!-- Sizes -->
            <div class="mb-3">
              <label class="form-label">Available Sizes & Details</label>
              <div class="table-responsive">
                <table class="table table-bordered" id="sizeTable sizeTable_{{ $product->prod_id }}">
                  <thead>
                    <tr>
                      <th>Size</th>
                      <th>Stock</th>
                      <th>MRP</th>
                      <th>Selling Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="variantTableBody{{ $product->prod_id }}">
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
  @endforeach



  <div class="modal fade" id="variantModal{{ $product->prod_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Edit Variants for {{ $product->product_name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="variantModalBody_{{ $product->prod_id }}">
          <!-- Fetched via AJAX -->
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>


</main><!-- End #main -->

<script>
  $('#addProductBtn').on('click', function() {
    // Reset form inputs to empty/default values
    $('#productForm')[0].reset();

    // Also clear hidden product_id input if present
    $('#productForm input[name="product_id"]').val('');

    // Then show modal
    var addModal = new bootstrap.Modal($('#addProductModal')[0]);
    addModal.show();
  });

  // Write the jQuery to fill in modal fields when "Edit Product Variant" is clicked
  $(document).on('click', '.edit-variant-btn', function() {
    const productId = $(this).data('id');
    const color = $(this).data('color');
    const variants = $(this).data('variants'); // This will be an array of objects

    console.log("Product ID:", productId);
    console.log("Color:", color);
    console.log("Variants:", variants);

    $(`#variantModal${productId} input[name="color"]`).val(color); // Set color


    // Clear the table body
    const tbody = $(`#variantTableBody${productId}`);
    tbody.empty();

    // Populate with variants
    variants.forEach((variant, index) => {
      const row = `
          <tr>
            <td>
              <div class="form-check d-flex align-items-center gap-2">
                <input type="checkbox" name="sizes[${index}][selected]" value="1" class="form-check-input" checked>
                <input type="text" name="sizes[${index}][size]" class="form-control" value="${variant.size}" style="width: 80px;">
              </div>
            </td>
            <td><input type="number" name="sizes[${index}][stock]" class="form-control" value="${variant.stock}" placeholder="Stock"></td>
            <td><input type="number" name="sizes[${index}][mrp]" class="form-control" value="${variant.mrp}" placeholder="MRP"></td>
            <td><input type="number" name="sizes[${index}][selling_price]" class="form-control" value="${variant.selling_price}" placeholder="Selling Price"></td>
            <td class="text-center">
              <button type="button" class="btn btn-danger removeRowBtn">−</button>
            </td>
          </tr>`;
      tbody.append(row);
    });

    // Show the modal
    $('#variantModal' + productId).modal('show');
  });

  // Write the jQuery to fill in modal fields when "Edit Product" is clicked
  $(document).on('click', '.edit-product-btn', function() {
    // Extract data
    const $btn = $(this);

    const productId = $btn.data('id');
    const productName = $btn.data('name');
    const fabricName = $btn.data('fabric');
    const brandId = $btn.data('brand');
    const categoryId = $btn.data('category');
    const ageGroup = $btn.data('age');
    const neckType = $btn.data('neck');
    const lengthType = $btn.data('length');
    const sleeveType = $btn.data('sleeve');
    const fitType = $btn.data('fit');
    const careInstructions = $btn.data('care');
    const description = $btn.data('description');
    const metaTitle = $btn.data('meta-title');
    const metaKeyword = $btn.data('meta-keyword');
    const metaDescription = $btn.data('meta-description');


    // Fill modal fields
    $('#addProductModal input[name="product_id"]').val(productId);
    $('#addProductModal input[name="product_name"]').val(productName);
    $('#addProductModal input[name="fabric_name"]').val(fabricName);
    $('#addProductModal select[name="brand_id"]').val(brandId);
    $('#addProductModal select[name="category_id"]').val(categoryId);
    $('#addProductModal select[name="age_group"]').val(ageGroup);
    $('#addProductModal select[name="neck_type"]').val(neckType);
    $('#addProductModal select[name="length_type"]').val(lengthType);
    $('#addProductModal select[name="sleeve_type"]').val(sleeveType);
    $('#addProductModal select[name="fit_type"]').val(fitType);
    $('#addProductModal select[name="care_instructions"]').val(careInstructions);
    $('#addProductModal textarea[name="prod_description"]').val(description);
    $('#addProductModal input[name="meta_title"]').val(metaTitle);
    $('#addProductModal input[name="meta_keyword"]').val(metaKeyword);
    $('#addProductModal textarea[name="meta_description"]').val(metaDescription);

    // Show the modal
    $('#addProductModal').modal('show');
  });
  // Edit Product Modal End


  // Define the binding function for preview image
  function bindImagePreview(previewId, inputId) {
    // When preview box is clicked
    $(`#${previewId}`).on('click', function() {
      $(`#${inputId}`).val('');
      $(`#${inputId}`).click();
    });

    // When file is selected
    $(`#${inputId}`).on('change', function() {
      const file = this.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $(`#${previewId}`).html(`
            <div class="position-relative">
              <img src="${e.target.result}" alt="Preview" class="img-fluid">
              <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn" data-input="${inputId}" data-preview="${previewId}" style="z-index: 10;">&times;</button>
            </div>
          `);
        };
        reader.readAsDataURL(file);
      }
      // Reset input so same file can be selected again later
    });
  }

  // Now run the script after DOM is ready
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


    // preview input image

    // Handle remove buttons (one-time global binding)
    $(document).on('click', '.remove-image-btn', function() {
      const inputId = $(this).data('input');
      const previewId = $(this).data('preview');

      $(`#${inputId}`).val('');
      $(`#${previewId}`).html(`
        <div class="img-holder text-center">
          <i class="bi bi-image" style="font-size: 2rem;"></i><br>
          <small>Click to select</small>
        </div>
      `);
    });

    // Bind for type 1
    $("[id^=imagePreviewBox1_]").each(function() {
      const previewId = $(this).attr("id");
      const suffix = previewId.split("_")[1];
      bindImagePreview(previewId, `imageInput1_${suffix}`);
    });

    // Bind for type 2
    $("[id^=imagePreviewBox2_]").each(function() {
      const previewId = $(this).attr("id");
      const suffix = previewId.split("_")[1];
      bindImagePreview(previewId, `imageInput2_${suffix}`);
    });

    // Bind for type 3
    $("[id^=imagePreviewBox3_]").each(function() {
      const previewId = $(this).attr("id");
      const suffix = previewId.split("_")[1];
      bindImagePreview(previewId, `imageInput3_${suffix}`);
    });

    // preview input image end


</script>


@endsection