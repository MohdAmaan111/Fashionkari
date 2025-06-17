<h4 class="mb-4 fw-bold">My Wishlist</h4>
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-outline-dark">Add All to Cart</button>
</div>

<!-- <div class="row">
    @foreach ($wishlist as $item)
    <div class="col-md-4 mb-4">
        <div class="border rounded p-3 text-center shadow-sm">
            <img src="{{ $item->product->image }}" class="img-fluid mb-2" alt="Product">

            @if ($item->product->discount)
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $item->product->discount }}%</span>
            @endif

            <div class="fw-semibold mt-2">{{ $item->product->title }}</div>

            <div class="text-warning small my-1">
                ★★★★☆ ({{ $item->product->rating }})
            </div>

            <div class="fw-bold">
                ${{ $item->product->price }}
                @if ($item->product->original_price)
                <del class="text-muted ms-2">${{ $item->product->original_price }}</del>
                @endif
            </div>

            @if ($item->product->stock > 0)
            <button class="btn btn-primary w-100 mt-2">Add to Cart</button>
            @else
            <button class="btn btn-light w-100 mt-2" disabled>Notify When Available</button>
            @endif
        </div>
    </div>
    @endforeach
</div> -->

<h1>My Wishlist</h1>