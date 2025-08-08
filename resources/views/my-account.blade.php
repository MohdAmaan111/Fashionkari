@extends('layout.app')

@section('content')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">

    <!-- Toast Message -->
    <div class="custom-toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="toastMessage" class="toast message-toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2">
                    <i id="toastIcon" class="bi bi-check2-circle"></i> <!-- Bootstrap icon -->
                </div>
                <div class="toast-body flex-grow-1 message-text">
                    Product Added
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="progress-bar-bottom"></div>
        </div>
    </div><!-- End Toast Message -->

    <!-- Breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Account</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">My Account</h1>
        </div>
        <div class="my-4 my-xl-8">
            <div class="row">
                <!-- Login -->
                <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-6">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                    </div>
                    <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
                    <!-- End Title -->

                    <!-- <form action="{{route('customer.login')}}" method="POST"> -->
                    <form id="customerLoginForm">
                        @csrf
                        <!-- Form Email -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signinEmail">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signinEmailLabel">
                                            <span class="fas fa-envelope"></span>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                        data-msg="Please enter a valid email address."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- email error -->
                                <small class="text-danger" id="login_error_email"></small>
                            </div>
                        </div>
                        <!-- End Form Email -->

                        <!-- Form Password -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signinPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signinPasswordLabel">
                                            <span class="fas fa-lock"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="signinPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                        data-msg="Your password is invalid. Please try again."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- password error -->
                                <small class="text-danger" id="login_error_password"></small>
                            </div>
                        </div>
                        <!-- End Form Password -->

                        <!-- Forgot Password -->
                        <div class="d-flex justify-content-end mb-4">
                            <a class="js-animation-link small link-muted" href="javascript:;"
                                data-target="#forgotPassword"
                                data-link-group="idForm"
                                data-animation-in="slideInUp">Forgot Password?</a>
                        </div>
                        <!-- End Forgot Password -->

                        <!-- Checkbox -->
                        <div class="js-form-message mb-3">
                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required
                                    data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                <label class="custom-control-label form-label" for="rememberCheckbox">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <!-- End Checkbox -->

                        <!-- Submit Button -->
                        <div class="mb-1">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                            </div>
                            <div class="mb-2">
                                <a class="text-blue" href="#">Lost your password?</a>
                            </div>
                        </div>
                        <!-- End Submit Button -->
                    </form>
                </div>
                <!-- End Login -->

                <div class="col-md-1 d-none d-md-block">
                    <div class="flex-content-center h-100">
                        <div class="width-1 bg-1 h-100"></div>
                        <div class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">or</div>
                    </div>
                </div>

                <!-- Signup -->
                <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-6">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
                    </div>
                    <p class="text-gray-90 mb-4">Create new account today to reap the benefits of a personalized shopping experience.</p>
                    <!-- End Title -->

                    <form id="customerRegisterForm">
                        @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupName">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupNameLabel">
                                            <span class="fas fa-user"></span>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="customer_name" id="signupName" placeholder="Name" aria-label="Name" aria-describedby="signupNameLabel" required
                                        data-msg="Please enter a valid name."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- name error -->
                                <div id="error_customer_name" class="text-danger"></div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Email -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupEmail">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupEmailLabel">
                                            <span class="fas fa-envelope"></span>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                        data-msg="Please enter a valid email address."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- email error -->
                                <div id="error_email" class="text-danger"></div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Password -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupPasswordLabel">
                                            <span class="fas fa-lock"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                        data-msg="Your password is invalid. Please try again."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- password error -->
                                <div id="error_password" class="text-danger"></div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupConfirmPasswordLabel">
                                            <span class="fas fa-key"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password_confirmation" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                        data-msg="Password does not match the confirm password."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <p class="text-gray-90 mb-4">Your personal data will be used to support your experience throughout this website, to manage your account, and for other purposes described in our <a href="#" class="text-blue">privacy policy.</a></p>
                        <!-- Register Button -->
                        <div class="mb-6">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary-dark-w px-5">Register</button>
                            </div>
                        </div>
                        <!-- End Register Button -->
                    </form>
                    <h3 class="font-size-18 mb-3">Sign up today and you will be able to :</h3>
                    <ul class="list-group list-group-borderless">
                        <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Speed your way through checkout</li>
                        <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Track your orders easily</li>
                        <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Keep a record of all your purchases</li>
                    </ul>
                </div>
                <!-- End Signup -->
            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
    $(document).ready(function() {
        // console.log("working");
    });

    // To login customer with ajax
    $('#customerLoginForm').on('submit', function(e) {
        e.preventDefault(); // prevent page reload

        console.log("working");

        // Clear old errors
        $('#login_error_email, #login_error_password').text('');

        const form = $(this);

        $.ajax({
            url: "{{ route('customer.login') }}", // Your controller route
            method: "POST",
            data: form.serialize(),
            success: function(response) {
                showToast(response.message, "success");

                // ✅ Reload after 0.8 seconds
                setTimeout(function() {
                    window.location.href = "{{ route('index') }}";
                }, 800);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;

                // console.log("AJAX Error", xhr.message);
                if (errors.email) {
                    $('#login_error_email').text(errors.email[0]);
                }
                if (errors.password) {
                    console.log("password error");
                    $('#login_error_password').text(errors.password[0]);
                }
            }

        });
    });

    // To register customer with ajax
    $('#customerRegisterForm').on('submit', function(e) {
        e.preventDefault(); // prevent page reload

        console.log("working");

        // Clear old errors
        $('#error_customer_name, #error_email, #error_password').text('');

        $.ajax({
            url: "{{ route('customer.register') }}", // Your controller route
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, "success");

                // ✅ Reload after 0.8 seconds
                setTimeout(function() {
                    window.location.href = "{{ route('index') }}";
                }, 800);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.customer_name) {
                        $('#error_customer_name').text(errors.customer_name[0]);
                    }
                    if (errors.email) {
                        $('#error_email').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#error_password').text(errors.password[0]);
                    }
                }
            }
        });
    });
</script>


@endsection