@extends('layout.app')

@section('content')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="cart-page">

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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div><!-- End Breadcrumb -->

    <div class="container">
        <div class="my-6">
            <h1 class="text-center">My wishlist on Fashionkari</h1>
        </div>
        <div class="mb-16 wishlist-table">
            <form class="mb-4" action="#" method="post">
                <div class="table-responsive">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-Stock w-lg-15">Stock Status</th>
                                <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wishlists as $item)
                            <tr
                                data-product-id="{{ $item->product_id }}"
                                data-variant-id="{{ $item->variant_id }}">
                                <!-- remove product from list -->
                                <td class="text-center">
                                    <a href="javascript:void(0);"
                                        class="text-danger font-size-20 remove-from-wishlist"
                                        data-variant-id="{{ $item->variant_id }}">
                                        ×
                                    </a>
                                </td>
                                <!-- show product image -->
                                <td class="d-none d-md-table-cell">
                                    @php
                                    $productImages = json_decode($item->product->images ?? '[]', true);
                                    @endphp
                                    <a href="{{ route('product.show', $item->product_id ?? '') }}">
                                        <img class="img-fluid max-width-100 p-1 border border-color-1"
                                            src="{{ asset('uploads/products/' . ($productImages[0] ?? 'default.png')) }}"
                                            alt="{{ $item->product->product_name }}">
                                    </a>
                                </td>
                                <!-- show product attributes -->
                                <td data-title="Product">
                                    <a href="{{ route('product.show', $item->product_id ?? '') }}" class="text-gray-90">
                                        {{ $item->product->product_name ?? 'N/A' }}
                                        <br>
                                        <small>Size: {{ $item->variant->size }}</small>
                                        <br>
                                        <small>Color: {{ $item->product->color }}</small>
                                    </a>
                                </td>
                                <!-- show product selling price -->
                                <td data-title="Unit Price">
                                    ₹{{ number_format($item->variant->selling_price, 2) }}
                                </td>
                                <!-- show product quantity -->
                                <td data-title="Stock Status">
                                    @if($item->variant->stock > 0)
                                    <span class="text-success">In stock</span>
                                    @else
                                    <span class="text-danger">Out of stock</span>
                                    @endif
                                </td>
                                <!-- show add cart button -->
                                <td>
                                    <button type="button"
                                        class="btn btn-primary-dark transition-3d-hover mb-3 mb-md-0 font-weight-normal px-5 add-to-cart-from-wishlist"
                                        data-product-id="{{ $item->product_id }}"
                                        data-variant-id="{{ $item->variant_id }}"
                                        data-quantity="1"
                                        @if($item->variant->stock == 0) disabled @endif
                                        >
                                        Add to Cart
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No items in wishlist.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
    $(document).on('click', '.remove-from-wishlist', function() {
        let variantId = $(this).data('variant-id');
        console.log(variantId);


        if (confirm("Do you really want to remove this product from your wishlist?")) {
            $.ajax({
                url: '{{ route("wishlist.remove") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    variant_id: variantId
                },
                success: function(response) {
                    showToast(response.message, "success");

                    setTimeout(function() {
                        location.reload();
                    }, 800);
                },
                error: function() {
                    showToast("Error removing item", "danger");
                    // alert('Error removing item');
                }
            });
        }
    });

    $(document).on('click', '.add-to-cart-from-wishlist', function() {
        let productId = $(this).data('product-id');
        let variantId = $(this).data('variant-id');

        // console.log(productId + " or " + variantId);

        $.ajax({
            url: '{{ route("cart.add") }}', // define this route
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                selected_variant_id: variantId,
                quantity: 1
            },
            success: function(response) {
                showToast(response.message, "success");

                setTimeout(function() {
                    location.reload();
                }, 800);
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

                    // errorMessage = xhr.responseJSON.message;
                }
            }
        });
    });
</script>


@endsection