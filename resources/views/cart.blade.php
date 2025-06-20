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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="container py-5">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-items">
                    <div class="row fw-bold border-bottom pb-2 mb-3">
                        <div class="col-6">PRODUCT</div>
                        <div class="col-2 text-center">PRICE</div>
                        <div class="col-2 text-center">QUANTITY</div>
                        <div class="col-2 text-center">TOTAL</div>
                    </div>

                    <!-- Cart Item -->
                    @foreach($cartItems as $item)
                    @php
                    $variant = $item->variant;
                    $product = $variant->product;
                    $color = $product->color ?? 'N/A';
                    $size = $variant->size ?? 'N/A';
                    $price = $variant->selling_price ?? 0;
                    $total = $price * $item->quantity;
                    @endphp
                    <div class="product-card d-flex align-items-center">
                        @php
                        $images = json_decode($product->images, true);
                        @endphp
                        <img src="{{ asset('uploads/products/' . $images[0]) }}" class="product-img me-3" alt="{{ $product->name }}" />

                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $product->name }}</div>
                            <div class="text-muted small">Color: {{ $color }} &nbsp;|&nbsp; Size: {{ $size }}</div>
                            <a href="{{ route('cart.remove', $item->id) }}" class="text-danger small">
                                <i class="bi bi-trash"></i> Remove
                            </a>
                        </div>

                        <div class="text-center col-2">${{ number_format($price, 2) }}</div>

                        <div class="col-2 border rounded-pill py-2 px-3 border-color-1 d-flex align-items-center justify-content-center">
                            <div class="js-quantity row align-items-center">
                                <div class="col">
                                    <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                        type="number"
                                        name="quantity[{{ $item->id }}]"
                                        value="{{ $item->quantity }}"
                                        min="1">
                                </div>
                                <div class="col-auto pr-1">
                                    <button type="button" class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                        <small class="bi bi-dash btn-icon__inner"></small>
                                    </button>
                                    <button type="button" class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                        <small class="bi bi-plus btn-icon__inner"></small>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-end col-2 price-total">${{ number_format($total, 2) }}</div>
                    </div>
                    @endforeach

                    <!-- Coupon and Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control coupon-input" placeholder="Coupon code" />
                            <button class="btn btn-primary-dark transition-3d-hover">Apply</button>
                        </div>
                        <div class="mt-3 mt-md-0 d-flex gap-2">
                            <button class="btn btn-outline-primary"><i class="bi bi-arrow-repeat"></i> Update</button>
                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Clear</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="cart-summary">
                    <h5 class="mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>$269.96</span>
                    </div>
                    <div class="mb-2">
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" checked />
                            <span class="form-check-label">Standard Delivery - $4.99</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" />
                            <span class="form-check-label">Express Delivery - $12.99</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" />
                            <span class="form-check-label">Free Shipping (Orders over $300)</span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span>$27.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount</span>
                        <span class="text-success">-$0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span>$301.95</span>
                    </div>
                    <button class="btn btn-primary-dark transition-3d-hover w-100 mt-3">Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i></button>
                    <a href="{{ route('index') }}" class="btn btn-light w-100 mt-2" style="background-color: rgba(119, 131, 143, 0.1);"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
</script>


@endsection