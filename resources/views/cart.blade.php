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
                        <li id="checkoutBreadcrumb" class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page" style="display: none;">Checkout</li>
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
                <div class="cart-items cart-products">
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
                                <a href="javascript:void(0);"
                                    class="remove-from-cart text-danger small"
                                    data-id="{{ $item->cart_id }}">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </div>
                            <div class="price-per-unit text-center col-2" data-price="{{ $price }}">
                                ₹{{ number_format($price, 2) }}
                            </div>

                            <!-- Quantity -->
                            <div class="col-2 position-relative border rounded-pill py-2 px-3 border-color-1 d-flex align-items-center justify-content-center">
                                <div class="js-quantity row align-items-center">
                                    <div class="col">
                                        <input
                                            class="quantity-input js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                            name="quantity[{{ $item->cart_id }}]"
                                            value="{{ $item->quantity }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
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
                                <!-- Error message placeholder -->
                                <div id="quantityError-{{ $item->cart_id }}"
                                    class="quantity-error bg-light border border-danger text-danger small rounded px-2 py-1 shadow-sm"
                                    style="display: none; position: absolute; top: 100%; left: 0; width: max-content; min-width: 100%; margin-top: 4px; z-index: 10;">
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
                            <button class="btn btn-outline-danger" id="clearCartBtn">
                                <i class="bi bi-trash"></i> Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" id="checkoutContent" style="display: none;">
                @include('checkout.form')
            </div>

            <div class="col-lg-12" id="successOrder" style="display: none;">
                @include('checkout.success')
            </div>

            <div id="paymentFailedBox" class="text-center mt-3" style="display: none;">
                <div class="p-4 text-center bg-white rounded shadow-sm">
                    <div class="text-danger fw-bold fs-5 mb-2">Payment Failed</div>
                    <p class="text-secondary mb-2">Your payment was unsuccessful.</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0" id="cartSummary">
                <div class="cart-summary">
                    <h5 class="mb-3">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="sub-total"></span>
                    </div>
                    <div class="mb-2">
                        @if ($subtotal >= $freeShipping )
                        {{-- Only show free shipping --}}
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="0" data-method="Free Shipping" checked />
                            <span class="form-check-label text-success fw-bold">
                                Free Shipping (Orders over ₹{{ $freeShipping }})
                            </span>
                        </label>
                        @else
                        {{-- Show all shipping options --}}
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="{{ $standardCharge }}" data-method="Standard Delivery" checked />
                            <span class="form-check-label">Standard Delivery - ₹{{ $standardCharge }}</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="shipping" class="form-check-input" value="{{ $expressCharge }}" data-method="Express Delivery" />
                            <span class="form-check-label">Express Delivery - ₹{{ $expressCharge }}</span>
                        </label>
                        <div class="mt-2" style="font-size: 13px; color: #6c757d;">
                            Free Shipping (Orders over ₹{{ $freeShipping }})
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax ({{ $taxPercent }}%)</span>
                        <span class="order-tax"></span>
                        <input type="hidden" id="taxPercent" value="{{ $taxPercent }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount</span>
                        <span class="text-success">-₹0.00</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="order-total"></span>
                    </div>
                    <!-- Checkout Button -->
                    <button id="checkoutBtn" class="btn btn-primary-dark transition-3d-hover w-100 mt-3">Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i></button>
                    <!-- Place Order Button -->
                    <button class="btn btn-primary-dark transition-3d-hover w-100 mt-3" id="placeOrderBtn" style="display: none;">
                        Place Order <i class="bi bi-bag-check ms-1"></i>
                    </button>
                    <!-- Back To Cart Button -->
                    <button class="btn btn-light w-100 mt-2" id="backToCartBtn" style="display: none; background-color: rgba(119, 131, 143, 0.1);">
                        <i class="bi bi-arrow-left"></i> Back To Cart
                    </button>
                    <!-- Back To Shopping Page -->
                    <a href="{{ route('index') }}" id="backToShop" class="btn btn-light w-100 mt-2" style="background-color: rgba(119, 131, 143, 0.1);"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
    $(document).ready(function() {
        calculateTotals();

        // Plus button
        $('.js-plus').on('click', function() {
            let $input = $(this).closest('.js-quantity').find('.quantity-input');
            let currentVal = parseInt($input.val()) || 1;
            $input.val(currentVal + 1);
        });

        // Minus button
        $('.js-minus').on('click', function() {
            let $input = $(this).closest('.js-quantity').find('.quantity-input');
            let currentVal = parseInt($input.val()) || 1;
            if (currentVal > 1) {
                $input.val(currentVal - 1);
            }
        });
    });

    // To calculate order summary table
    function calculateTotals() {
        let subtotal = 0;

        $('.product-card').each(function() {
            let price = parseFloat($(this).find('.price-per-unit').data('price'));
            let qty = parseInt($(this).find('.quantity-input').val()) || 1;

            let itemTotal = price * qty;
            subtotal += itemTotal;

            $(this).find('.price-total').text(`₹${itemTotal.toFixed(2)}`);
        });

        $('#sub-total').text(`₹${subtotal.toFixed(2)}`); // ✅ Update subtotal display

        let shipping = parseFloat($('input[name="shipping"]:checked').val()) || 0;
        let taxPercent = parseFloat($('#taxPercent').val()) || 0;
        let tax = subtotal * (taxPercent / 100);

        let total = subtotal + tax + shipping;

        $('.order-subtotal').text(`₹${subtotal.toFixed(2)}`);
        $('.order-tax').text(`₹${tax.toFixed(2)}`);
        $('.order-total').text(`₹${total.toFixed(2)}`);
    }

    // On shipping change
    $('input[name="shipping"]').on('change', function() {
        calculateTotals();
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
                }, 800);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Failed to remove product.');
            }
        });
    });

    $('#updateCartBtn').on('click', function(e) {
        e.preventDefault();
        $('.quantity-error').hide(); // clear all previous errors

        let data = {};
        $('.quantity-input').each(function() {
            let cartId = $(this).closest('.cart-item').data('id');
            let quantity = $(this).val();
            // console.log(quantity);

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

                setTimeout(function() {
                    location.reload();
                }, 800);
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    const errorMessage = xhr.responseJSON?.message || "Unauthorized access.";
                    showToast(errorMessage, 'danger');
                }
                if (xhr.status === 422) {
                    const errorMessage = xhr.responseJSON?.message || "Cart is empty.";
                    showToast(errorMessage, 'danger');
                }
                if (xhr.status === 409) {
                    const errors = xhr.responseJSON.messages;

                    // Show error messages only for cart items that have errors
                    for (let cartId in errors) {
                        $('#quantityError-' + cartId).text(errors[cartId]).show();
                    }
                }
                // alert('Failed to update cart.');
                console.log(xhr.responseText);
            }
        });
    });

    $('#clearCartBtn').on('click', function(e) {
        e.preventDefault();

        if (!confirm('Are you sure you want to clear your cart?')) return;

        $.ajax({
            url: "{{ route('cart.clear') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    setTimeout(() => location.reload(), 800);
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    const errorMessage = xhr.responseJSON?.message || "Unauthorized access.";
                    showToast(errorMessage, 'danger');
                }
                if (xhr.status === 422) {
                    const errorMessage = xhr.responseJSON?.message || "Cart is empty.";
                    showToast(errorMessage, 'danger');
                }
                console.log(xhr.responseText);
            }
        });
    });

    // Checkout logics
    $(document).ready(function() {
        // Checkout Button working
        $('#checkoutBtn').click(function(e) {
            e.preventDefault();

            // Check cart items is added or not
            const cartCount = parseInt($('#cartItemCountBadge').text());
            if (isNaN(cartCount) || cartCount === 0) {
                showToast('Your cart is empty. Please add items before checkout.', 'danger');
                return;
            }

            // Show checkout Breadcrumb
            $('#checkoutBreadcrumb').show();

            // Hide cart section
            $('.cart-products').hide();

            // Show checkout form
            $('#checkoutContent').fadeIn();

            // Hide "Proceed to Checkout" button
            $(this).hide();
            // Hide "Continue Shopping" button
            $('#backToShop').hide();

            // Show "Place Order" button instead
            $('#placeOrderBtn').show();
            // Show "Back To Cart" button instead
            $('#backToCartBtn').show();

            // Set selected shipping method value in hidden input
            const shippingMethod = $('input[name="shipping"]:checked').val();
            $('#shippingMethodInput').val(shippingMethod);
        });
        // Back To Cart Button working
        $('#backToCartBtn').click(function(e) {
            e.preventDefault();

            // Hide checkout Breadcrumb
            $('#checkoutBreadcrumb').hide();

            // Show cart section
            $('.cart-products').fadeIn();

            // Hide checkout form
            $('#checkoutContent').hide();

            // Show "Proceed to Checkout" button
            $('#checkoutBtn').show();
            // Show "Continue Shopping" button
            $('#backToShop').show();

            // Hide "Place Order" button instead
            $('#placeOrderBtn').hide();
            // Hide "Back To Cart" button instead
            $(this).hide();
        });
        $('input[name="payment_method"]').on('change', function() {
            $('.payment-option').removeClass('active');
            $(this).closest('.payment-option').addClass('active');

        });
        // Submit the checkout form when "Place Order" is clicked
        $('#placeOrderBtn').click(function(e) {
            e.preventDefault();

            // Use serializeArray to get an array of name-value pairs
            const formData = $('#checkoutForm').serializeArray();

            // Add shipping method manually (since it's outside the form)
            const selectedShipping = $('input[name="shipping"]:checked');
            formData.push({
                name: 'shipping_method',
                value: selectedShipping.data('method')
            });

            // Get total amount text, strip ₹ symbol if needed
            let totalText = $('.order-total').text().trim();
            let totalAmount = totalText.replace(/[^\d.]/g, ''); // remove ₹ and keep only numbers
            totalAmount = parseInt(totalAmount); // Remove decimal

            formData.push({
                name: 'total_amount',
                value: totalAmount
            });

            let paymentMethod = $('input[name="payment_method"]:checked').val();

            console.log('Form Data (serializeArray):', formData);

            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            // Submit form via AJAX
            $.ajax({
                url: '{{ route("cart.checkout") }}', // Create this route
                type: 'POST',
                data: $.param(formData), // this includes total_amount & shipping_method
                success: function(response) {
                    console.log(response);
                    showToast(response.message, 'success');

                    if (paymentMethod === 'COD') {
                        setTimeout(function() {
                            showOrderSuccess(response);
                        }, 800);
                    } else {
                        // alert("Payment method online");

                        setTimeout(function() {
                            showOrderSuccess(response);
                            payWithRazorpay(response.razorpay_order_id, response.amount, response.order_number);
                        }, 800);
                    }

                    function showOrderSuccess(response) {
                        // Inject data
                        $('#orderNumber').text('#' + response.order_number);
                        $('#customerEmail').text(response.form_data.email);
                        $('#customerName').text(response.form_data.full_name);
                        $('#customerPhone').text(response.form_data.phone);
                        const fullAddress = `${response.form_data.address_line} ${response.form_data.area ?? ''}, ${response.form_data.city}, ${response.form_data.state}, ${response.form_data.pincode}`;
                        $('#shippingAddress').text(fullAddress);
                        $('#deliveryOption').text(response.form_data.shipping_method);
                        $('#paymentOption').text(response.form_data.payment_method);

                        // Show order content
                        $('#successOrder').fadeIn();
                        // Hide form, cart summary
                        $('#checkoutContent').hide();
                        $('#cartSummary').hide();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        const errorMessage = xhr.responseJSON?.errors || 'Your cart is empty.';
                        showToast(errorMessage, 'danger');
                    }
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;

                        let firstErrorShown = false;
                        for (let field in errors) {
                            if (!firstErrorShown) {
                                showToast(errors[field][0], 'danger');
                                firstErrorShown = true;
                            }

                            const message = errors[field][0];

                            if (field === 'payment_method') {
                                // Only show one error below the whole group
                                const wrapper = $('#payment-method-wrapper');

                                // Avoid duplicates
                                if (!wrapper.find('.invalid-feedback').length) {
                                    const errorDiv = $('<div class="invalid-feedback d-block mt-1 text-danger">' + message + '</div>');
                                    wrapper.append(errorDiv);
                                }

                            } else {
                                const input = $('[name="' + field + '"]');
                                if (input.length) {
                                    input.addClass('is-invalid');
                                    const errorDiv = $('<div class="invalid-feedback">' + message + '</div>');
                                    input.parent().append(errorDiv);
                                }
                            }
                        }
                    } else {
                        alert("Failed to place order. Please check your input.");
                    }
                }
            });
        });

        function payWithRazorpay(rzpOrderId, amount, orderId) {
            let options = {
                "key": "{{ config('services.razorpay.key') }}",
                "amount": amount,
                "currency": "INR",
                "name": "Your Store",
                "description": "Payment for order #" + orderId,
                "order_id": rzpOrderId,
                "handler": function(response) {
                    // After payment is successful
                    console.log("✅ Razorpay Payment Success:", response);
                    console.log("📦 Laravel Order ID:", orderId);

                    $.ajax({
                        url: '{{ route("razorpay.success") }}', // Create this route
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            razorpay_payment_id: response.razorpay_payment_id,
                            order_id: orderId
                        },
                        success: function() {
                            // Redirect to success page
                            showToast("Thank you! Your payment has been received.", 'success');
                        }
                    });
                },
                "modal": {
                    "ondismiss": function() {
                        showToast("Payment was cancelled by you.", 'warning');

                        $('#paymentFailedBox').fadeIn();
                    }
                }
            };

            let rzp = new Razorpay(options);

            rzp.on('payment.failed', function(response) {
                console.error("❌ Razorpay Payment Failed:", response.error);

                showToast("Payment failed: " + response.error.description, 'danger');
            });

            rzp.open();
        }
    });
    // End Checkout logics

    // Checkout form for continue to next step 
    function nextStep(step) {
        const currentStepDiv = document.querySelector('.checkout-step:not(.d-none)');
        const inputs = currentStepDiv.querySelectorAll('input, select, textarea');
        let isValid = true;

        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const error = input.nextElementSibling;
            if (error && error.classList.contains('invalid-feedback')) {
                error.remove();
            }

            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');

                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.innerText = 'This field is required.';
                input.parentNode.appendChild(errorDiv);
            }
        });

        if (isValid) {
            document.querySelectorAll('.checkout-step').forEach(div => div.classList.add('d-none'));
            document.getElementById('step' + step).classList.remove('d-none');
        }
    }
    // Checkout form for go back to previous step 
    function prevStep(step) {
        document.querySelectorAll('.checkout-step').forEach(div => div.classList.add('d-none'));
        document.getElementById('step' + step).classList.remove('d-none');
    }
</script>


@endsection