<div class="cart-items order-success p-4 bg-white rounded shadow-sm">
    <div class="text-center mt-3">
        <div class="text-success fw-bold fs-5 mb-2">Your order has been placed!</div>

        <div class="fs-4 fw-semibold mb-3">
            Order ID <span class="text-primary" id="orderNumber">#51253134</span>
        </div>

        <p class="text-muted mb-4">
            A confirmation email has been sent to <strong id="customerEmail">hello@email.com</strong>
        </p>
    </div>

    <div class="row gy-3 justify-content-center">
        <!-- Customer Name -->
        <div class="col-md-8">
            <div class="d-flex align-items-stretch">
                <!-- Label (Left side) -->
                <div class="label-box rounded-start fw-semibold px-4 py-3 me-1" style="width: 180px; background-color: #ebf2f5;">
                    <p class="mb-0 fw-semibold text-dark">Customer Name</p>
                </div>
                <!-- Value (Right side) -->
                <div class="value-box bg-light flex-grow-1 rounded-end px-4 py-3">
                    <p class="mb-0 text-dark" id="customerName">Your Name</p>
                </div>
            </div>
        </div>

        <!-- Phone Number -->
        <div class="col-md-8">
            <div class="d-flex align-items-stretch">
                <!-- Label (Left side) -->
                <div class="label-box rounded-start fw-semibold px-4 py-3 me-1"
                    style="width: 180px; background-color: #ebf2f5;">
                    <p class="mb-0 fw-semibold text-dark">Phone Number</p>
                </div>
                <!-- Value (Right side) -->
                <div class="value-box bg-light flex-grow-1 rounded-end px-4 py-3">
                    <p class="mb-0 text-dark" id="customerPhone">+880 1423 4234 245</p>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="col-md-8">
            <div class="d-flex align-items-stretch">
                <!-- Label (Left side) -->
                <div class="label-box rounded-start fw-semibold px-4 py-3 me-1"
                    style="width: 180px; background-color: #ebf2f5;">
                    <p class="mb-0 fw-semibold text-dark">Shipping Address</p>
                </div>

                <!-- Value (Right side) -->
                <div class="value-box bg-light flex-grow-1 rounded-end px-4 py-3">
                    <p class="mb-0 text-dark" id="shippingAddress">
                        56M/8B, Gaus nagar, Kareli, Kareli, Prayagraj, Maharashtra, 211016
                    </p>
                </div>
            </div>

        </div>

        <!-- Delivery Option -->
        <div class="col-md-8">
            <div class="d-flex align-items-stretch">
                <!-- Label (Left side) -->
                <div class="label-box rounded-start fw-semibold px-4 py-3 me-1" style="width: 180px; background-color: #ebf2f5;">
                    <p class="mb-0 text-dark">Delivery Method</p>
                </div>
                <!-- Value (Right side) -->
                <div class="value-box bg-light flex-grow-1 rounded-end px-4 py-3">
                    <p class="mb-0 text-dark" id="deliveryOption">Standard DDP</p>
                </div>
            </div>
        </div>

        <!-- Payment Option -->
        <div class="col-md-8">
            <div class="d-flex align-items-stretch">
                <!-- Label (Left side) -->
                <div class="label-box rounded-start fw-semibold px-4 py-3 me-1" style="width: 180px; background-color: #ebf2f5;">
                    <p class="mb-0 text-dark">Payment Method</p>
                </div>
                <!-- Value (Right side) -->
                <div class="value-box bg-light flex-grow-1 rounded-end px-4 py-3">
                    <p class="mb-0 text-dark" id="paymentOption">Payment</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Back To Shopping Page -->
    <div class="text-center mt-3">
        <a href="{{ route('index') }}"
            class="btn btn-light px-4 py-2"
            style="background-color: rgba(119, 131, 143, 0.1);">
            <i class="bi bi-arrow-left"></i> Continue Shopping
        </a>
    </div>
</div>