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

    <div>
        <h1>Search results for: "{{ $search }}"</h1>

        @if($products->count())
        <div class="row">
            @forelse ($products as $product)
            @php
            $images = json_decode($product->images, true);

            $variant = $product->variants->first();

            $isWishlisted = in_array($product->variant_id, $wishlistVariantIds ?? []);
            @endphp
            <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                <div class="product-item__outer h-100 w-100">
                    <div class="product-item__inner px-xl-4 p-3">
                        <div class="product-item__body pb-xl-2">
                            <div class="mb-2">
                                <a href="#" class="font-size-12 text-gray-5">
                                    {{ $product->category->cat_name ?? 'Unknown' }}
                                </a>
                            </div>
                            <h5 class="mb-1 product-item__title">
                                <a href="{{ route('product.show', $product->prod_id) }}" class="text-blue font-weight-bold">
                                    {{ $product->product_name }}
                                </a>
                            </h5>
                            <div class="mb-2">
                                <a href="{{ route('product.show', $product->prod_id) }}" class="max-width-150 d-block text-center" style="height: 150px; overflow: hidden;">
                                    <img class="img-fluid object-fit-cover" src="{{ asset('uploads/products/' . $images[0]) }}" alt="{{ $product->product_name }}">
                                </a>
                            </div>
                            <div class="flex-center-between mb-1">
                                <div class="prodcut-price">
                                    <div class="text-gray-100"> ₹{{ number_format($variant->selling_price, 2) }}
                                    </div>
                                </div>
                                <div class="d-none d-xl-block prodcut-add-cart">
                                    <a href="javascript:void(0);"
                                        class="btn-add-cart btn-primary transition-3d-hover addToCartIndexBtn"
                                        data-variant-id="{{ $variant->variant_id }}"
                                        data-quantity="1">
                                        <i class="ec ec-add-to-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-item__footer">
                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                <a href="javascript:void(0);"
                                    class="add-to-wishlist text-gray-6 font-size-13 mr-2"
                                    data-product-id="{{ $product->prod_id }}"
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
            @empty
            <div class="alert alert-warning text-center">
                <strong>Oops!</strong> No similar products available at the moment.
            </div> @endforelse
        </div>

        {{ $products->links() }} <!-- Pagination -->
        @else
        <p>No products found</p>
        @endif
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

@endsection