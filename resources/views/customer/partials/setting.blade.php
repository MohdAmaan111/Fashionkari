    <h5 class="fw-bold mb-4">Account Settings</h5>

    <!-- Personal Information -->
    <div class="border rounded-4 p-4 mb-4">
        <h6 class="fw-semibold mb-3">Personal Information</h6>
        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" value="Sarah">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" value="Anderson">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="sarah@example.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" value="+1 (555) 123-4567">
                </div>
            </div>
            <div class="mt-4 text-end">
                <button class="btn btn-primary px-4">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Security -->
    <div class="border rounded-4 p-4 mb-4">
        <h6 class="fw-semibold mb-3">Security</h6>
        <form>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control">
                </div>
            </div>
            <div class="mt-4 text-end">
                <button class="btn btn-primary px-4">Update Password</button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="border border-danger-subtle text-danger rounded-4 p-4 mb-4">
        <h6 class="fw-semibold text-danger mb-2">Delete Account</h6>
        <p class="mb-3">Once you delete your account, there is no going back. Please be certain.</p>
        <button class="btn btn-danger">Delete Account</button>
    </div>