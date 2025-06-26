    <h5 class="fw-bold mb-4">Account Settings</h5>

    <!-- Personal Information -->
    <div class="border rounded-4 p-4 mb-4">
        <h6 class="fw-semibold mb-3">Personal Information</h6>
        <form id="updatePersonalInfo">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname', $customer->cus_name) }}">
                    <small class="text-danger error-fullname"></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                    <small class="text-danger error-email"></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                    <small class="text-danger error-phone"></small>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" id="updateCustInfo" class="btn px-5 btn-primary-dark transition-3d-hover">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Customer Address -->
    <div class="border rounded-4 p-4 mb-4">
        <h6 class="fw-semibold mb-3">Address</h6>

        <form id="updateAddress">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address) }}">
                    <small class="text-danger error-address"></small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $customer->city) }}">
                    <small class="text-danger error-city"></small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $customer->state) }}">
                    <small class="text-danger error-state"></small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $customer->country) }}">
                    <small class="text-danger error-country"></small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $customer->postal_code) }}">
                    <small class="text-danger error-postal_code"></small>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover">
                    Save Changes
                </button>
            </div>
        </form>

    </div>

    <!-- Security -->
    <div class="border rounded-4 p-4 mb-4">
        <h6 class="fw-semibold mb-3">Security</h6>
        <form id="updateSecurity">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control">
                    <small class="text-danger error-current_password"></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                    <small class="text-danger error-new_password"></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                    <small class="text-danger error-new_password_confirmation"></small>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="border border-danger-subtle text-danger rounded-4 p-4 mb-4">
        <h6 class="fw-semibold text-danger mb-2">Delete Account</h6>
        <p class="mb-3">Once you delete your account, there is no going back. Please be certain.</p>
        <button id="deleteAccountBtn" class="btn btn-danger order-btn-hover transition-3d-hover">Delete Account</button>
    </div>