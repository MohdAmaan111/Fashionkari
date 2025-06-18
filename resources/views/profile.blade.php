@extends('layout.app')

@section('content')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">

    <!-- Success Message -->
    <div id="successMessage" style="display:none; position:fixed; top:20px; right:20px; background:#28a745; color:#fff; padding:10px 20px; border-radius:5px; z-index:9999;">
    </div><!-- Success Message End -->

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
                            <span class="order-status-pill badge ms-auto">4</span>
                        </a>
                        <a href="" class="list-group-item list-group-item-action sidebar-link"
                            data-url="{{ route('customer.wishlist') }}">
                            <i class="bi bi-heart"></i> Wishlists
                            <span class="order-status-pill badge ms-auto">12</span>
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

                        <hr style="  border-top: 1px solid;">

                        <a href="{{ route('customer.logout') }}" class="list-group-item list-group-item-action text-danger text-bold">
                            <i class="bi bi-box-arrow-left"></i> Log Out
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
                error: function() {
                    $('#profileContent').html('<div class="alert alert-danger">Failed to load content.</div>');
                }
            });
        });
    });
</script>

@endsection