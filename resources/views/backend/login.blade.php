@include('backend.layout.header')

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a class="logo d-flex align-items-center w-auto" href="{{ route('index') }}">
                <img src="{{asset('assets/img/fashionkari.png')}}" alt="Fashionkari">
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your username & password to login</p>
                </div>

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{route('admin.login')}}" class="row g-3 needs-validation" method="post">

                  @csrf
                  <div class="col-12">
                    <label for="loginInput" class="form-label">Username or Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="login" class="form-control" id="loginInput" required value="{{ old('login') }}">
                      <div class="invalid-feedback">Please enter your username or email.</div>
                    </div>
                    <!-- login error -->
                    @error('login')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                    <!-- password error -->
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>


                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe" required>
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                </form>
                <div class="col-12">
                  <p class="small mb-0">Don't have account? <a href="/admin/register">Create an account</a></p>
                </div>

              </div>
            </div>

            <div class="credits">
              Designed by <a href="">#</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->

@include('backend.layout.footer')