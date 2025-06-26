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

    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">

        <div class="container py-4">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="text-center mb-4">
                        <h5 class="fw-bold text-warning mb-1">
                            <!-- {{$customer->cus_name}} -->
                            @if(Auth::guard('customer')->check())
                            {{$customer->cus_name}}
                            @else
                            Guest
                            @endif
                        </h5>
                    </div>

                    <div class="list-group orders-sidebar">
                        <a href="" class="list-group-item list-group-item-action sidebar-link active"
                            data-url="{{ route('customer.orders') }}">
                            <i class="bi bi-box"></i> My Orders
                            <span class="order-status-pill badge ms-auto">{{ $ordersCount }}</span>
                        </a>
                        <a href="" class="list-group-item list-group-item-action sidebar-link"
                            data-url="{{ route('customer.wishlist') }}">
                            <i class="bi bi-heart"></i> Wishlists
                            <span class="order-status-pill badge ms-auto">{{ $wishlistCount }}</span>
                        </a>
                        <a href="" class="list-group-item list-group-item-action sidebar-link"
                            data-url="{{ route('customer.payment') }}">
                            <i class="bi bi-wallet2"></i> Payment Methods
                        </a>
                        <a href="" class="list-group-item list-group-item-action sidebar-link"
                            data-url="{{ route('customer.address') }}">
                            <i class="bi bi-geo-alt"></i> Addresses
                        </a>
                        <a href="" class="list-group-item list-group-item-action sidebar-link"
                            data-url="{{ route('customer.setting') }}">
                            <i class="bi bi-gear"></i> Account Settings
                        </a>

                        <hr style="border-top: 1px solid;">

                        <a href=""
                            id="logoutCustomerBtn"
                            class="list-group-item list-group-item-action text-danger text-bold"
                            data-url="{{ route('customer.logout') }}">
                            <i class=" bi bi-box-arrow-left"></i> Log Out
                        </a>
                    </div>

                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div id="profileContent">
                        <!-- Default content like orders or welcome message -->
                        @include('customer.partials.orders') {{-- default on load --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
    $(document).ready(function() {
        $('.order-tracking').on('click', function() {
            const trackingDiv = $(this).closest('.order-card').find('.tracking-details');
            trackingDiv.slideToggle(300);
        });

        $('.view-details').click(function(e) {
            e.preventDefault();
            let detailsPanel = $(this).closest('.order-card').find('.order-details');
            // Slide toggle the order details
            detailsPanel.slideToggle(300);
        });

        $('.sidebar-link').click(function(e) {
            e.preventDefault();

            // Remove active class from all
            $('.sidebar-link').removeClass('active');

            // Add active to current
            $(this).addClass('active');

            // Get the target URL from data attribute
            let url = $(this).data('url');

            console.log(url);

            // Load the content using AJAX
            // $('#profileContent').html('<div class="text-center my-5">Loading...</div>');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#profileContent').html(response);
                },
                error: function(xhr) {
                    console.error("AJAX Error: ", xhr.responseText);

                    $('#profileContent').html('<div class="alert alert-danger">Failed to load content.</div>');
                }
            });
        });
    });

    $(document).on('submit', '#updatePersonalInfo', function(e) {
        e.preventDefault();

        console.log("updating PersonalInfo");

        // Clear previous errors
        $('.text-danger').text('');

        $.ajax({
            url: "{{ route('customer.detail.update') }}", // Your controller route
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, "success");
            },
            error: function(xhr) {
                // console.error(xhr.responseText);
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key).text(value[0]);
                    });
                } else {
                    alert("Something went wrong. Please try again.");
                }
            }
        });
    });

    $(document).on('submit', '#updateAddress', function(e) {
        e.preventDefault();

        // Clear previous errors
        $('.text-danger').text('');

        $.ajax({
            url: "{{ route('customer.address.update') }}", // Your controller route
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, "success");
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key).text(value[0]);
                    });
                } else {
                    alert("Something went wrong. Please try again.");
                }
            }
        });
    });

    $(document).on('submit', '#updateSecurity', function(e) {
        e.preventDefault();

        // Clear previous errors
        $('.text-danger').text('');

        $.ajax({
            url: "{{ route('customer.security.update') }}", // Your controller route
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, "success");
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key).text(value[0]);
                    });
                } else {
                    alert("Something went wrong. Please try again.");
                }
            }
        });
    });

    $(document).on('click', '#deleteAccountBtn', function(e) {
        e.preventDefault();

        if (!confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
            return;
        }

        $.ajax({
            url: "{{ route('customer.account.delete') }}",
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                showToast(response.message, "success");

                setTimeout(function() {
                    location.reload();
                }, 1200);
            },
            error: function(xhr) {
                alert("Something went wrong. Please try again.");
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#logoutCustomerBtn', function(e) {
        e.preventDefault();

        const logoutUrl = $(this).data('url');

        $.ajax({
            url: logoutUrl,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                showToast(response.message, "success");

                setTimeout(function() {
                    window.location.href = "{{ route('index') }}";
                }, 1200);
            },
            error: function(xhr) {
                alert("Logout failed. Please try again.");

                console.log("xhr object:", xhr);
                console.log("xhr.status:", xhr.status);
                console.log("xhr.responseText:", xhr.responseText);
            }
        });
    });
</script>

@endsection