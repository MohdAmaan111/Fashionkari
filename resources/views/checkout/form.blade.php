<div class="cart-items checkout-form-container">
    <h4 class="fw-bold border-bottom pb-2 mb-3">Shipping Details</h4>

    <form method="POST" id="checkoutForm">
        @csrf
        <!-- {{-- Step 1: Customer Information --}} -->
        <div class="checkout-step" id="step1">
            <div class="mb-4">
                <span class="step-number">1</span>
                <h4 class="d-inline-block ms-2">Customer information</h4>
                <p class="text-muted small">Please fill out all the required fields to continue</p>
            </div>

            <div class="row g-3 mb-3">
                <!-- Full name form input -->
                <div class="col-md-12">
                    <label class="form-label">Full name*</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Enter full name" value="{{ old('fullname',  optional($customer)->cus_name) }}" required>
                </div>
                <!-- Email form input -->
                <div class="col-6">
                    <label class="form-label">Email address*</label>
                    <input type="email" name="email" class="form-control" placeholder="example@gmail.com" value="{{ old('email', optional($customer)->email) }}" required>
                </div>
                <!-- Phone number form input -->
                <div class="col-md-6">
                    <label class="form-label">Phone number*</label>
                    <input type="text" name="phone" class="form-control" placeholder="+91" value="{{ old('phone', optional($customer)->phone) }}" required>
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
                    <input type="text" name="pincode" class="form-control" value="{{ old('postal_code', optional($customer)->postal_code) }}" required>
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
                    <input type="text" name="city" class="form-control" value="{{ old('city', optional($customer)->city) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Address line*</label>
                    <textarea name="address_line" class="form-control" rows="2" required>{{ old('address_line', optional($customer)->address) }}</textarea>
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

                    <div class="d-grid gap-3" id="payment-method-wrapper">

                        <!-- UPI -->
                        <label class="payment-option" id="option-upi">
                            <input type="radio" name="payment_method" value="Online">
                            <i class="bi bi-upc-scan fs-4"></i>
                            <div>
                                <div class="fw-bold">Online</div>
                                <small class="text-muted">Pay using your UPI ID or credit card</small>
                            </div>
                        </label>

                        <!-- Cash on Delivery -->
                        <label class="payment-option" id="option-cod">
                            <input type="radio" name="payment_method" value="COD">
                            <i class="bi bi-wallet2 fs-4"></i>
                            <div>
                                <div class="fw-bold">Cash on Delivery</div>
                                <small class="text-muted">Pay when you receive your product</small>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-light border" onclick="prevStep(2)">Back</button>
                <!-- <button type="submit" class="btn btn-success">Place Order</button> -->
            </div>
        </div>
    </form>

</div>