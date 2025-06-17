<!-- Main Content -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">My Orders</h5>
    <div class="my-orders d-flex gap-2 align-items-center">
        <div class="search-bar d-flex align-items-center mr-2">
            <input type="text" placeholder="Search orders...">
        </div>
        <button class="search-bar btn btn-outline-secondary ml-2"><i class="bi bi-funnel"></i> Filter</button>
    </div>
</div>

<!-- Order Card 1 -->
<div class="order-card">
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

    <!-- Hidden tracking details section -->
    <div class="tracking-details mt-3" style="display: none;">
        <div class="p-3 rounded bg-light tracking-timeline">

            <!-- Order Confirmed status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-success timeline-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold">Order Confirmed</div>
                    <small class="text-muted">Your order has been received and confirmed<br>Feb 20, 2025 - 10:30 AM</small>
                </div>
            </div>

            <!-- Order Processing status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Processing</div>
                    <small class="text-muted">Preparing for shipment<br>Feb 20, 2025 - 2:45 PM</small>
                </div>
            </div>

            <!-- Order Shipping status -->
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

            <!-- Order Delivery status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Delivery</div>
                    <small class="text-muted">Your items have been packaged for shipping<br>Estimated delivery: Feb 22, 2025
                    </small>
                </div>
            </div>

            <!-- Add more steps here as needed -->
        </div>
    </div>

    <!-- Hidden order details section -->
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

</div>

<!-- Order Card 2 -->
<div class="order-card">
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
                    <span class="badge order-status-pill" style="color: #06b6d4; background-color: #dafdff;">
                        Shipped
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
            <a href="#" class="view-details btn btn-primary-dark w-100 py-2 fw-semibold">
                View Details
            </a>
        </div>
    </div>


    <!-- Hidden tracking details section -->
    <div class="tracking-details mt-3" style="display: none;">
        <div class="p-3 rounded bg-light tracking-timeline">

            <!-- Order Confirmed status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-success timeline-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold">Order Confirmed</div>
                    <small class="text-muted">Your order has been received and confirmed<br>Feb 20, 2025 - 10:30 AM</small>
                </div>
            </div>

            <!-- Order Processing status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Processing</div>
                    <small class="text-muted">Preparing for shipment<br>Feb 20, 2025 - 2:45 PM</small>
                </div>
            </div>

            <!-- Order Shipping status -->
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

            <!-- Order Delivery status -->
            <div class="d-flex align-items-start mb-3 ms-5">
                <div class="me-3 text-warning timeline-icon">
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <div class="fw-semibold text-warning">Delivery</div>
                    <small class="text-muted">Your items have been packaged for shipping<br>Estimated delivery: Feb 22, 2025
                    </small>
                </div>
            </div>

            <!-- Add more steps here as needed -->
        </div>
    </div>

    <!-- Hidden order details section -->
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

</div>

<!-- Order Card 3 -->
<div class="order-card">
    <div class="d-flex justify-content-between mb-2">
        <span><strong>Order ID:</strong> #ORD-2024-1265</span>
        <span class="text-muted">Feb 15, 2025</span>
    </div>

    <div class="order-content">
        <div class="d-flex gap-3 mb-3">
            <img src="{{ asset('assets/img/item4.jpg') }}">
            <img src="{{ asset('assets/img/item5.jpg') }}">
        </div>
        <div class="order-info row align-items-center mb-3">

            <div class="col-md-12 d-flex justify-content-between">
                <div class="text-muted mb-2">Status</div>
                <div class="mb-2">
                    <span class="badge order-status-pill" style="background-color: #d5f9e0; color: #22c55e;">
                        Delivered
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
            <a href="#" class="btn order-btn-hover order-delivered w-100 py-2 fw-semibold">
                Write Review
            </a>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary-dark w-100 py-2 fw-semibold">
                View Details
            </a>
        </div>
    </div>

</div>

<!-- Order Card 4 -->
<div class="order-card">
    <div class="d-flex justify-content-between mb-2">
        <span><strong>Order ID:</strong> #ORD-2024-1265</span>
        <span class="text-muted">Feb 15, 2025</span>
    </div>

    <div class="order-content">
        <div class="d-flex gap-3 mb-3">
            <img src="{{ asset('assets/img/item4.jpg') }}">
            <img src="{{ asset('assets/img/item5.jpg') }}">
        </div>
        <div class="order-info row align-items-center mb-3">

            <div class="col-md-12 d-flex justify-content-between">
                <div class="text-muted mb-2">Status</div>
                <div class="mb-2">
                    <span class="badge order-status-pill" style="background-color: #f9dcdc; color: #ef4444; font-weight: 600;">
                        Cancelled
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
            <a href="#" class="btn order-btn-hover order-cancelled w-100 py-2 fw-semibold">
                Reorder
            </a>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary-dark w-100 py-2 fw-semibold">
                View Details
            </a>
        </div>
    </div>

</div>