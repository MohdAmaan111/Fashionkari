<!-- Main Content -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">My Orders</h5>
    <!-- <div class="my-orders d-flex gap-2 align-items-center">
        <div class="search-bar d-flex align-items-center mr-2">
            <input type="text" placeholder="Search orders...">
        </div>
        <button class="search-bar btn btn-outline-secondary ml-2"><i class="bi bi-funnel"></i> Filter</button>
    </div> -->
</div>

<!-- Order Card -->
@forelse ($orders as $order)
<div class="order-card mb-4">
    <div class="d-flex justify-content-between mb-2">
        <span class="text-secondary">Order ID: <strong class="text-warning">#{{ $order->order_number }}</strong></span>
        <span class="text-secondary">{{ $order->created_at->format('M d, Y') }}</span>
    </div>

    <div class="order-content">
        <!-- Show image of items ordered -->
        <div class="d-flex gap-3 mb-3">
            @foreach ($order->items->take(3) as $item)

            @php
            $product = $item->product;

            $productImages = json_decode($product->images ?? '[]', true);
            @endphp

            @if (!empty($productImages))
            <img src="{{ asset('uploads/products/' . $productImages[0]) }}" width="60">
            @endif
            @endforeach
        </div>

        <div class="order-info row align-items-center mb-3">
            <div class="col-md-12 d-flex justify-content-between">
                <div class="mb-2">Status</div>
                <div class="mb-2">
                    @php
                    switch ($order->order_status) {
                    case 'pending':
                    $statusColor = ['#f4c430', '#fff9e6']; // text, background
                    break;
                    case 'processing':
                    $statusColor = ['#fe700d', '#fff0de'];
                    break;
                    case 'shipped':
                    $statusColor = ['#0d6efd', '#e7f1ff'];
                    break;
                    case 'delivered':
                    $statusColor = ['#198754', '#e6f4ea'];
                    break;
                    case 'canceled':
                    $statusColor = ['#dc3545', '#fdecea'];
                    break;
                    default:
                    $statusColor = ['#6c757d', '#f8f9fa']; // fallback
                    }
                    @endphp
                    <span class="badge order-status-pill" style="color: {{ $statusColor[0] }}; background-color: {{ $statusColor[1] }}; font-weight:500; font-size: 14px;">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <div class="mb-2">Items</div>
                <div class="mb-2" style="font-weight: 500;">
                    {{ $order->items->sum('quantity') }} items
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <div class="mb-1">Total</div>
                <div style="font-weight: 600; color: #1c2b36;">
                    ₹{{ number_format($order->total_amount, 2) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="javascript:void(0);" class="order-tracking btn order-btn-hover w-100 py-2 fw-semibold">
                Track Order
            </a>
        </div>
        <div class="col-md-6">
            <a href="javascript:void(0);" class="view-details btn btn-primary-dark w-100 py-2 fw-semibold">
                View Details
            </a>
        </div>
    </div>


    <!-- Hidden tracking details section -->
    <div class="tracking-details mt-3" style="display: none;">
        <div class="p-3 rounded bg-light tracking-timeline">

            @php
            $statusSteps = [
            'pending' => [
            'label' => 'Order Placed',
            'icon' => 'bi-hourglass-split',
            'message' => 'We are waiting to confirm your order',
            ],
            'confirmed' => [
            'label' => 'Order Confirmed',
            'icon' => 'bi-check-circle', // default icon if not completed
            'message' => 'Your order has been received and confirmed',
            ],
            'processing' => [
            'label' => 'Processing',
            'icon' => 'bi-box-seam-fill',
            'message' => 'Preparing for shipment',
            ],
            'shipped' => [
            'label' => 'Shipping',
            'icon' => 'bi-truck',
            'message' => 'Your items have been packaged for shipping',
            ],
            'delivered' => [
            'label' => 'Delivery',
            'icon' => 'bi-house',
            'message' => 'Delivered to your doorstep',
            ],
            ];

            $status = $order->order_status;
            $currentIndex = array_search($status, array_keys($statusSteps));
            @endphp

            @foreach ($statusSteps as $key => $step)
            @php
            $stepIndex = array_search($key, array_keys($statusSteps));
            $isLastStep = $stepIndex === count($statusSteps) - 1;

            $isCompleted = $stepIndex <= $currentIndex || ($stepIndex===$currentIndex && $isLastStep);

                if ($isCompleted) {
                // Completed step
                $color='text-success' ;
                $icon='bi-check-circle-fill' ;
                } elseif ($stepIndex==$currentIndex + 1) {
                // Show the next step (upcoming)
                $color='text-warning' ;
                $icon=$step['icon'];
                } else {
                $color='text-muted' ;
                $icon=$step['icon'];
                }
                @endphp

                <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 {{ $color }} timeline-icon">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div>
                    <div class="fw-semibold {{ $color }}">{{ $step['label'] }}</div>
                    <small class="text-muted">{{ $step['message'] }}</small>
                </div>
        </div>
        @endforeach
        <!-- Add more steps here as needed -->
    </div>
</div>

<!-- Hidden order details section -->
<div class="order-details p-4 mt-3 rounded shadow-sm" style="display: none;">
    <h5 class="mb-3 fw-semibold border-bottom pb-2">Order Information</h5>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="text-secondary">Payment Method</div>
            <div class="fw-semibold">{{ $order->payment_method ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6">
            <div class="text-secondary">Shipping Method</div>
            <div class="fw-semibold"> {{ $order->shipping_method ?? 'Standard Shipping' }}</div>
        </div>
    </div>

    @if ($order->payment_method === 'Online' && $order->payment_status !== 'paid')
    <div id="paymentFailedBox" class="text-center mt-3 mb-2">
        <div class="p-4 text-center bg-white rounded shadow-sm">
            <div class="text-danger fw-bold fs-5 mb-2">Payment Failed</div>
            <p class="text-secondary mb-2">Your payment was unsuccessful.</p>

            <form action="{{ route('razorpay.retry') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->order_number }}">
                <button type="button" class="btn btn-primary-dark transition-3d-hover" id="retryPaymentBtn"
                    data-order-id="{{ $order->order_number }}">
                    Try Again
                </button>
            </form>
        </div>
    </div>
    @endif


    <h6 class="mb-3 fw-semibold">Items ({{ $order->items->sum('quantity') }})</h6>

    @foreach ($order->items as $item)
    @php
    $product = $item->product;
    $images = json_decode($product->images ?? '[]', true);
    $image = $images[0] ?? 'default.jpg';
    @endphp
    <div class="mb-3 d-flex align-items-center gap-3 p-3 rounded bg-white shadow-sm">
        <img src="{{ asset('uploads/products/' . $image) }}" alt="Product" width="60">
        <div>
            <div class="fw-semibold">{{ $product->product_name }}</div>
            <small class="text-secondary">
                SKU: PRD-00{{ $product->prod_id ?? 'N/A' }} &nbsp; Qty: {{ $item->quantity }}
            </small>
        </div>
        <div class="ms-auto fw-semibold">
            ₹{{ number_format($item->price * $item->quantity, 2) }}
        </div>
    </div>
    @endforeach

    <h6 class="fw-semibold mb-2">Shipping Address</h6>
    <div class="p-3 rounded bg-white shadow-sm">
        <div>{{ $order->name }}</div>
        <div>{{ $order->address_line }}</div>
        @if($order->area)
        <div>{{ $order->area }}</div>
        @endif
        <div>{{ $order->city }}, {{ $order->state }}, {{ $order->pincode }}</div>
        <div>{{ $order->country }}</div>
        <div class="mt-2 text-secondary small"> <i class="bi bi-telephone me-1"></i>
            +91 {{ $order->phone }}
        </div>
    </div>
</div>
</div>
@empty
<div class="text-center py-5">
    <h5 class="mb-3">You haven’t placed any orders yet.</h5>
    <a href="{{ route('index') }}" class="btn btn-primary">Start Shopping</a>
</div>
@endforelse


<!-- Order Card Example -->
<!-- <div class="order-card">
    <div class="d-flex justify-content-between mb-2">
        <span><strong>Order ID:</strong> #ORD-2024-1265</span>
        <span class="text-muted">Feb 15, 2025</span>
    </div>

    <div class="order-content">
        <div class="d-flex gap-3 mb-3">
            <img src="{{ asset('assets/img/item4.jpg') }}">
            <img src="{{ asset('assets/img/item5.jpg') }}">
            <img src="{{ asset('assets/img/item5.jpg') }}">
        </div>
        <div class="order-info row align-items-center mb-3">

            <div class="col-md-12 d-flex justify-content-between">
                <div class="text-muted mb-2">Status</div>
                <div class="mb-2">
                    <span class="badge order-status-pill" style="color: #fe700d; background-color: #fff0de;">
                        Processing
                    </span>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <div class="text-muted mb-2">Items</div>
                <div class="mb-2" style="font-weight: 500;">5 items</div>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <div class="text-muted">Total</div>
                <div style="font-weight: 600; color: #1c2b36;">$1,299.99</div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="javascript:void(0)" class="order-tracking btn order-btn-hover w-100 py-2 fw-semibold">
                Track Order
            </a>
        </div>
        <div class="col-md-6">
            <a href="javascript:void(0)" class="view-details btn btn-primary-dark w-100 py-2 fw-semibold">
                View Details
            </a>
        </div>
    </div>

    <div class="tracking-details mt-3" style="display: none;">
        <div class="p-3 rounded bg-light tracking-timeline">

            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-success timeline-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold">Order Confirmed</div>
                    <small class="text-muted">Your order has been received and confirmed<br>Feb 20, 2025 - 10:30 AM</small>
                </div>
            </div>

            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Processing</div>
                    <small class="text-muted">Preparing for shipment<br>Feb 20, 2025 - 2:45 PM</small>
                </div>
            </div>

            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Shipping</div>
                    <small class="text-muted">Your items have been packaged for shipping<br>Expected to ship within 24 hours
                    </small>
                </div>
            </div>

            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Delivery</div>
                    <small class="text-muted">Delivered to your doorstep <br>At: Feb 22, 2025
                    </small>
                </div>
            </div>

        </div>
    </div>

    <div class="order-details p-4 mt-3 rounded shadow-sm" style="display: none;">
        <h5 class="mb-3 fw-semibold border-bottom pb-2">Order Information</h5>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="text-muted">Payment Method</div>
                <div class="fw-semibold">Credit Card (**** 4589)</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted">Shipping Method</div>
                <div class="fw-semibold">Express Delivery (2-3 days)</div>
            </div>
        </div>

        <h6 class="mb-3 fw-semibold">Items (3)</h6>
        <div class="mb-3 d-flex align-items-center gap-3 p-3 rounded bg-white shadow-sm">
            <img src="{{ asset('assets/img/bag.jpg') }}" alt="Product" width="60">
            <div>
                <div class="fw-semibold">Lorem ipsum dolor sit amet</div>
                <small class="text-muted">SKU: PRD-001 &nbsp; Qty: 1</small>
            </div>
            <div class="ms-auto fw-semibold">$899.99</div>
        </div>
        <div class="mb-3 d-flex align-items-center gap-3 p-3 rounded bg-white shadow-sm">
            <img src="{{ asset('assets/img/glasses.jpg') }}" alt="Product" width="60">
            <div>
                <div class="fw-semibold">Sed do eiusmod tempor</div>
                <small class="text-muted">SKU: PRD-003 &nbsp; Qty: 1</small>
            </div>
            <div class="ms-auto fw-semibold">$129.99</div>
        </div>

        <h6 class="fw-semibold mb-3">Price Details</h6>
        <div class="p-3 rounded bg-white shadow-sm mb-4">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal</span>
                <span>$1,929.93</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Shipping</span>
                <span>$15.99</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Tax</span>
                <span>$159.98</span>
            </div>
            <div class="d-flex justify-content-between fw-bold border-top pt-2 mt-2 text-primary">
                <span>Total</span>
                <span>$2,105.90</span>
            </div>
        </div>

        <h6 class="fw-semibold mb-2">Shipping Address</h6>
        <div class="p-3 rounded bg-white shadow-sm">
            <div>Sarah Anderson</div>
            <div>123 Main Street</div>
            <div>Apt 4B</div>
            <div>New York, NY 10001</div>
            <div>United States</div>
            <div class="mt-2 text-muted small">+1 (555) 123-4567</div>
        </div>
    </div>

</div> -->