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
                    <form id="updateCartForm">
                        @forelse($cartItems as $item)
                        @php
                        $variant = $item->variant;
                        $product = $variant->product;
                        $color = $product->color ?? 'N/A';
                        $size = $variant->size ?? 'N/A';
                        $price = $variant->selling_price ?? 0;
                        $total = $price * $item->quantity;
                        @endphp
                        <div class="product-card cart-item d-flex align-items-center" data-id="{{ $item->cart_id }}">
                            @php
                            $images = json_decode($product->images, true);
                            @endphp
                            <img src="{{ asset('uploads/products/' . $images[0]) }}" class="product-img me-3" alt="{{ $product->name }}" />

                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <div class="text-muted small">Color: {{ $color }} &nbsp;|&nbsp; Size: {{ $size }}</div>
                                <a href="javascript:void(0);" class="remove-from-cart text-danger small" data-id="{{ $item->cart_id }}">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </div>
                            <div class="text-center col-2">₹{{ number_format($price, 2) }}</div>

                            <!-- Quantity -->
                            <div class="col-2 border rounded-pill py-2 px-3 border-color-1 d-flex align-items-center justify-content-center">
                                <div class="js-quantity row align-items-center">
                                    <div class="col">

                                        <input
                                            type="number"
                                            class="quantity-input js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                            name="quantity[{{ $item->cart_id }}]"
                                            value="{{ $item->quantity }}"
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

                            <div class="text-end col-2 price-total">₹{{ number_format($total, 2) }}</div>
                        </div>
                        @empty
                        <div class="alert alert-warning text-center">
                            <strong>Oops!</strong> No products available in the cart.
                        </div>
                        @endforelse
                    </form>

                    <!-- Coupon and Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control coupon-input" placeholder="Coupon code" />
                            <button class="btn btn-primary-dark transition-3d-hover">Apply</button>
                        </div>
                        <div class="mt-3 mt-md-0 d-flex gap-2">
                            <button class="btn btn-outline-primary" id="updateCartBtn">
                                <i class="bi bi-arrow-repeat"></i> Update
                            </button>
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
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="mb-2">
                        @if ($subtotal >= 2000)
                        {{-- Only show free shipping --}}
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="0" checked />
                            <span class="form-check-label text-success fw-bold">Free Shipping (Orders over ₹2000)</span>
                        </label>
                        @else
                        {{-- Show all shipping options --}}
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="30" checked />
                            <span class="form-check-label">Standard Delivery - ₹30</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="100" />
                            <span class="form-check-label">Express Delivery - ₹100</span>
                        </label>
                        <div class="mt-2" style="font-size: 13px; color: #6c757d;">
                            Free Shipping (Orders over ₹2000)
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax 10%</span>
                        <span>₹{{ number_format($subtotal * 0.1, 2) }}</span> {{-- Example 10% tax --}}
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount</span>
                        <span class="text-success">-₹0.00</span>
                    </div>

                    <hr>

                    @php
                    $shipping = 30; // Default, can make dynamic with JS
                    $tax = $subtotal * 0.1;
                    $total = $subtotal + $tax + $shipping;
                    @endphp

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="order-total">${{ number_format($total, 2) }}</span>
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
    $('input[name="shipping"]').on('change', function() {
        let shippingCost = parseFloat($(this).val());
        let subtotal = parseFloat("{{ $subtotal }}");
        let tax = subtotal * 0.1;
        let total = subtotal + tax + shippingCost;

        $('.order-total').text(`$${total.toFixed(2)}`);
    });

    $(document).on('click', '.remove-from-cart', function() {
        let cartId = $(this).data('id');

        if (!confirm('Are you sure you want to remove this item?')) return;

        $.ajax({
            url: "/customer/cart/remove/" + cartId,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Show success message
                showToast(response.message, "success");

                setTimeout(function() {
                    location.reload();
                }, 1200);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Failed to remove product.');
            }
        });
    });

    $('#updateCartBtn').on('click', function(e) {
        e.preventDefault();

        let data = {};
        $('.quantity-input').each(function() {
            let cartId = $(this).closest('.cart-item').data('id');
            let quantity = $(this).val();
            console.log(quantity);

            data[cartId] = quantity;
        });

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                quantities: data
            },
            success: function(response) {
                showToast(response.message, "success");

                // setTimeout(function() {
                //     location.reload();
                // }, 1200);
            },
            error: function(xhr) {
                alert('Failed to update cart.');
                console.log(xhr.responseText);
            }
        });
    });
</script>


@endsection