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
                    <th>Delete</th>
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
                    <td>{{ $product->color }}</td>

                    <!-- Product Images -->
                    <td>
                      @php
                      $image = json_decode($product->images ?? '[]', true);
                      // Use a placeholder/default
                      $firstImage = !empty($image) ? $image[0] : 'default.png';
                      @endphp
                      <img src="{{ asset('uploads/products/' . $firstImage) }}" width="40">
                    </td>
                    <!-- Product Variant -->
                    <td>
                      @if ($product->variants->isNotEmpty())
                      {{ $product->variants->sum('stock') }} pcs
                      @else
                      <button class="btn-icon-outline-blue" id="addVariantBtn" data-product-id="{{ $product->prod_id }}"
                        data-bs-toggle="modal" data-bs-target="#variantModal{{ $product->prod_id }}">
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
                    <!-- Action Button -->
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          @php
                          $imageArray = $product->images ? json_decode($product->images, true) : [];
                          @endphp
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
                              data-color="{{ $product->color }}"
                              data-images='@json($imageArray)'
                              data-meta-title="{{ $product->meta_title }}"
                              data-meta-keyword="{{ $product->meta_keyword }}"
                              data-meta-description="{{ $product->meta_description }}">
                              Edit Product
                            </a>
                          </li>
                          @php
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
                              data-variants='@json($sizesArray)'>
                              Edit Variants
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                    <!-- DELETE Button -->
                    <td>
                      <form action="{{ route('admin.products.destroy', $product->prod_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn p-0 border-0 bg-transparent" style="font-size: 1.8rem;">
                          <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                      </form>
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
            <div class="accordion" id="productAccordion">
              <!-- Basic Info -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingBasic">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasic" aria-expanded="true">
                    🛍️ Basic Product Info
                  </button>
                </h2>
                <div id="collapseBasic" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
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
                    </div>
                  </div>
                </div>
              </div>

              <!-- Category & Brand -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingCategory">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                    🧷 Category & Brand
                  </button>
                </h2>
                <div id="collapseCategory" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
                    <div class="row g-3">
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
                    </div>
                  </div>
                </div>
              </div>

              <!-- Attributes -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingAttributes">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAttributes">
                    👕 Product Attributes
                  </button>
                </h2>
                <div id="collapseAttributes" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
                    <div class="row g-3">
                      <!-- Age Group, Neck Type, Length Type, etc. -->
                      <!-- Add your existing inputs here -->

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
                    </div>
                  </div>
                </div>
              </div>

              <!-- Description -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingDescription">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription">
                    🧷 Description
                  </button>
                </h2>
                <div id="collapseDescription" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
                    <div class="row g-3">
                      <!-- Product Description -->
                      <div class="col-md-12">
                        <label class="form-label">Product Description</label>
                        <textarea name="prod_description" id="prod_description" class="form-control" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Images & Color -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingImages">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImages">
                    🎨 Color & Images
                  </button>
                </h2>
                <div id="collapseImages" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
                    <div class="row g-3">
                      <!-- Color -->
                      <div class="col-md-6">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" name="color" placeholder="e.g. Red, Blue">
                      </div>

                      <!-- Image Uploads -->
                      <div class="col-md-12">
                        <label class="form-label">Upload Images</label>
                        <small class="d-block text-muted mb-2">You can upload up to 4 images</small>
                        <!-- Image -->
                        <div class="d-flex gap-3 flex-wrap">

                          <!-- Image 1 -->
                          <div>
                            <div class="image-preview" id="imagePreviewBox1">
                              <div class="img-holder text-center">
                                <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                                <small>Click to select</small>
                              </div>
                            </div>
                            <input type="file" name="images[]" id="imageInput1" accept="image/*" style="display: none;">
                          </div>

                          <!-- Image 2 -->
                          <div>
                            <div class="image-preview" id="imagePreviewBox2">
                              <div class="img-holder text-center">
                                <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                                <small>Click to select</small>
                              </div>
                            </div>
                            <input type="file" name="images[]" id="imageInput2" accept="image/*" style="display: none;">
                          </div>

                          <!-- Image 3 -->
                          <div>
                            <div class="image-preview" id="imagePreviewBox3">
                              <div class="img-holder text-center">
                                <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                                <small>Click to select</small>
                              </div>
                            </div>
                            <input type="file" name="images[]" id="imageInput3" accept="image/*" style="display: none;">
                          </div>

                          <!-- Image 4 -->
                          <div>
                            <div class="image-preview" id="imagePreviewBox4">
                              <div class="img-holder text-center">
                                <i class="bi bi-image" style="font-size: 2rem;"></i><br>
                                <small>Click to select</small>
                              </div>
                            </div>
                            <input type="file" name="images[]" id="imageInput4" accept="image/*" style="display: none;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Meta Info -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingMeta">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMeta">
                    📄 SEO / Meta Info (Optional)
                  </button>
                </h2>
                <div id="collapseMeta" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                  <div class="accordion-body">
                    <div class="row g-3">
                      <!-- Add meta title, keyword, description -->
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
            <!-- Sizes -->
            <div class="mb-3">
              <label class="form-label">Available Sizes & Details</label>
              <div class="table-responsive">
                <table class="table table-bordered" id="sizeTable_{{ $product->prod_id }}">
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

                <button type="button" class="btn btn-success mt-2 addSizeRowBtn" data-product-id="{{ $product->prod_id }}">
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
  $('#addVariantBtn').on('click', function() {
    const productId = $(this).data('product-id');
    console.log("Clicked Add Variant for product:", productId); // ✅ CHECK THIS


    // Clear existing variant rows
    const tbody = $(`#variantTableBody${productId}`);
    tbody.empty();

    // Optionally: repopulate with blank default rows
    const sizes = ['S', 'M', 'L', 'XL', 'XXL'];
    sizes.forEach((size, index) => {
      const row = `
      <tr>
        <td>
          <div class="form-check d-flex align-items-center gap-2">
            <input type="checkbox" name="sizes[${index}][selected]" value="1" class="form-check-input">
            <input type="text" name="sizes[${index}][size]" class="form-control" value="${size}" style="width: 80px;">
          </div>
        </td>
        <td><input type="number" name="sizes[${index}][stock]" class="form-control" placeholder="Stock"></td>
        <td><input type="number" name="sizes[${index}][mrp]" class="form-control" placeholder="MRP"></td>
        <td><input type="number" name="sizes[${index}][selling_price]" class="form-control" placeholder="Selling Price"></td>
        <td class="text-center">
          <button type="button" class="btn btn-danger removeRowBtn">−</button>
        </td>
      </tr>`;
      tbody.append(row);
    });
  });


  // Write the jQuery to fill in modal fields when "Edit Product Variant" is clicked
  $(document).on('click', '.edit-variant-btn', function() {
    const productId = $(this).data('id');
    const variants = $(this).data('variants'); // This will be an array of objects

    console.log("Product ID:", productId);
    console.log("Variants:", variants);

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
    const color = $btn.data('color');
    const rawImages = $(this).attr('data-images'); // use attr to get the raw string
    const metaTitle = $btn.data('meta-title');
    const metaKeyword = $btn.data('meta-keyword');
    const metaDescription = $btn.data('meta-description');

    let images = [];

    images = JSON.parse(rawImages)

    console.log("Images:", images);

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
    $('#addProductModal input[name="color"]').val(color);
    $('#addProductModal input[name="meta_title"]').val(metaTitle);
    $('#addProductModal input[name="meta_keyword"]').val(metaKeyword);
    $('#addProductModal textarea[name="meta_description"]').val(metaDescription);

    // Loop through max images.length and update preview boxes
    for (let i = 0; i < images.length; i++) {
      const previewId = `imagePreviewBox${i + 1}`;
      const inputId = `imageInput${i + 1}`;
      const box = $(`#${previewId}`);

      if (images[i]) {
        // Show existing stored image in preview box
        box.html(`
          <div class="position-relative">
            <img src="/uploads/products/${images[i]}" alt="Preview" class="img-fluid rounded" style="max-height: 120px;">
            <input type="hidden" name="existing_images[]" value="${images[i]}">

            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
              data-input="${inputId}" data-preview="${previewId}" style="z-index: 10;">&times;</button>
          </div>
    `);
      } else {
        // Reset to default icon and text
        box.html(`
          <div class="img-holder text-center">
            <i class="bi bi-image" style="font-size: 2rem;"></i><br>
            <small>Click to select</small>
          </div>
        `);
      }
    }

    // Show the modal
    $('#addProductModal').modal('show');
  });
  // Edit Product Modal End


  // Define the binding function for preview image
  function bindImagePreview(previewId, inputId) {
    // Click on preview opens file selector
    $(`#${previewId}`).on('click', function() {
      $(`#${inputId}`).val('').click();
    });

    // When image selected
    $(`#${inputId}`).on('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $(`#${previewId}`).html(`
          <div class="position-relative">
            <img src="${e.target.result}" alt="Preview" class="img-fluid rounded">
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn" data-input="${inputId}" data-preview="${previewId}" style="z-index: 10;">&times;</button>
          </div>
        `);
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // Now run the script after DOM is ready
  $(document).ready(function() {

    // product variants modal
    let sizeIndex = $('#sizeTable tbody tr').length;

    $(document).on('click', '.addSizeRowBtn', function() {
      const productId = $(this).data('product-id');
      const tbody = $(`#sizeTable_${productId} tbody`);
      let sizeIndex = tbody.find('tr').length;

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

      tbody.append(newRow);

      // $('#sizeTable tbody').append(newRow);
      // sizeIndex++;
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

    // Bind preview and input for 1 to 4 image boxes
    for (let i = 1; i <= 4; i++) {
      bindImagePreview(`imagePreviewBox${i}`, `imageInput${i}`);
    }

    // preview input image end
  });
</script>


@endsection