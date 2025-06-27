<div class="cart-items checkout-form-container">
    <h4 class="fw-bold border-bottom pb-2 mb-3">Shipping Details</h4>

    <form method="POST" action="{{ route('customer.orders') }}" id="checkoutForm">
        @csrf
        @php
        $cartTotal = 1000;
        @endphp
        <!-- {{-- Step 1: Customer Information --}} -->
        <div class="checkout-step" id="step1">
            <div class="mb-4">
                <span class="step-number">1</span>
                <h4 class="d-inline-block ms-2">Customer information</h4>
                <p class="text-muted small">Please fill out all the required fields to continue</p>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <label class="form-label">Full name*</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Captain" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Email address*</label>
                    <input type="email" name="email" class="form-control" placeholder="anyname@email.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone number*</label>
                    <input type="text" name="phone" class="form-control" placeholder="12514463453" required>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary-dark" onclick="nextStep(2)">Continue</button>
            </div>
        </div>

        <!-- {{-- Step 2: Shipping Address --}} -->
        <div class="checkout-step d-none" id="step2">
            <div class="mb-4">
                <span class="step-number">2</span>
                <h4 class="d-inline-block ms-2">Shipping address</h4>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Pincode*</label>
                    <input type="text" name="pincode" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">State*</label>
                    <select name="state" class="form-select" required>
                        <option value="">-- Select State --</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Ladakh">Ladakh</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Puducherry">Puducherry</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">City*</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Address line*</label>
                    <textarea name="address_line" class="form-control" rows="2" required></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-light border" onclick="prevStep(1)">Back</button>
                <button type="button" class="btn btn-primary-dark" onclick="nextStep(3)">Continue</button>
            </div>
        </div>

        <!-- {{-- Step 3: Delivery Options --}} -->
        <div class="checkout-step d-none" id="step3">
            <div class="mb-4">
                <span class="step-number">3</span>
                <h4 class="d-inline-block ms-2">Delivery options</h4>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Choose Payment Method*</label>

                    <div class="d-grid gap-3">
                        <!-- Card -->
                        <label class="payment-option" id="option-card">
                            <input type="radio" name="payment_method" value="card">
                            <i class="bi bi-credit-card fs-4"></i>
                            <div>
                                <div class="fw-bold">Pay via Card</div>
                                <small class="text-muted">Pay with your debit or credit card</small>
                            </div>
                        </label>

                        <!-- UPI -->
                        <label class="payment-option" id="option-upi">
                            <input type="radio" name="payment_method" value="upi">
                            <i class="bi bi-upc-scan fs-4"></i>
                            <div>
                                <div class="fw-bold">UPI</div>
                                <small class="text-muted">Pay using your UPI ID</small>
                            </div>
                        </label>

                        <!-- Cash on Delivery -->
                        <label class="payment-option" id="option-cod">
                            <input type="radio" name="payment_method" value="cod">
                            <i class="bi bi-wallet2 fs-4"></i>
                            <div>
                                <div class="fw-bold">Cash on Delivery</div>
                                <small class="text-muted">Pay when you receive your product</small>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Card Info -->
                <div id="card-info" class="d-none mt-4">
                    <label class="form-label">Supported cards</label>
                    <div class="card-icons mb-3">
                        <img src="https://img.icons8.com/color/48/visa.png" />
                        <img src="https://img.icons8.com/color/48/mastercard-logo.png" />
                        <img src="https://img.icons8.com/color/48/amex.png" />
                        <img src="https://img.icons8.com/color/48/discover.png" />
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6 card-field mb-3">
                            <input type="text" class="form-control" name="card_number" placeholder="Card number">
                        </div>
                        <div class="col-md-6 card-field mb-3">
                            <input type="text" class="form-control" name="card_name" placeholder="Full name">
                        </div>
                        <div class="col-md-6 card-field mb-3">
                            <input type="text" name="card_expiry" id="card-expiry" class="form-control" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="col-md-6 card-field mb-3">
                            <input type="text" class="form-control" name="card_cvv" placeholder="CVC">
                        </div>

                        <input type="hidden" name="total_amount" value="{{ $cartTotal }}">
                    </div>
                </div>

                <!-- UPI Info -->
                <div id="upi-info" class="card-field d-none mt-4">
                    <label class="form-label">Enter UPI ID</label>
                    <input type="text" class="form-control" name="upi_id" placeholder="example@upi">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-light border" onclick="prevStep(2)">Back</button>
                <!-- <button type="submit" class="btn btn-success">Place Order</button> -->
            </div>
        </div>
    </form>

</div>