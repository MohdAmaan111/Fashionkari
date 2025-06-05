@include('backend.layout.header')

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- <form action="{{route('admin.register')}}" class="row g-3 needs-validation" method="post"> -->
                <form id="userRegisterForm" class="row g-3 needs-validation">

                  @csrf
                  <div class="col-12">
                    <label for="yourName" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" id="yourName" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                    <!-- Name error -->
                    <small id="error_user_name" class="text-danger"></small>
                  </div>

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                    <!-- Username error -->
                    <small id="error_username" class="text-danger"></small>
                  </div>

                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Your Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                      <!-- Email error -->
                      <small id="error_email" class="text-danger"></small>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                    <!-- Password error -->
                    <small id="error_password" class="text-danger"></small>
                  </div>

                  <div class="col-12">
                    <label for="yourPasswordConfirm" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="yourPasswordConfirm" required>
                    <div class="invalid-feedback">Please confirm your password!</div>
                    <!-- Confirm Password error -->
                    <small id="error_password_confirmation" class="text-danger"></small>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                      <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="/admin/login">Log in</a></p>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              Designed by
              <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->

<script>
  // To register user with ajax
  $('#userRegisterForm').on('submit', function(e) {
    e.preventDefault(); // prevent page reload

    // Clear old errors
    $('#error_user_name, #error_username, #error_email, #error_password').text('');

    $.ajax({
      url: "{{ route('admin.register') }}", // Your controller route
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        // ✅ Show success toast
        $('#successMessage')
          .text(response.message)
          .fadeIn(200)
          .delay(1500)
          .fadeOut(400);

        // ✅ Reload after 2 seconds
        setTimeout(function() {
          location.reload();
        }, 2000);
      },
      error: function(xhr) {
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;
          if (errors.name) {
            $('#error_user_name').text(errors.name[0]);
          }
          if (errors.username) {
            $('#error_username').text(errors.username[0]);
          }
          if (errors.email) {
            $('#error_email').text(errors.email[0]);
          }
          if (errors.password) {
            $('#error_password').text(errors.password[0]);
          }
          if (errors.password_confirmation) {
            $('#error_password_confirmation').text(errors.password_confirmation[0]);
          }
        }
      }

    });
  });
</script>

@include('backend.layout.footer')