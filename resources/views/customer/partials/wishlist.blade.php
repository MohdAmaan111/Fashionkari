<h4 class="mb-4 fw-bold">My Wishlist</h4>
<div class="d-flex justify-content-end mb-3">
    <!-- <a href="{{ route('wishlist') }}">
        <button class="btn btn-outline-dark">Add All to Cart</button>
    </a> -->
</div>

<div class="row align-items-stretch">
    @foreach ($wishlists as $item)
    <div class="col-md-4 mb-4">
        <div class="profile-wishlist border rounded p-3 text-center shadow-sm h-100 d-flex flex-column justify-content-between" >
            <!-- show product image -->
            <div class="wishlist-image">
                @php
                $image = json_decode($item->product->images ?? '[]', true);
                @endphp
                <img src="{{ asset('uploads/products/' . ($image[0] ?? 'default.png')) }}" class="img-fluid mb-2" alt="Product">
            </div>

            <!-- show product discount -->
            <div class="sale-badge">
                @if ($item->variant->mrp > $item->variant->selling_price)
                @php
                $discount = (($item->variant->mrp - $item->variant->selling_price) / $item->variant->mrp) * 100;
                $discount = round($discount); // optional: round to nearest whole number
                @endphp
                <span class="discount m-2">
                    -{{ $discount }}%
                </span>
                @endif
            </div>

            <div class="fw-semibold mt-2">{{ $item->product->product_name }}</div>

            <!-- show product rating -->
            <div class="rating">
                <i class="bi bi-star-fill" style="color: #f59e0b;font-size: 14px;"></i>
                <i class="bi bi-star-fill" style="color: #f59e0b;font-size: 14px;"></i>
                <i class="bi bi-star-fill" style="color: #f59e0b;font-size: 14px;"></i>
                <i class="bi bi-star-fill" style="color: #f59e0b;font-size: 14px;"></i>
                <i class="bi bi-star" style="color: #f59e0b;font-size: 14px;"></i>
                <span>(4.0)</span>
            </div>

            <!-- show product price -->
            <div class="fw-bold">
                ₹{{ $item->variant->selling_price }}
                @if ($item->variant->mrp)
                <del class="text-muted ms-2">₹{{ $item->variant->mrp }}</del>
                @endif
            </div>

            @if ($item->variant->stock > 0)
            <button type="button"
                class="btn btn-primary-dark transition-3d-hover mb-3 mb-md-0 font-weight-normal px-5 add-to-cart-from-wishlist w-100 mt-2"
                data-product-id="{{ $item->product_id }}"
                data-variant-id="{{ $item->variant_id }}"
                data-quantity="1"
                @if($item->variant->stock == 0) disabled @endif
                >
                Add to Cart
            </button>
            @else
            <button class="btn btn-dark w-100 mt-2" disabled>Notify When Available</button>
            @endif
        </div>
    </div>
    @endforeach
</div>