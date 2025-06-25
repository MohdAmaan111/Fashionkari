@extends('layout.app')

@section('content')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">

    <!-- Toast Message -->
    <div class="custom-toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="toastMessage" class="toast message-toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2">
                    <i id="toastIcon" class="bi bi-check2-circle"></i> <!-- Bootstrap icon -->
                </div>
                <div class="toast-body flex-grow-1 message-text">
                    Product Added
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="progress-bar-bottom"></div>
        </div>
    </div><!-- End Toast Message -->

    <!-- Breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../shop/shop.html">{{ $product->cat_name }}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $product->product_name }}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Single Product Body -->
    <div class="container">
        <div class="mb-xl-14 mb-6">
            <div class="row">
                @php
                $images = json_decode($product->images, true);

                $sortedVariants = $product->variants->sortBy('selling_price');
                $variantFavID = $sortedVariants->first()->variant_id;
                
                $isWishlisted = in_array($variantFavID, $wishlistVariantIds ?? []);
                @endphp
                <!-- Product image body -->
                <div class="col-md-5">
                    <!-- {{-- Main Image Slider --}} -->
                    <div id="mainSlider" class="js-slick-carousel" data-nav-for="#thumbSlider">
                        @foreach ($images as $image)
                        <div class="main-image-container">
                            <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $product->product_name }}" class="main-image">
                        </div>
                        @endforeach
                        @if (empty($images))
                        <div class="thumb-image-container">
                            <img src="" alt="Image not available" class="thumb-image">
                        </div>
                        @endif
                    </div>

                    <!-- {{-- Thumbnail Slider --}} -->
                    <div id="thumbSlider" class="js-slick-carousel mt-3"
                        data-slides-show="5"
                        data-is-thumbs="true"
                        data-focus-on-select="true"
                        data-nav-for="#mainSlider"
                        data-slick='{
                            "slidesToShow": 5,
                            "responsive": [
                                {
                                    "breakpoint": 768,
                                    "settings": {
                                        "slidesToShow": 4
                                    }
                                },
                                {
                                    "breakpoint": 576,
                                    "settings": {
                                        "slidesToShow": 3
                                    }
                                },
                                {
                                    "breakpoint": 450,
                                    "settings": {
                                        "slidesToShow": 2
                                    }
                                }
                            ]
                        }'>

                        @foreach ($images as $image)
                        <div class="thumb-image-container">
                            <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $product->product_name }}" class="thumb-image">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product detail body -->
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ $product->cat_name }}</a>
                            <h2 class="font-size-25 text-lh-1dot2">{{ $product->product_name }}</h2>
                            <div class="mb-2">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    <div class="text-warning mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                </a>
                            </div>
                            <div class="d-md-flex align-items-center">
                                <div class="ml-md-3 text-gray-9 font-size-14">
                                    Availability:
                                    <span id="availabilityText">
                                        <!-- {{-- This will be replaced by jQuery --}} -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-horizontal-center flex-wrap mb-4">
                            <a href="javascript:void(0);"
                                class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                data-product-id="{{ $product->prod_id }}"
                                data-variant-id="{{ $sortedVariants->first()->variant_id }}">
                                <i class="bi wishlist-icon mr-1 font-size-18 
                                    {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                </i>
                                <span class="wishlist-label">Wishlist</span>
                            </a>
                        </div>
                        <!-- Product Attributes -->
                        <div class="mb-2">
                            <ul class="font-size-14 pl-3 ml-1 text-gray-110">
                                <li><strong>Neck Type: </strong>{{ $product->neck_type ?? 'Not specified' }}</li>
                                <li><strong>Fit Type: </strong>{{ $product->fit_type ?? 'Not specified' }}</li>
                                <li><strong>Sleeve Type: </strong>{{ $product->sleeve_type ?? 'Not specified' }}</li>
                                <li><strong>Length Type: </strong>{{ $product->length_type ?? 'Not specified' }}</li>
                            </ul>
                        </div>
                        <p><strong>Fabric</strong>: {{ $product->fabric_name ?? 'Not specified' }}</p>
                        <!-- Product Price -->
                        <div class="mb-4">
                            @php
                            $firstVariant = $sortedVariants->first(); // lowest price variant
                            @endphp
                            <div class="d-flex align-items-baseline" id="priceBlock">
                                <ins class="font-size-36 text-decoration-none" id="sellingPrice">₹{{ number_format($firstVariant->selling_price, 2) }}</ins>
                                <del class="font-size-20 ml-2 text-gray-6" id="mrp">₹{{ number_format($firstVariant->mrp, 2) }}</del>
                            </div>
                        </div>
                        <!-- Product Color -->
                        <div class="border-top border-bottom py-3 mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <h6 class="font-size-14 mb-0 me-3" style="min-width: 60px;">Color:</h6>

                                {{-- If showing just the name --}}
                                <span class="badge bg-light text-dark px-3 py-2" style="border: 1px solid #ccc;">
                                    {{ ucfirst($product->color) }}
                                </span>

                                {{-- Optional: Show actual color swatch visually --}}
                                @php
                                $colorCode = strtolower($product->color); // assuming color like "Red", "Blue", "Black"
                                @endphp
                                <!-- <span class="ms-2" style="width: 20px; height: 20px; border-radius: 50%; background-color: {{ $colorCode }}; display: inline-block; border: 1px solid #000;"></span> -->
                            </div>
                        </div>
                        <!-- Product Size Selection -->
                        <div class="border-top border-bottom py-3 mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="font-size-14 mb-0">Select Size</h6>
                                <a href="#" class="text-danger font-weight-bold">Size Guide</a>
                            </div>

                            <div class="mt-3 d-flex flex-wrap" id="variantButtons">
                                @foreach($sortedVariants as $variant)
                                <div class="text-center" style="margin-right: 12px; margin-bottom: 12px;">
                                    <button type="button"
                                        class="btn btn-outline-secondary variant-btn py-1 px-3 {{ $variant->stock == 0 ? 'disabled' : '' }}"
                                        style="border-radius: 30px; min-width: 60px;"
                                        data-variant-id="{{ $variant->variant_id }}"
                                        data-size="{{ $variant->size }}"
                                        data-stock="{{ $variant->stock }}"
                                        data-mrp="{{ $variant->mrp }}"
                                        data-price="{{ $variant->selling_price }}">
                                        {{ $variant->size }}
                                    </button>
                                    <div class="mt-1 small" style="font-size: 12px;">
                                        @if($variant->stock == 0)
                                        <span class="text-muted">sold out</span>
                                        @elseif($variant->stock <= 3)
                                            <span class="text-danger">{{ $variant->stock }} left</span>
                                            @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <!-- Product Quantity -->
                        <!-- <form action="{{ route('cart.add') }}" method="POST"> -->
                        <form id="addToCartForm">
                            @csrf
                            <input type="hidden" name="selected_variant_id" id="selectedVariantId" value="{{ $firstVariant->variant_id }}">

                            <div class="d-md-flex align-items-end mb-3">
                                <div class="max-width-150 mb-4 mb-md-0">
                                    <h6 class="font-size-14">Quantity</h6>
                                    <!-- Quantity -->
                                    <div class="border rounded-pill py-2 px-3 border-color-1">
                                        <div class="js-quantity row align-items-center">
                                            <div class="col">
                                                <input
                                                    id="quantityInput"
                                                    class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="quantity"
                                                    value="1"
                                                    min="1">
                                            </div>
                                            <div class="col-auto pr-1">
                                                <button type="button" class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </button>
                                                <button type="button" class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Quantity -->
                                </div>
                                <div class="ml-md-3">
                                    <button type="submit" id="addToCartBtn" class="btn px-5 btn-primary-dark transition-3d-hover">
                                        <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart
                                    </button>
                                </div>
                        </form>
                    </div>
                    <!-- Error message placeholder -->
                    <div id="quantityError" class="text-danger mt-2 small" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Product Body -->

    <!-- Single Product Tab -->
    <div class="mb-8">
        <div class="position-relative position-md-static px-md-6">
            <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">

                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Description</a>
                </li>
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Reviews</a>
                </li>
            </ul>
        </div>
        <!-- Tab Content -->
        <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
            <div class="tab-content" id="Jpills-tabContent">
                <!-- Description tab -->
                <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                    {{ $product->prod_description }}

                    <ul class="nav flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1">
                            <strong>Category:</strong>
                            <a href="#" class="text-blue">{{ $product->cat_name }}</a>
                        </li>
                    </ul>
                </div> <!-- Description tab end -->

                <!-- Specification Tab -->
                <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                    <div class="mx-md-5 pt-1">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th class="px-4 px-xl-5 border-top-0">Fit Type</th>
                                        <td class="border-top-0">{{ $product->fit_type ?? 'Not specified' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Neck Type</th>
                                        <td>{{ $product->neck_type ?? 'Not specified' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Sleeve Type</th>
                                        <td>{{ $product->sleeve_type ?? 'Not specified' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Length Type</th>
                                        <td>{{ $product->length_type ?? 'Not specified' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h3 class="font-size-18 mb-4">Fabric Specifications</h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th class="px-4 px-xl-5 border-top-0">Material</th>
                                        <td class="border-top-0">{{ $product->fabric_name ?? 'Not specified' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Care instructions</th>
                                        <td>{{ $product->care_instructions ?? 'Not specified' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- Specification Tab end -->

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                    <div class="row mb-8">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h3 class="font-size-18 mb-6">Based on 3 reviews</h3>
                                <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">4.3</h2>
                                <div class="text-lh-1">overall</div>
                            </div>

                            <!-- Ratings -->
                            <ul class="list-unstyled">
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">205</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 53%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">55</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">23</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-muted">0</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">4</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Ratings -->
                        </div>
                        <div class="col-md-6">
                            <h3 class="font-size-18 mb-5">Add a review</h3>
                            <!-- Form -->
                            <form class="js-validate" novalidate="novalidate">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="rating" class="form-label mb-0">Your Review</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <a href="#" class="d-block">
                                            <div class="text-warning text-ls-n2 font-size-16">
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="descriptionTextarea" class="form-label">Your Review</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea class="form-control" rows="3" id="descriptionTextarea" data-msg="Please enter your message." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required="" data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-label="alexhecker@pixeel.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-md-4 offset-lg-3 col-auto">
                                        <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- Review -->
                    <div class="border-bottom border-color-1 pb-4 mb-4">
                        <!-- Review Rating -->
                        <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                        </div>
                        <!-- End Review Rating -->

                        <p class="text-gray-90">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>

                        <!-- Reviewer -->
                        <div class="mb-2">
                            <strong>John Doe</strong>
                            <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                        </div>
                        <!-- End Reviewer -->
                    </div>
                    <!-- End Review -->
                    <!-- Review -->
                    <div class="border-bottom border-color-1 pb-4 mb-4">
                        <!-- Review Rating -->
                        <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                            </div>
                        </div>
                        <!-- End Review Rating -->

                        <p class="text-gray-90">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus. Etiam justo ligula, placerat ac augue id, volutpat porta dui.</p>

                        <!-- Reviewer -->
                        <div class="mb-2">
                            <strong>Anna Kowalsky</strong>
                            <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                        </div>
                        <!-- End Reviewer -->
                    </div>
                    <!-- End Review -->
                    <!-- Review -->
                    <div class="pb-4">
                        <!-- Review Rating -->
                        <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                        </div>
                        <!-- End Review Rating -->

                        <p class="text-gray-90">Sed id tincidunt sapien. Pellentesque cursus accumsan tellus, nec ultricies nulla sollicitudin eget. Donec feugiat orci vestibulum porttitor sagittis.</p>

                        <!-- Reviewer -->
                        <div class="mb-2">
                            <strong>Peter Wargner</strong>
                            <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                        </div>
                        <!-- End Reviewer -->
                    </div>
                    <!-- End Review -->
                </div><!-- Reviews Tab end -->
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Single Product Tab -->

    <!-- Similar products -->
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
            <h3 class="section-title mb-0 pb-2 font-size-22">Similar products</h3>
        </div>
        <ul class="row list-unstyled products-group no-gutters">
            @forelse ($similarProducts as $similar)
            @php
            $images = json_decode($similar->images, true);
            @endphp
            <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                <div class="product-item__outer h-100">
                    <div class="product-item__inner px-xl-4 p-3">
                        <div class="product-item__body pb-xl-2">
                            <div class="mb-2">
                                <a href="#" class="font-size-12 text-gray-5">{{ $similar->cat_name ?? 'Unknown' }}</a>
                            </div>
                            <h5 class="mb-1 product-item__title">
                                <a href="{{ url('/single-product/' . $similar->prod_id) }}" class="text-blue font-weight-bold">
                                    {{ $similar->prod_name }}
                                </a>
                            </h5>
                            <div class="mb-2">
                                <a href="{{ url('/single-product/' . $similar->prod_id) }}" class="d-block text-center">
                                    <img class="img-fluid" src="{{ asset('uploads/products/' . $images[0]) }}" alt="{{ $similar->prod_name }}">
                                </a>
                            </div>
                            <div class="flex-center-between mb-1">
                                <div class="prodcut-price">
                                    <div class="text-gray-100">
                                        ₹{{ number_format($similar->selling_price, 2) }}
                                    </div>
                                </div>
                                <div class="d-none d-xl-block prodcut-add-cart">
                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover">
                                        <i class="ec ec-add-to-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-item__footer">
                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <div class="alert alert-warning text-center">
                <strong>Oops!</strong> No similar products available at the moment.
            </div> @endforelse
        </ul>
    </div>
    <!-- End Similar products -->
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
    $(document).ready(function() {
        // Size of product variants

        // Product Variants code
        function clearSelection() {
            $('.variant-btn').removeClass('btn-dark');
        }

        function updateAvailability(stock) {
            if (stock > 0) {
                $('#availabilityText').html('<span class="text-green font-weight-bold">In stock</span>');
                $('#addToCartBtn')
                    .html('<i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart')
                    .prop('disabled', false)
                    .removeClass('disabled btn-secondary')
                    .addClass('btn-primary-dark');
            } else {
                $('#availabilityText').html('<span class="text-red font-weight-bold">Out of Stock</span>');
                $('#addToCartBtn')
                    .text('Out of Stock')
                    .prop('disabled', true)
                    .addClass('disabled btn-secondary')
                    .removeClass('btn-primary-dark');
            }
        }

        $('.variant-btn').on('click', function() {
            const price = $(this).data('price');
            const mrp = $(this).data('mrp');
            const variantId = $(this).data('variant-id');
            const stock = $(this).data('stock');

            $('#sellingPrice').text('₹' + parseFloat(price).toFixed(2));
            $('#mrp').text('₹' + parseFloat(mrp).toFixed(2));
            $('#selectedVariantId').val(variantId);

            updateAvailability(stock);
            clearSelection();
            $(this).addClass('btn-dark');
        });

        // Auto-select first available size
        const $firstAvailable = $('.variant-btn').not('.disabled').first();
        if ($firstAvailable.length) {
            $firstAvailable.trigger('click');
        }

        // Plus button for quantity
        $('.js-plus').click(function() {
            let input = $(this).closest('.js-quantity').find('input[name="quantity"]');
            let currentVal = parseInt(input.val()) || 1;
            input.val(currentVal + 1);
        });

        // Minus button for quantity
        $('.js-minus').click(function() {
            let input = $(this).closest('.js-quantity').find('input[name="quantity"]');
            let currentVal = parseInt(input.val()) || 1;
            if (currentVal > 1) {
                input.val(currentVal - 1);
            }
        });
        // End Product Variants code
    });

    $('#addToCartForm').on('submit', function(e) {
        e.preventDefault();

        // Validate and sanitize quantity input
        let quantity = parseInt($('#quantityInput').val());

        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            $('#quantityInput').val(quantity); // set back to 1 visually
        }

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                selected_variant_id: $('#selectedVariantId').val(),
                quantity: $('#quantityInput').val()
            },
            success: function(response) {
                showToast(response.message, "success");

                setTimeout(function() {
                    location.reload();
                }, 1200);
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);

                // Parse the error message from JSON
                let errorMessage = "Something went wrong!";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    let errors = xhr.responseJSON.errors;

                    if (xhr.status === 401) {
                        // User not logged in (unauthorized)
                        let errorMessage = xhr.responseJSON?.message || "Please login to continue.";
                        showToast(errorMessage, "danger");
                    }
                    if (xhr.status === 404) {
                        // Product Variant not found
                        let errorMessage = xhr.responseJSON?.message;
                        showToast(errorMessage, "danger");
                    }
                    if (xhr.status === 409) {
                        // Product is already in your cart
                        let errorMessage = xhr.responseJSON?.message;
                        showToast(errorMessage, "danger");
                    }
                    if (errors.quantity) {
                        // User enters quantity more than stock
                        $('#quantityError').text(errors.quantity[0]).show();
                    }

                    // errorMessage = xhr.responseJSON.message;
                }

                //showToast(errorMessage, "danger"); // ❌ Show red toast
            }
        });
    });
</script>

@endsection