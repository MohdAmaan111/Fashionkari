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

    @if(session('success'))
    <div id="successMessage" style="display:none; position:fixed; top:20px; right:20px; background:#28a745; color:#fff; padding:10px 20px; border-radius:5px; z-index:9999;">{{ session('success') }}</div>
    <script>
        $(document).ready(function() {
            $('#successMessage').fadeIn(200).delay(2000).fadeOut(400, function() {
                // window.location.href = "{{ route('index') }}";
            });
        });
    </script>
    @endif

    <!-- Success Message -->
    <div id="successMessage" style="display:none; position:fixed; top:20px; right:20px; background:#28a745; color:#fff; padding:10px 20px; border-radius:5px; z-index:9999;">
    </div><!-- Success Message End -->

    <!-- Slider Section -->
    <div class="mb-4">
        <div class="bg-img-hero" style="background-image: url(assets/img/1920X422/img2.jpg);">
            <div class="container overflow-hidden">
                <div class="js-slick-carousel u-slick"
                    data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-center mb-3 mb-md-4">
                    <!-- Slide 1 -->
                    <div class="js-slide">
                        <div class="row pt-7 py-md-0">
                            <div class="d-none d-wd-block offset-1"></div>
                            <div class="col-xl col col-md-6 mt-md-8 mt-lg-10">
                                <div class="ml-xl-4">
                                    <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                        data-scs-animation-in="fadeInUp">
                                        SHOP TO GET WHAT YOU LOVE
                                    </h6>
                                    <h1 class="font-size-46 text-lh-50 font-weight-light mb-8"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="200">
                                        TIMEPIECES THAT MAKE A STATEMENT UP TO <stong class="font-weight-bold">40% OFF</stong>
                                    </h1>
                                    <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        Start Buying
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-6 d-flex align-items-end ml-auto ml-md-0"
                                data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid ml-auto mr-10 mr-wd-auto" src="assets/img/416X420/img.png" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="js-slide">
                        <div class="row pt-7 py-md-0">
                            <div class="d-none d-wd-block offset-1"></div>
                            <div class="col-xl col col-md-6 mt-md-8 mt-lg-10">
                                <div class="ml-xl-4">
                                    <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                        data-scs-animation-in="fadeInUp">
                                        SHOP TO GET WHAT YOU LOVE
                                    </h6>
                                    <h1 class="font-size-46 text-lh-50 font-weight-light mb-8"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="200">
                                        TIMEPIECES THAT MAKE A STATEMENT UP TO <stong class="font-weight-bold">40% OFF</stong>
                                    </h1>
                                    <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        Start Buying
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-6 flex-horizontal-center ml-auto ml-md-0"
                                data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid ml-auto mr-10 mr-wd-auto h-100" src="assets/img/416X420/img2.png" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="js-slide">
                        <div class="row pt-7 py-md-0">
                            <div class="d-none d-wd-block offset-1"></div>
                            <div class="col-xl col col-md-6 mt-md-8 mt-lg-10">
                                <div class="ml-xl-4">
                                    <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                        data-scs-animation-in="fadeInUp">
                                        SHOP TO GET WHAT YOU LOVE
                                    </h6>
                                    <h1 class="font-size-46 text-lh-50 font-weight-light mb-8"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="200">
                                        TIMEPIECES THAT MAKE A STATEMENT UP TO <stong class="font-weight-bold">40% OFF</stong>
                                    </h1>
                                    <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        Start Buying
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-6 flex-horizontal-center ml-auto ml-md-0"
                                data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid ml-auto mr-10 mr-wd-auto h-100" src="assets/img/416X420/img3.png" alt="Image Description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->

    <!-- Banner -->
    <div class="container">
        <!-- Banner -->
        <div class="row mb-6 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                    <div class="col-6 col-xl-7 col-wd-6 pr-0">
                        <img class="img-fluid" src="{{asset('assets/img/246X176/img1.jpg')}}" alt="Image Description">
                    </div>
                    <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                            DISCOVER THE LATEST IN <strong>MEN'S FASHION</strong>
                        </div>
                        <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                            Explore Now
                            <span class="link__icon ml-1">
                                <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                    <div class="col-6 col-xl-7 col-wd-6 pr-0">
                        <img class="img-fluid" src="{{asset('assets/img/246X176/img2.jpg')}}" alt="Image Description">
                    </div>
                    <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                            STEP INTO STYLE <strong>WOMEN'S WEAR</strong>
                        </div>
                        <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                            Explore now
                            <span class="link__icon ml-1">
                                <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                    <div class="col-6 col-xl-7 col-wd-6 pr-0">
                        <img class="img-fluid" src="{{asset('assets/img/246X176/img3.jpg')}}" alt="Image Description">
                    </div>
                    <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                            COOL & COMFY <strong>STYLES</strong> FOR BOYS
                        </div>
                        <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                            Explore now
                            <span class="link__icon ml-1">
                                <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1 d-xl-none d-wd-block">
                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                    <div class="col-6 col-xl-5 col-wd-6 pr-0">
                        <img class="img-fluid" src="{{asset('assets/img/246X176/img4.jpg')}}" alt="Image Description">
                    </div>
                    <div class="col-6 col-xl-7 col-wd-6">
                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                            CUTE & COLORFUL <strong>OUTFITS</strong> FOR HER
                        </div>
                        <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                            Explore now
                            <span class="link__icon ml-1">
                                <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- End Banner -->
    </div>

    <!-- Tab Prodcut Section -->
    <div class="container">
        <!-- Tab Prodcut Section -->
        <div class="mb-6">
            <!-- Nav Classic -->
            <div class="position-relative bg-white text-center z-index-2">
                <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                    <!-- Men's Nav -->
                    <li class="nav-item">
                        <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true"
                            data-target="#pills-one-example1"
                            data-link-group="groups"
                            data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Men's
                            </div>
                        </a>
                    </li>
                    <!-- Women's Nav -->
                    <li class="nav-item">
                        <a class="nav-link js-animation-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false"
                            data-target="#pills-two-example1"
                            data-link-group="groups"
                            data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Women's
                            </div>
                        </a>
                    </li>
                    <!-- Best Seller Nav -->
                    <li class="nav-item">
                        <a class="nav-link js-animation-link" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="false"
                            data-target="#pills-three-example1"
                            data-link-group="groups"
                            data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Best Seller
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Nav Classic -->

            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Men's Product List -->
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @php
                        // Get only the latest 6 products for men
                        $latestMenProducts = $products->where('age_group', 'Men')->sortByDesc('prod_id')->take(6);
                        @endphp

                        @if($latestMenProducts->isNotEmpty())

                        @foreach($latestMenProducts as $latestMenProduct)
                        <li class="col-6 col-md-4 col-xl product-item">
                            <div class="product-item__outer h-100 w-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="#" class="font-size-12 text-gray-5">{{ $latestMenProduct->category->cat_name ?? 'No Category' }}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{ route('product.show', $latestMenProduct->prod_id) }}" class="text-blue font-weight-bold">{{ $latestMenProduct->product_name }}</a>
                                        </h5>
                                        <div class="mb-2">
                                            @php
                                            $productImages = json_decode($latestMenProduct->images ?? '[]', true);
                                            @endphp
                                            <a href="{{ route('product.show', $latestMenProduct->prod_id) }}" class="max-width-150 d-block text-center" style="height: 150px; overflow: hidden;">
                                                @if (!empty($productImages) && isset($productImages[0]))
                                                <img class="img-fluid object-fit-cover" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $latestMenProduct->product_name }}">
                                                @else
                                                <img class="img-fluid" src="{{ asset('uploads/default.png') }}" alt="No Image">
                                                @endif
                                            </a>
                                        </div>
                                        @php
                                        // Show lowest price among variants
                                        $variant = $latestMenProduct->variants->sortBy('selling_price')
                                        ->first();

                                        $isWishlisted = in_array($variant->variant_id, $wishlistVariantIds ?? []);
                                        @endphp
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                @if($variant)
                                                <div class="text-gray-100">₹{{ number_format($variant->selling_price,2) }}</div>
                                                @else
                                                <div class="text-gray-100 text-danger">Price not available</div>
                                                @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                @if($variant)
                                                <a href="javascript:void(0);"
                                                    class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                                    data-variant-id="{{ $variant->variant_id }}"
                                                    data-quantity="1">
                                                    <i class="ec ec-add-to-cart"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="javascript:void(0);"
                                                class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                                data-product-id="{{ $latestMenProduct->prod_id }}"
                                                data-variant-id="{{ $variant->variant_id }}">
                                                <i class="bi wishlist-icon mr-1 font-size-18 
                                                {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                                </i>
                                                <span class="wishlist-label">Wishlist</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        @else
                        <div class="col-12 my-4">
                            <div class="alert alert-warning text-center py-4 shadow-sm" role="alert" style="font-size: 1.2rem; font-weight: 500;">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                                Men's Products Not Available
                            </div>
                        </div>
                        @endif
                    </ul>
                </div>
                <!-- Women's Product List -->
                <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @php
                        // Get only the latest 6 products for women
                        $latestWomenProducts = $products->where('age_group', 'Women')->sortByDesc('prod_id')->take(6);
                        @endphp

                        @if($latestWomenProducts->isNotEmpty())

                        @foreach($latestWomenProducts as $latestWomenProduct)
                        <li class="col-6 col-md-4 col-xl product-item">
                            <div class="product-item__outer h-100 w-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="#" class="font-size-12 text-gray-5">{{ $latestWomenProduct->category->cat_name ?? 'No Category' }}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{ route('product.show', $latestWomenProduct->prod_id) }}" class="text-blue font-weight-bold">{{ $latestWomenProduct->product_name }}</a>
                                        </h5>
                                        <div class="mb-2">
                                            @php
                                            $productImages = json_decode($latestWomenProduct->images ?? '[]', true);
                                            @endphp
                                            <a href="{{ route('product.show', $latestWomenProduct->prod_id) }}" class="max-width-150 d-block text-center" style="height: 150px; overflow: hidden;">
                                                @if (!empty($productImages) && isset($productImages[0]))
                                                <img class="img-fluid object-fit-cover" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $latestWomenProduct->product_name }}">
                                                @else
                                                <img class="img-fluid" src="{{ asset('uploads/default.png') }}" alt="No Image">
                                                @endif
                                            </a>
                                        </div>
                                        @php
                                        // Show lowest price among variants
                                        $variant = $latestWomenProduct->variants->sortBy('selling_price')->first();

                                        $isWishlisted = in_array($variant->variant_id, $wishlistVariantIds ?? []);
                                        @endphp
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                @if($variant)
                                                <div class="text-gray-100">₹{{ number_format($variant->selling_price,2) }}</div>
                                                @else
                                                <div class="text-gray-100 text-danger">Price not available</div>
                                                @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                @if($variant)
                                                <a href="javascript:void(0);"
                                                    class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                                    data-variant-id="{{ $variant->variant_id }}"
                                                    data-quantity="1">
                                                    <i class="ec ec-add-to-cart"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="javascript:void(0);"
                                                class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                                data-product-id="{{ $latestWomenProduct->prod_id }}"
                                                data-variant-id="{{ $variant->variant_id }}">
                                                <i class="bi wishlist-icon mr-1 font-size-18 
                                                {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                                </i>
                                                <span class="wishlist-label">Wishlist</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        @else
                        <div class="col-12 my-4">
                            <div class="alert alert-warning text-center py-4 shadow-sm" role="alert" style="font-size: 1.2rem; font-weight: 500;">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                                Women's Products Not Available
                            </div>
                        </div>
                        @endif
                    </ul>
                </div>

                <!-- Best Seller Product List -->
                <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @php
                        // Get only the latest 6 products for best sellers
                        $bestSellerCategoryId = $categories->where('cat_name', 'Best Sellers')->first()?->cat_id;

                        $bestSellerProducts = $products
                        ->where('category_id', $bestSellerCategoryId)
                        ->sortByDesc('prod_id')
                        ->take(6);
                        @endphp

                        @if($bestSellerProducts->isNotEmpty())

                        @foreach($bestSellerProducts as $bestSellerProduct)
                        <li class="col-6 col-md-4 col-xl product-item">
                            <div class="product-item__outer h-100 w-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="#" class="font-size-12 text-gray-5">{{ $bestSellerProduct->category->cat_name ?? 'No Category' }}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{ route('product.show', $bestSellerProduct->prod_id) }}" class="text-blue font-weight-bold">{{ $bestSellerProduct->product_name }}</a>
                                        </h5>
                                        <div class="mb-2">
                                            @php
                                            $productImages = json_decode($bestSellerProduct->images ?? '[]', true);
                                            @endphp
                                            <a href="{{ route('product.show', $bestSellerProduct->prod_id) }}" class="max-width-150 d-block text-center" style="height: 150px; overflow: hidden;">
                                                @if (!empty($productImages) && isset($productImages[0]))
                                                <img class="img-fluid object-fit-cover" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $bestSellerProduct->product_name }}">
                                                @else
                                                <img class="img-fluid" src="{{ asset('uploads/default.png') }}" alt="No Image">
                                                @endif
                                            </a>
                                        </div>
                                        @php
                                        // Show lowest price among variants
                                        $variant = $bestSellerProduct->variants->sortBy('selling_price')->first();

                                        $isWishlisted = in_array($variant->variant_id, $wishlistVariantIds ?? []);
                                        @endphp
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                @if($variant)
                                                <div class="text-gray-100">₹{{ number_format($variant->selling_price,2) }}</div>
                                                @else
                                                <div class="text-gray-100 text-danger">Price not available</div>
                                                @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                @if($variant)
                                                <a href="javascript:void(0);"
                                                    class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                                    data-variant-id="{{ $variant->variant_id }}"
                                                    data-quantity="1">
                                                    <i class="ec ec-add-to-cart"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="javascript:void(0);"
                                                class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                                data-product-id="{{ $bestSellerProduct->prod_id }}"
                                                data-variant-id="{{ $variant->variant_id }}">
                                                <i class="bi wishlist-icon mr-1 font-size-18 
                                                {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                                </i>
                                                <span class="wishlist-label">Wishlist</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        @else
                        <div class="col-12 my-4">
                            <div class="alert alert-warning text-center py-4 shadow-sm" role="alert" style="font-size: 1.2rem; font-weight: 500;">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                                Best Seller Products Not Available
                            </div>
                        </div>
                        @endif

                    </ul>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Tab Prodcut Section -->
    </div>

    <!-- Feature List -->
    <div class="container">
        <!-- Feature List -->
        <div class="mb-6 row border rounded-lg mx-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-transport font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Free Delivery</span>
                    <div class=" text-secondary">from $50</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-customers font-size-56"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">99 % Customer</span>
                    <div class=" text-secondary">Feedbacks</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-returning font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">365 Days</span>
                    <div class=" text-secondary">for free return</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-payment font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Payment</span>
                    <div class=" text-secondary">Secure System</div>
                </div>
            </div>
            <!-- End Feature List -->

            <!-- Feature List -->
            <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                <div class="u-avatar mr-2">
                    <i class="text-primary ec ec-tag font-size-46"></i>
                </div>
                <div class="media-body text-center">
                    <span class="d-block font-weight-bold text-dark">Only Best</span>
                    <div class=" text-secondary">Brands</div>
                </div>
            </div>
            <!-- End Feature List -->
        </div>
        <!-- End Feature List -->
    </div>

    <!-- Latest Products -->
    <div class="container">

        <!-- Latest Products List -->
        <div class="mb-6 position-relative">
            <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Latest Products</h3>
            </dv>
            <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
                data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                data-arrow-left-classes="fa fa-angle-left right-1"
                data-arrow-right-classes="fa fa-angle-right right-0"
                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                @php
                $latestProducts = $products->sortByDesc('prod_id')->take(18)->values();
                @endphp
                @foreach ($latestProducts->chunk(6) as $chunk)
                <div class="js-slide">
                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                        @foreach ($chunk as $product)
                        <li class="col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                            <div class="product-item__outer h-100 w-100">
                                <div class="product-item__inner p-md-3 row no-gutters">
                                    <div class="col col-lg-auto col-xl-5 col-wd-auto product-media-left">
                                        @php
                                        $productImages = json_decode($product->images ?? '[]', true);
                                        @endphp
                                        <a href="{{ route('product.show', $product->prod_id) }}" class="max-width-150 d-block" style="height: 150px; overflow: hidden;">
                                            @if (!empty($productImages) && isset($productImages[0]))
                                            <img class="img-fluid object-fit-cover" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $product->product_name }}">
                                            @else
                                            <img class="img-fluid object-fit-cover" src="{{ asset('uploads/default.png') }}" alt="No Image">
                                            @endif
                                        </a>

                                    </div>
                                    <div class="col col-xl-7 col-wd product-item__body pl-2 pl-lg-3 pl-xl-0 pl-wd-3 mr-wd-1">
                                        <div class="mb-4 mb-xl-2 mb-wd-6">
                                            <div class="mb-2">
                                                <a href="#" class="font-size-12 text-gray-5">{{ $product->category->cat_name ?? 'Uncategorized' }}</a>
                                            </div>
                                            <h5 class="product-item__title">
                                                <a href="{{ route('product.show', $product->prod_id) }}" class="text-blue font-weight-bold">{{ $product->product_name }}</a>
                                            </h5>
                                        </div>
                                        <div class="flex-center-between mb-3">
                                            @php
                                            $firstVariant = $product->variants->first();

                                            $isWishlisted = in_array($firstVariant->variant_id, $wishlistVariantIds ?? []);
                                            @endphp
                                            <div class="prodcut-price">
                                                @if ($firstVariant && $firstVariant->selling_price < $firstVariant->mrp)
                                                    <div class="prodcut-price d-flex align-items-center position-relative">
                                                        <ins class="font-size-20 text-red text-decoration-none">
                                                            ₹{{ number_format($firstVariant->selling_price, 2) }}
                                                        </ins>
                                                        <del class="font-size-12 tex-gray-6 position-absolute bottom-100">
                                                            ₹{{ number_format($firstVariant->mrp, 2) }}
                                                        </del>
                                                    </div>
                                                    @elseif ($firstVariant)
                                                    <div class="text-gray-100">
                                                        ₹{{ number_format($firstVariant->mrp, 2) }}
                                                    </div>
                                                    @else
                                                    <div class="text-muted">No Price Available</div>
                                                    @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                @if($firstVariant)
                                                <a href="javascript:void(0);"
                                                    class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                                    data-variant-id="{{ $firstVariant->variant_id }}"
                                                    data-quantity="1">
                                                    <i class="ec ec-add-to-cart"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="#" class="text-gray-6 font-size-13">
                                                    <a href="javascript:void(0);"
                                                        class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                                        data-product-id="{{ $product->prod_id }}"
                                                        data-variant-id="{{ $firstVariant->variant_id }}">
                                                        <i class="bi wishlist-icon mr-1 font-size-18 
                                                        {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                                        </i>
                                                        <span class="wishlist-label">Wishlist</span>
                                                    </a>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div><!-- End Latest Products List -->

    </div>

    <!-- Recommendation Products -->
    <div class="container">
        <!-- Recommendation for you -->
        <div class="position-relative">
            <div class="border-bottom border-color-1 mb-2">
                <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">Recommendation for you</h3>
            </div>
            <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                data-slides-show="7"
                data-slides-scroll="1"
                data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                data-arrow-left-classes="fa fa-angle-left right-1"
                data-arrow-right-classes="fa fa-angle-right right-0"
                data-responsive='[{
                    "breakpoint": 1400,
                    "settings": {
                        "slidesToShow": 6
                    }
                    }, {
                        "breakpoint": 1200,
                        "settings": {
                        "slidesToShow": 3
                        }
                    }, {
                    "breakpoint": 992,
                    "settings": {
                        "slidesToShow": 3
                    }
                    }, {
                    "breakpoint": 768,
                    "settings": {
                        "slidesToShow": 2
                    }
                    }, {
                    "breakpoint": 554,
                    "settings": {
                        "slidesToShow": 2
                    }
                    }]'>
                @php
                // Get only the random 12 products
                $recommendedProducts = $products->shuffle()->take(12);
                @endphp

                @if($recommendedProducts->isNotEmpty())

                @foreach($recommendedProducts as $recommendedProduct)
                <div class="js-slide products-group">
                    <div class="product-item">
                        <div class="product-item__outer h-100 w-100">
                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="" class="font-size-12 text-gray-5">{{ $recommendedProduct->category->cat_name ?? 'No Category' }}</a></div>
                                    <h5 class="mb-1 product-item__title">
                                        <a href="{{ route('product.show', $recommendedProduct->prod_id) }}" class="text-blue font-weight-bold">{{ $recommendedProduct->product_name }}</a>
                                    </h5>
                                    <div class="col col-lg-auto col-xl-5 col-wd-auto product-media-left mb-2">
                                        @php
                                        $productImages = json_decode($recommendedProduct->images ?? '[]', true);
                                        @endphp

                                        <a href="{{ route('product.show', $recommendedProduct->prod_id) }}" class="max-width-150 d-block text-center" style="height: 150px; overflow: hidden;">
                                            @if (!empty($productImages) && isset($productImages[0]))
                                            <img class="img-fluid" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $latestMenProduct->product_name }}">
                                            @else
                                            <img class="img-fluid" src="{{ asset('uploads/default.png') }}" alt="No Image">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        @php
                                        // Show lowest price among variants
                                        $variant = $recommendedProduct->variants->sortBy('selling_price')->first();

                                        $isWishlisted = in_array($variant->variant_id, $wishlistVariantIds ?? []);
                                        @endphp
                                        <div class="prodcut-price">
                                            @if($variant)
                                            <div class="text-gray-100">₹{{ number_format($variant->selling_price,2) }}</div> @else
                                            <div class="text-gray-100 text-danger">Price not available</div>
                                            @endif
                                        </div>
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            @if($variant)
                                            <a href="javascript:void(0);"
                                                class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                                data-variant-id="{{ $variant->variant_id }}"
                                                data-quantity="1">
                                                <i class="ec ec-add-to-cart"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item__footer">
                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                        <a href="javascript:void(0);"
                                            class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                            data-product-id="{{ $recommendedProduct->prod_id }}"
                                            data-variant-id="{{ $variant->variant_id }}">
                                            <i class="bi wishlist-icon mr-1 font-size-18 
                                                        {{ $isWishlisted ? 'bi-heart-fill active' : 'bi-heart' }}">
                                            </i>
                                            <span class="wishlist-label">Wishlist</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12 my-4">
                    <div class="alert alert-warning text-center py-4 shadow-sm" role="alert" style="font-size: 1.2rem; font-weight: 500;">
                        <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                        Products Not Available
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- End Recommendation for you -->
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

@endsection