<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $meta['title'] ?? $product->prod_name ?? 'Buy Trendy Clothing Online | FashionKari' }}</title>
    <meta name="keywords" content="{{ $meta['keywords'] ?? 't-shirts, jeans, dresses, men fashion, women clothing, online shopping, FashionKari' }}">
    <meta name="description" content="{{ $meta['description'] ?? 'Discover the latest styles in clothing for men, women, and kids at FashionKari. Shop trendy outfits, seasonal fashion, and everyday essentials online.' }}">

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}">
    <link href="{{asset('assets/img/favicon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-electro.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

    <link href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">

    <!-- jQuery File -->
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
</head>

<body>

    <!-- ========== HEADER ========== -->
    <header id="header" class="u-header u-header-left-aligned-nav">
        <div class="u-header__section">
            <!-- Topbar -->
            <div class="u-header-topbar py-2 d-none d-xl-block bg-primary border-bottom-0">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="topbar-left">
                            <a href="#" class="text-gray-70 font-size-13 u-header-topbar__nav-link">Welcome to Fashionkari Store</a>
                        </div>
                        <div class="topbar-right ml-auto">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-map-pointer mr-1"></i> Store Locator</a>
                                </li>
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border full-bg">
                                    <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Track Your Order</a>
                                </li>
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border full-bg">
                                    <!-- Account Sidebar Toggle Button -->
                                    <!-- <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
                                        aria-controls="sidebarContent"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarContent"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInRight"
                                        data-unfold-animation-out="fadeOutRight"
                                        data-unfold-duration="500">
                                        <i class="ec ec-user mr-1"></i> Register <span class="text-primary-darken-5">or</span> Sign in
                                    </a> -->
                                    <!-- End Account Sidebar Toggle Button -->
                                    @if(auth('customer')->check())
                                    <a href="{{ route('customer.profile') }}" class="u-header-topbar__nav-link">
                                        <i class="ec ec-user mr-1"></i> My Profile
                                    </a>
                                    @else
                                    <a href="{{ route('customer.account') }}" class="u-header-topbar__nav-link">
                                        <i class="ec ec-user mr-1"></i> Register <span class="text-primary-darken-5">or</span> Sign in
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Topbar -->

            <!-- Logo-Search-header-icons -->
            <div class="py-2 py-xl-5 bg-primary">
                <div class="container my-0dot5 my-xl-0">
                    <div class="row align-items-center">
                        <!-- Logo-offcanvas-menu -->
                        <div class="col-auto">
                            <!-- Nav -->
                            <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                                <!-- Logo -->
                                <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('index') }}" aria-label="Electro">
                                    <img src="{{asset('assets/img/fashionkari.png')}}" alt="Fashionkari">
                                </a>
                                <!-- End Logo -->

                                <!-- Fullscreen Toggle Button -->
                                <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                    aria-controls="sidebarHeader"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarHeader1"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft"
                                    data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                    <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                        <span class="u-hamburger__inner"></span>
                                    </span>
                                </button>
                                <!-- End Fullscreen Toggle Button -->
                            </nav>
                            <!-- End Nav -->

                            <!-- ========== HEADER SIDEBAR ========== -->
                            <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                                <div class="u-sidebar__scroller">
                                    <div class="u-sidebar__container">
                                        <div class="u-header-sidebar__footer-offset pb-0">
                                            <!-- Toggle Button -->
                                            <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                <button type="button" class="close ml-auto"
                                                    aria-controls="sidebarHeader"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    data-unfold-event="click"
                                                    data-unfold-hide-on-scroll="false"
                                                    data-unfold-target="#sidebarHeader1"
                                                    data-unfold-type="css-animation"
                                                    data-unfold-animation-in="fadeInLeft"
                                                    data-unfold-animation-out="fadeOutLeft"
                                                    data-unfold-duration="500">
                                                    <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                </button>
                                            </div>
                                            <!-- End Toggle Button -->

                                            <!-- Content -->
                                            <div class="js-scrollbar u-sidebar__body">
                                                <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                    <!-- Logo -->
                                                    <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="index.html" aria-label="Electro">
                                                        <svg version="1.1" x="0px" y="0px" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52" style="margin-bottom: 0;">
                                                            <ellipse class="ellipse-bg" fill-rule="evenodd" clip-rule="evenodd" fill="#FDD700" cx="170.05" cy="36.341" rx="5.32" ry="5.367"></ellipse>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#333E48" d="M30.514,0.71c-0.034,0.003-0.066,0.008-0.056,0.056
                                                                        C30.263,0.995,29.876,1.181,29.79,1.5c-0.148,0.548,0,1.568,0,2.427v36.459c0.265,0.221,0.506,0.465,0.725,0.734h6.187
                                                                        c0.2-0.25,0.423-0.477,0.669-0.678V1.387C37.124,1.185,36.9,0.959,36.701,0.71H30.514z M117.517,12.731
                                                                        c-0.232-0.189-0.439-0.64-0.781-0.734c-0.754-0.209-2.039,0-3.121,0h-3.176V4.435c-0.232-0.189-0.439-0.639-0.781-0.733
                                                                        c-0.719-0.2-1.969,0-3.01,0h-3.01c-0.238,0.273-0.625,0.431-0.725,0.847c-0.203,0.852,0,2.399,0,3.725
                                                                        c0,1.393,0.045,2.748-0.055,3.725h-6.41c-0.184,0.237-0.629,0.434-0.725,0.791c-0.178,0.654,0,1.813,0,2.765v2.766
                                                                        c0.232,0.188,0.439,0.64,0.779,0.733c0.777,0.216,2.109,0,3.234,0c1.154,0,2.291-0.045,3.176,0.057v21.277
                                                                        c0.232,0.189,0.439,0.639,0.781,0.734c0.719,0.199,1.969,0,3.01,0h3.01c1.008-0.451,0.725-1.889,0.725-3.443
                                                                        c-0.002-6.164-0.047-12.867,0.055-18.625h6.299c0.182-0.236,0.627-0.434,0.725-0.79c0.176-0.653,0-1.813,0-2.765V12.731z
                                                                        M135.851,18.262c0.201-0.746,0-2.029,0-3.104v-3.104c-0.287-0.245-0.434-0.637-0.781-0.733c-0.824-0.229-1.992-0.044-2.898,0
                                                                        c-2.158,0.104-4.506,0.675-5.74,1.411c-0.146-0.362-0.451-0.853-0.893-0.96c-0.693-0.169-1.859,0-2.842,0h-2.842
                                                                        c-0.258,0.319-0.625,0.42-0.725,0.79c-0.223,0.82,0,2.338,0,3.443c0,8.109-0.002,16.635,0,24.381
                                                                        c0.232,0.189,0.439,0.639,0.779,0.734c0.707,0.195,1.93,0,2.955,0h3.01c0.918-0.463,0.725-1.352,0.725-2.822V36.21
                                                                        c-0.002-3.902-0.242-9.117,0-12.473c0.297-4.142,3.836-4.877,8.527-4.686C135.312,18.816,135.757,18.606,135.851,18.262z
                                                                        M14.796,11.376c-5.472,0.262-9.443,3.178-11.76,7.056c-2.435,4.075-2.789,10.62-0.501,15.126c2.043,4.023,5.91,7.115,10.701,7.9
                                                                        c6.051,0.992,10.992-1.219,14.324-3.838c-0.687-1.1-1.419-2.664-2.118-3.951c-0.398-0.734-0.652-1.486-1.616-1.467
                                                                        c-1.942,0.787-4.272,2.262-7.134,2.145c-3.791-0.154-6.659-1.842-7.524-4.91h19.452c0.146-2.793,0.22-5.338-0.279-7.563
                                                                        C26.961,15.728,22.503,11.008,14.796,11.376z M9,23.284c0.921-2.508,3.033-4.514,6.298-4.627c3.083-0.107,4.994,1.976,5.685,4.627
                                                                        C17.119,23.38,12.865,23.38,9,23.284z M52.418,11.376c-5.551,0.266-9.395,3.142-11.76,7.056
                                                                        c-2.476,4.097-2.829,10.493-0.557,15.069c1.997,4.021,5.895,7.156,10.646,7.957c6.068,1.023,11-1.227,14.379-3.781
                                                                        c-0.479-0.896-0.875-1.742-1.393-2.709c-0.312-0.582-1.024-2.234-1.561-2.539c-0.912-0.52-1.428,0.135-2.23,0.508
                                                                        c-0.564,0.262-1.223,0.523-1.672,0.676c-4.768,1.621-10.372,0.268-11.537-4.176h19.451c0.668-5.443-0.419-9.953-2.73-13.037
                                                                        C61.197,13.388,57.774,11.12,52.418,11.376z M46.622,23.343c0.708-2.553,3.161-4.578,6.242-4.686
                                                                        c3.08-0.107,5.08,1.953,5.686,4.686H46.622z M160.371,15.497c-2.455-2.453-6.143-4.291-10.869-4.064
                                                                        c-2.268,0.109-4.297,0.65-6.02,1.524c-1.719,0.873-3.092,1.957-4.234,3.217c-2.287,2.519-4.164,6.004-3.902,11.007
                                                                        c0.248,4.736,1.979,7.813,4.627,10.326c2.568,2.439,6.148,4.254,10.867,4.064c4.457-0.18,7.889-2.115,10.199-4.684
                                                                        c2.469-2.746,4.012-5.971,3.959-11.063C164.949,21.134,162.732,17.854,160.371,15.497z M149.558,33.952
                                                                        c-3.246-0.221-5.701-2.615-6.41-5.418c-0.174-0.689-0.26-1.25-0.4-2.166c-0.035-0.234,0.072-0.523-0.045-0.77
                                                                        c0.682-3.698,2.912-6.257,6.799-6.547c2.543-0.189,4.258,0.735,5.52,1.863c1.322,1.182,2.303,2.715,2.451,4.967
                                                                        C157.789,30.669,154.185,34.267,149.558,33.952z M88.812,29.55c-1.232,2.363-2.9,4.307-6.13,4.402
                                                                        c-4.729,0.141-8.038-3.16-8.025-7.563c0.004-1.412,0.324-2.65,0.947-3.726c1.197-2.061,3.507-3.688,6.633-3.612
                                                                        c3.222,0.079,4.966,1.708,6.632,3.668c1.328-1.059,2.529-1.948,3.9-2.99c0.416-0.315,1.076-0.688,1.227-1.072
                                                                        c0.404-1.031-0.365-1.502-0.891-2.088c-2.543-2.835-6.66-5.377-11.704-5.137c-6.02,0.288-10.218,3.697-12.484,7.846
                                                                        c-1.293,2.365-1.951,5.158-1.729,8.408c0.209,3.053,1.191,5.496,2.619,7.508c2.842,4.004,7.385,6.973,13.656,6.377
                                                                        c5.976-0.568,9.574-3.936,11.816-8.354c-0.141-0.271-0.221-0.604-0.336-0.902C92.929,31.364,90.843,30.485,88.812,29.55z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <!-- End Logo -->

                                                    <!-- List -->
                                                    <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                        <!-- Home Section -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarHomeCollapse" data-target="#headerSidebarHomeCollapse">
                                                                Home & Static Pages
                                                            </a>

                                                            <div id="headerSidebarHomeCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarHomeMenu" class="u-header-collapse__nav-list">
                                                                    <!-- Home - v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="index.html">Home v1</a></li>
                                                                    <!-- End Home - v1 -->
                                                                    <!-- Home - v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v2.html">Home v2</a></li>
                                                                    <!-- End Home - v2 -->
                                                                    <!-- Home - v3 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v3.html">Home v3</a></li>
                                                                    <!-- End Home - v3 -->
                                                                    <!-- Home - v3-full-color-bg -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v3-full-color-bg.html">Home v3.1</a></li>
                                                                    <!-- End Home - v3-full-color-bg -->
                                                                    <!-- Home - v4 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v4.html">Home v4</a></li>
                                                                    <!-- End Home - v4 -->
                                                                    <!-- Home - v5 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v5.html">Home v5</a></li>
                                                                    <!-- End Home - v5 -->
                                                                    <!-- Home - v6 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v6.html">Home v6</a></li>
                                                                    <!-- End Home - v6 -->
                                                                    <!-- Home - v7 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="home-v7.html">Home v7</a></li>
                                                                    <!-- End Home - v7 -->
                                                                    <!-- About -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="about.html">About</a></li>
                                                                    <!-- End About -->
                                                                    <!-- Contact v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="contact-v1.html">Contact v1</a></li>
                                                                    <!-- End Contact v1 -->
                                                                    <!-- Contact v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="contact-v2.html">Contact v2</a></li>
                                                                    <!-- End Contact v2 -->
                                                                    <!-- FAQ -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="faq.html">FAQ</a></li>
                                                                    <!-- End FAQ -->
                                                                    <!-- Store Directory -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="store-directory.html">Store Directory</a></li>
                                                                    <!-- End Store Directory -->
                                                                    <!-- Terms and Conditions -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="terms-and-conditions.html">Terms and Conditions</a></li>
                                                                    <!-- End Terms and Conditions -->
                                                                    <!-- 404 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="404.html">404</a></li>
                                                                    <!-- End 404 -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Home Section -->

                                                        <!-- Shop Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarPagesCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarPagesCollapse">
                                                                Shop Pages
                                                            </a>

                                                            <div id="headerSidebarPagesCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarPagesMenu" class="u-header-collapse__nav-list">
                                                                    <!-- Shop Grid -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid.html">Shop Grid</a></li>
                                                                    <!-- End Shop Grid -->

                                                                    <!-- Shop Grid Extended -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid-extended.html">Shop Grid Extended</a></li>
                                                                    <!-- End Shop Grid Extended -->

                                                                    <!-- Shop List View -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view.html">Shop List View</a></li>
                                                                    <!-- End Shop List View -->

                                                                    <!-- Shop List View Small -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view-small.html">Shop List View Small</a></li>
                                                                    <!-- End Shop List View Small -->

                                                                    <!-- Shop Left Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                                                    <!-- End Shop Left Sidebar -->

                                                                    <!-- Shop Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-full-width.html">Shop Full width</a></li>
                                                                    <!-- End Shop Full width -->

                                                                    <!-- Shop Right Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                                                    <!-- End Shop Right Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Shop Pages -->

                                                        <!-- Product Categories -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarBlogCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarBlogCollapse">
                                                                Product Categories
                                                            </a>

                                                            <div id="headerSidebarBlogCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarBlogMenu" class="u-header-collapse__nav-list">
                                                                    <!-- 4 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-4-column-sidebar.html">4 Column Sidebar</a></li>
                                                                    <!-- End 4 Column Sidebar -->

                                                                    <!-- 5 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">5 Column Sidebar</a></li>
                                                                    <!-- End 5 Column Sidebar -->

                                                                    <!-- 6 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-6-column-full-width.html">6 Column Full width</a></li>
                                                                    <!-- End 6 Column Full width -->

                                                                    <!-- 7 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html">7 Column Full width</a></li>
                                                                    <!-- End 7 Column Full width -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Product Categories -->

                                                        <!-- Single Product Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarShopCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarShopCollapse">
                                                                Single Product Pages
                                                            </a>

                                                            <div id="headerSidebarShopCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                    <!-- Single Product Extended -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-extended.html">Single Product Extended</a></li>
                                                                    <!-- End Single Product Extended -->

                                                                    <!-- Single Product Fullwidth -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html">Single Product Fullwidth</a></li>
                                                                    <!-- End Single Product Fullwidth -->

                                                                    <!-- Single Product Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-sidebar.html">Single Product Sidebar</a></li>
                                                                    <!-- End Single Product Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Single Product Pages -->

                                                        <!-- Ecommerce Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarDemosCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarDemosCollapse">
                                                                Ecommerce Pages
                                                            </a>

                                                            <div id="headerSidebarDemosCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarDemosMenu" class="u-header-collapse__nav-list">
                                                                    <!-- Shop -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html">Shop</a></li>
                                                                    <!-- End Shop -->

                                                                    <!-- Cart -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="{{ route('cart') }}">Cart</a></li>
                                                                    <!-- End Cart -->

                                                                    <!-- Checkout -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/checkout.html">Checkout</a></li>
                                                                    <!-- End Checkout -->

                                                                    <!-- My Account -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="{{ route('customer.account') }}">My Account</a></li>
                                                                    <!-- End My Account -->

                                                                    <!-- Track your Order -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/track-your-order.html">Track your Order</a></li>
                                                                    <!-- End Track your Order -->

                                                                    <!-- wishlist -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="{{ route('wishlist') }}">wishlist</a></li>
                                                                    <!-- End wishlist -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Ecommerce Pages -->

                                                        <!-- Shop Columns -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebardocsCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebardocsCollapse">
                                                                Shop Columns
                                                            </a>

                                                            <div id="headerSidebardocsCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebardocsMenu" class="u-header-collapse__nav-list">
                                                                    <!-- 7 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-7-columns-full-width.html">7 Column Full width</a></li>
                                                                    <!-- End 7 Column Full width -->

                                                                    <!-- 6 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-6-columns-full-width.html">6 Column Full width</a></li>
                                                                    <!-- End 6 Column Full width -->

                                                                    <!-- 5 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-5-columns-sidebar.html">5 Column Sidebar</a></li>
                                                                    <!-- End 5 Column Sidebar -->

                                                                    <!-- 4 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-4-columns-sidebar.html">4 Column Sidebar</a></li>
                                                                    <!-- End 4 Column Sidebar -->

                                                                    <!-- 3 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-3-columns-sidebar.html">3 Column Sidebar</a></li>
                                                                    <!-- End 3 Column Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Shop Columns -->

                                                        <!-- Blog Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarblogsCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarblogsCollapse">
                                                                Blog Pages
                                                            </a>

                                                            <div id="headerSidebarblogsCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarblogsMenu" class="u-header-collapse__nav-list">
                                                                    <!-- Blog v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v1.html">Blog v1</a></li>
                                                                    <!-- End Blog v1 -->

                                                                    <!-- Blog v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v2.html">Blog v2</a></li>
                                                                    <!-- End Blog v2 -->

                                                                    <!-- Blog v3 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v3.html">Blog v3</a></li>
                                                                    <!-- End Blog v3 -->

                                                                    <!-- Blog Full Width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-full-width.html">Blog Full Width</a></li>
                                                                    <!-- End Blog Full Width -->

                                                                    <!-- Single Blog Post -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link" href="https://transvelo.github.io/electro-html/2.0/html/blog/single-blog-post.html">Single Blog Post</a></li>
                                                                    <!-- End Single Blog Post -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Blog Pages -->
                                                    </ul>
                                                    <!-- End List -->
                                                </div>
                                            </div>
                                            <!-- End Content -->
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <!-- ========== END HEADER SIDEBAR ========== -->
                        </div>
                        <!-- End Logo-offcanvas-menu -->

                        <!-- Search Bar -->
                        <div class="col d-none d-xl-block">
                            <form class="js-focus-state">
                                <label class="sr-only" for="searchproduct">Search</label>
                                <div class="input-group">
                                    <input type="email" class="form-control py-2 pl-5 font-size-15 border-right-0 height-42 border-width-0 rounded-left-pill border-primary" name="email" id="searchproduct-item" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                    <div class="input-group-append">
                                        <!-- Select -->
                                        <select class="js-select selectpicker dropdown-select custom-search-categories-select bg-white"
                                            data-style="btn height-42 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-primary border-width-0 pl-0 pr-5 py-2">
                                            <option value="" selected>All Categories</option>
                                            @foreach($globalCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                            @endforeach
                                        </select>

                                        <!-- End Select -->
                                        <button class="btn btn-dark height-42 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                            <span class="ec ec-search font-size-20"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Search Bar -->

                        <!-- Header Icons -->
                        <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                            <div class="d-inline-flex">
                                <ul class="d-flex list-unstyled mb-0 align-items-center">
                                    <!-- Search -->
                                    <li class="col d-xl-none px-2 px-sm-3 position-static">
                                        <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Search"
                                            aria-controls="searchClassic"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-unfold-target="#searchClassic"
                                            data-unfold-type="css-animation"
                                            data-unfold-duration="300"
                                            data-unfold-delay="300"
                                            data-unfold-hide-on-scroll="true"
                                            data-unfold-animation-in="slideInUp"
                                            data-unfold-animation-out="fadeOut">
                                            <span class="ec ec-search"></span>
                                        </a>

                                        <!-- Input -->
                                        <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                            <form class="js-focus-state input-group px-3">
                                                <input class="form-control" type="search" placeholder="Search Product">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary px-3" type="button">
                                                        <i class="font-size-18 ec ec-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Input -->
                                    </li>
                                    <!-- End Search -->

                                    <li class="col d-none d-xl-block">
                                        <a href="{{ route('wishlist') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a>
                                    </li>
                                    <li class="col d-xl-none px-2 px-sm-3">
                                        <a href="{{ route('customer.profile') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Profile"><i class="font-size-22 ec ec-user"></i></a>
                                    </li>
                                    <li class="col pr-xl-0 px-2 px-sm-3">
                                        <a href="{{ route('cart') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                            <i class="font-size-22 ec ec-shopping-bag"></i>
                                            <!-- Number of cart items -->
                                            <span id="cartItemCountBadge" class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">{{ $cartItemCount }}</span>
                                            <!-- Total price added in cart -->
                                            @if ($cartSubtotal > 0)
                                            <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">
                                                ₹{{ number_format($cartSubtotal, 2) }}
                                            </span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Header Icons -->
                    </div>
                </div>
            </div>
            <!-- End Logo-Search-header-icons -->

            <!-- Primary-menu-wide -->
            <div class="d-none d-xl-block bg-primary border-color-2">
                <div class="container">
                    <div class="min-height-45">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--wide u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    <!-- Home -->
                                    <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut"
                                        data-position="left">
                                        <a id="homeMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Home</a>

                                        <!-- Home - Mega Menu -->
                                        <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="homeMegaMenu">
                                            <div class="row u-header__mega-menu-wrapper">
                                                <div class="col-md-3">
                                                    <span class="u-header__sub-menu-title">Home & Static Pages</span>
                                                    <ul class="u-header__sub-menu-nav-group">
                                                        <li><a href="index.html" class="nav-link u-header__sub-menu-nav-link">Home v1</a></li>
                                                        <li><a href="home-v2.html" class="nav-link u-header__sub-menu-nav-link">Home v2</a></li>
                                                        <li><a href="home-v3.html" class="nav-link u-header__sub-menu-nav-link">Home v3</a></li>
                                                        <li><a href="home-v3-full-color-bg.html" class="nav-link u-header__sub-menu-nav-link">Home v3.1</a></li>
                                                        <li><a href="home-v4.html" class="nav-link u-header__sub-menu-nav-link">Home v4</a></li>
                                                        <li><a href="home-v5.html" class="nav-link u-header__sub-menu-nav-link">Home v5</a></li>
                                                        <li><a href="home-v6.html" class="nav-link u-header__sub-menu-nav-link">Home v6</a></li>
                                                        <li><a href="home-v7.html" class="nav-link u-header__sub-menu-nav-link">Home v7</a></li>
                                                        <li><a href="about.html" class="nav-link u-header__sub-menu-nav-link">About</a></li>
                                                        <li><a href="contact-v1.html" class="nav-link u-header__sub-menu-nav-link">Contact v1</a></li>
                                                        <li><a href="contact-v2.html" class="nav-link u-header__sub-menu-nav-link">Contact v2</a></li>
                                                        <li><a href="faq.html" class="nav-link u-header__sub-menu-nav-link">FAQ</a></li>
                                                        <li><a href="store-directory.html" class="nav-link u-header__sub-menu-nav-link">Store Directory</a></li>
                                                        <li><a href="terms-and-conditions.html" class="nav-link u-header__sub-menu-nav-link">Terms and Conditions</a></li>
                                                        <li><a href="404.html" class="nav-link u-header__sub-menu-nav-link">404</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="u-header__sub-menu-title">Shop Pages</span>
                                                    <ul class="u-header__sub-menu-nav-group mb-3">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid.html" class="nav-link u-header__sub-menu-nav-link">Shop Grid</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid-extended.html" class="nav-link u-header__sub-menu-nav-link">Shop Grid Extended</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view.html" class="nav-link u-header__sub-menu-nav-link">Shop List View</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view-small.html" class="nav-link u-header__sub-menu-nav-link">Shop List View Small</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-left-sidebar.html" class="nav-link u-header__sub-menu-nav-link">Shop Left Sidebar</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-full-width.html" class="nav-link u-header__sub-menu-nav-link">Shop Full width</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-right-sidebar.html" class="nav-link u-header__sub-menu-nav-link">Shop Right Sidebar</a></li>
                                                    </ul>
                                                    <span class="u-header__sub-menu-title">Product Categories</span>
                                                    <ul class="u-header__sub-menu-nav-group">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-4-column-sidebar.html" class="nav-link u-header__sub-menu-nav-link">4 Column Sidebar</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html" class="nav-link u-header__sub-menu-nav-link">5 Column Sidebar</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-6-column-full-width.html" class="nav-link u-header__sub-menu-nav-link">6 Column Full width</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html" class="nav-link u-header__sub-menu-nav-link">7 Column Full width</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="u-header__sub-menu-title">Single Product Pages</span>
                                                    <ul class="u-header__sub-menu-nav-group mb-3">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-extended.html" class="nav-link u-header__sub-menu-nav-link">Single Product Extended</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html" class="nav-link u-header__sub-menu-nav-link">Single Product Fullwidth</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-sidebar.html" class="nav-link u-header__sub-menu-nav-link">Single Product Sidebar</a></li>
                                                    </ul>
                                                    <span class="u-header__sub-menu-title">Ecommerce Pages</span>
                                                    <ul class="u-header__sub-menu-nav-group">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="nav-link u-header__sub-menu-nav-link">Shop</a></li>
                                                        <li><a href="{{ route('cart') }}" class="nav-link u-header__sub-menu-nav-link">Cart</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/checkout.html" class="nav-link u-header__sub-menu-nav-link">Checkout</a></li>
                                                        <li><a href="{{ route('customer.account') }}" class="nav-link u-header__sub-menu-nav-link">My Account</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/track-your-order.html" class="nav-link u-header__sub-menu-nav-link">Track your Order</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html" class="nav-link u-header__sub-menu-nav-link">Compare</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="u-header__sub-menu-title">Blog Pages</span>
                                                    <ul class="u-header__sub-menu-nav-group mb-3">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v1.html" class="nav-link u-header__sub-menu-nav-link">Blog v1</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v2.html" class="nav-link u-header__sub-menu-nav-link">Blog v2</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v3.html" class="nav-link u-header__sub-menu-nav-link">Blog v3</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-full-width.html" class="nav-link u-header__sub-menu-nav-link">Blog Full Width</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/blog/single-blog-post.html" class="nav-link u-header__sub-menu-nav-link">Single Blog Post</a></li>
                                                    </ul>
                                                    <span class="u-header__sub-menu-title">Shop Columns</span>
                                                    <ul class="u-header__sub-menu-nav-group">
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-7-columns-full-width.html" class="nav-link u-header__sub-menu-nav-link">7 Column Full width</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-6-columns-full-width.html" class="nav-link u-header__sub-menu-nav-link">6 Column Full width</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-5-columns-sidebar.html" class="nav-link u-header__sub-menu-nav-link">5 Column Sidebar</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-4-columns-sidebar.html" class="nav-link u-header__sub-menu-nav-link">4 Column Sidebar</a></li>
                                                        <li><a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-3-columns-sidebar.html" class="nav-link u-header__sub-menu-nav-link">3 Column Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Home - Mega Menu -->
                                    </li>
                                    <!-- End Home -->

                                    <!-- Summer Wear -->
                                    <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut">
                                        <a id="SummerWearMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Summer Wear</a>

                                        <!-- Summer Wear - Mega Menu -->
                                        <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="SummerWearMegaMenu">
                                            <div class="row u-header__mega-menu-wrapper">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Accessories</span>
                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Headsets</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Cables &amp; Chargers</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Electronic Accessories</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Selfie Sticks</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Internal Batteries</a></li>
                                                            </ul>
                                                            <span class="u-header__sub-menu-title">Cases &amp; Covers</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For iPhone X<br> </a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For Samsung S9</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Below AED 59</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For Xiaomi</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For iPhone 7</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Tablets</span>
                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">iPads</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Samsung</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Microsoft Surface</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Lenovo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Innjoo</a></li>
                                                            </ul>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <span class="u-header__sub-menu-title">Shop By Price</span>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For iPhone X<br> </a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For Samsung S9</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Below AED 59</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For Xiaomi</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">For iPhone 7</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Mobiles</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Samsung</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Lenovo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Mi</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Motorola</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Oppo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Panasonic<br> </a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">HTC</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Blackberry</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">LG</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Micromax</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Nokia</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Huawei</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">#Trending</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Oppo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Panasonic</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Samsung</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Lenovo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Mi</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Motorola</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Nokia</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Huawei</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">HTC</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Blackberry</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">LG</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Micromax</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#" class="d-block">
                                                        <img class="img-fluid" src="{{asset('assets/img/1024X1024/img1.jpg')}}" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Smart Phones - Mega Menu -->
                                    </li>
                                    <!-- End Summer Wear -->

                                    <!-- Indian Wear -->
                                    <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut">
                                        <a id="IndianWearMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Indian Wear</a>

                                        <!-- Indian Wear - Mega Menu -->
                                        <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="IndianWearMegaMenu">
                                            <div class="row u-header__mega-menu-wrapper">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img3.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <span class="u-header__sub-menu-title">Computers &amp; Accessories</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Laptops, Desktops &amp; Monitors</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Networking &amp; Internet Devices</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Computer Accessories</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img4.png')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="u-header__sub-menu-title">Peripherals</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Hard Drives</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Pen Drives & Memory Cards</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Printers & Ink</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Mouse</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img5.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <span class="u-header__sub-menu-title">Cameras</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">DSLR</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Lenses</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Security &amp; Surveillance</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Binoculars &amp; Telescopes</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Camcorders</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img6.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="u-header__sub-menu-title">Watches</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Men's Watches</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Women's Watches</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Premium Watches</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Kids Watches</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Deals on Watches</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img7.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <span class="u-header__sub-menu-title">Accessories</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Mouses</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Keyboards</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Hardrives</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Headphones</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Speakers</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img8.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="u-header__sub-menu-title">Gadgets</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Fire TV Stick</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Google Chromecast</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Set Top</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Accessories</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Deals of the Day</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Gadgets - Mega Menu -->
                                    </li>
                                    <!-- End Indian Wear -->

                                    <!-- Western Wear -->
                                    <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut">
                                        <a id="WesternWearMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">Western Wear</a>

                                        <!-- Western Wear - Mega Menu -->
                                        <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="WesternWearMegaMenu">
                                            <div class="row u-header__mega-menu-wrapper">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Cameras</span>
                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">DSLR Cameras</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Digital Cameras</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Security &amp; Surveillance</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Camcorders</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Consoles</a></li>
                                                            </ul>
                                                            <span class="u-header__sub-menu-title">Shop By Price</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Below Rs. 100$</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">101$ - 199$</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">200$ - 299$</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">300$ - 399$</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">400$ and Above</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Shop By Focal Length</span>
                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">8mm - 24mm</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">24mm - 35mm</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">35mm - 85mm</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">85mm - 135mm</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">135mm+</a></li>
                                                            </ul>
                                                            <span class="u-header__sub-menu-title">#Trending</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Sony</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Nikon</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Canon</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Sanyo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Samsung</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Accessories</span>
                                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Headphones</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Mouses</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Hardrives</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Headphones</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Speakers</a></li>
                                                            </ul>
                                                            <span class="u-header__sub-menu-title">Add-ons</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Data Cables</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Keypads</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Earphones</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Lenses</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Camera Accessories</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="u-header__sub-menu-title">Shop By Brands</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Canon</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Nikon</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Pentax</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Sony</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Apple</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Leica</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Samsung</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Panasonic</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">LG</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Oppo</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Olympus</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Sanyo</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#" class="d-block">
                                                        <img class="img-fluid" src="assets/img/1024X1024/img4.png" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Cameras & Accessories - Mega Menu -->
                                    </li>
                                    <!-- End Western Wear -->

                                    <!-- New Arrivals -->
                                    <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut">
                                        <a id="NewArrivalsMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">New Arrivals</a>

                                        <!-- New Arrivals - Mega Menu -->
                                        <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="NewArrivalsMegaMenu">
                                            <div class="row u-header__mega-menu-wrapper">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img9.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <span class="u-header__sub-menu-title">Movies &amp; TV Shows</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">All Movies &amp; TV Shows</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Blu-ray</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Latest Movies</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">All English</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">All Hindi</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img10.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <span class="u-header__sub-menu-title">Video Games</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Games &amp; Accessories</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">PC Games</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">New Releases</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Consoles</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Accessories</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="#" class="d-block">
                                                                <img class="img-fluid" src="{{asset('assets/img/300X275/img11.jpg')}}" alt="Image Description">
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <span class="u-header__sub-menu-title">Music</span>
                                                            <ul class="u-header__sub-menu-nav-group">
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">5.1 Speaker</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Home Theatres</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Soundbars</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Accessories</a></li>
                                                                <li><a href="#" class="nav-link u-header__sub-menu-nav-link">Consoles</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Movies & Games - Mega Menu -->
                                    </li>
                                    <!-- End New Arrivals -->
                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                </div>
            </div>
            <!-- End Primary-menu-wide -->
        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    @yield('content');

    <!-- ========== FOOTER ========== -->
    <footer>
        <!-- Footer-newsletter -->
        <div class="bg-primary py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col-auto flex-horizontal-center">
                                <i class="ec ec-newsletter font-size-40"></i>
                                <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                            </div>
                            <div class="col my-4 my-md-0">
                                <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$20 coupon for first shopping.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="js-validate js-form-message">
                            <label class="sr-only" for="subscribeSrEmail">Email address</label>
                            <div class="input-group input-group-pill">
                                <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="Email address" aria-label="Email address" aria-describedby="subscribeButton" required
                                    data-msg="Please enter a valid email address.">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-newsletter -->
        <!-- Footer-bottom-widgets -->
        <div class="pt-8 pb-4 bg-gray-13">
            <div class="container mt-1">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="mb-6">
                            <a class="d-inline-block order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="#" aria-label="Electro">
                                <img src="{{asset('assets/img/fashionkari.png')}}" alt="Fashionkari">
                            </a>
                        </div>
                        <div class="mb-4">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <i class="ec ec-support text-primary font-size-56"></i>
                                </div>
                                <div class="col pl-3">
                                    <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                    <a href="tel:+80080018588" class="font-size-20 text-gray-90">(800) 8001-8588, </a><a href="tel:+0600874548" class="font-size-20 text-gray-90">(0600) 874 548</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-1 font-weight-bold">Contact info</h6>
                            <address class="">
                                17 Princess Road, London, Greater London NW1 8JR, UK
                            </address>
                        </div>
                        <div class="my-4 my-md-4">
                            <ul class="list-inline mb-0 opacity-7">
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                        <span class="fab fa-google btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                        <span class="fab fa-twitter btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                        <span class="fab fa-github btn-icon__inner"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-12 col-md mb-4 mb-md-0">
                                <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                                <!-- List Group -->
                                <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Laptops & Computers</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Cameras & Photography</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Smart Phones & Tablets</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Video Games & Consoles</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">TV & Audio</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Gadgets</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Car Electronic & GPS</a></li>
                                </ul>
                                <!-- End List Group -->
                            </div>

                            <div class="col-12 col-md mb-4 mb-md-0">
                                <!-- List Group -->
                                <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Printers & Ink</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Software</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Office Supplies</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Computer Components</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Accesories</a></li>
                                </ul>
                                <!-- End List Group -->
                            </div>

                            <div class="col-12 col-md mb-4 mb-md-0">
                                <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                <!-- List Group -->
                                <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action" href="{{ route('customer.account') }}">My Account</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://transvelo.github.io/electro-html/2.0/html/shop/track-your-order.html">Order Tracking</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="{{ route('wishlist') }}">Wish List</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="terms-and-conditions.html">Customer Service</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="terms-and-conditions.html">Returns / Exchange</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="faq.html">FAQs</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="terms-and-conditions.html">Product Support</a></li>
                                </ul>
                                <!-- End List Group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-bottom-widgets -->
        <!-- Footer-copy-right -->
        <div class="bg-gray-14 py-2">
            <div class="container">
                <div class="flex-center-between d-block d-md-flex">
                    <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">Electro</a> - All rights Reserved</div>
                    <div class="text-md-right">
                        <span class="d-inline-block bg-white border rounded p-1">
                            <img class="max-width-5" src="{{asset('assets/img/100X60/img1.jpg')}}" alt="Image Description">
                        </span>
                        <span class="d-inline-block bg-white border rounded p-1">
                            <img class="max-width-5" src="{{asset('assets/img/100X60/img2.jpg')}}" alt="Image Description">
                        </span>
                        <span class="d-inline-block bg-white border rounded p-1">
                            <img class="max-width-5" src="{{asset('assets/img/100X60/img3.jpg')}}" alt="Image Description">
                        </span>
                        <span class="d-inline-block bg-white border rounded p-1">
                            <img class="max-width-5" src="{{asset('assets/img/100X60/img4.jpg')}}" alt="Image Description">
                        </span>
                        <span class="d-inline-block bg-white border rounded p-1">
                            <img class="max-width-5" src="{{asset('assets/img/100X60/img5.jpg')}}" alt="Image Description">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-copy-right -->
    </footer>
    <!-- ========== END FOOTER ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->

    <!-- Account Sidebar Navigation -->

    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#"
        data-position='{"bottom": 15, "right": 15 }'
        data-type="fixed"
        data-offset-top="400"
        data-compensation="#header"
        data-show-effect="slideInUp"
        data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

    <!-- JS Razorpay -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{asset('assets/vendor/appear.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
    <script src="{{asset('assets/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
    <script src="{{asset('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/typed.js/lib/typed.min.js')}}"></script>
    <script src="{{asset('assets/vendor/slick-carousel/slick/slick.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- JS Electro -->
    <script src="{{asset('assets/js/hs.core.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.countdown.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.header.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.hamburgers.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.unfold.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.focus-state.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.malihu-scrollbar.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.validation.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.fancybox.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.onscroll-animation.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.slick-carousel.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.show-animation.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.svg-injector.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.go-to.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.selectpicker.js')}}"></script>

    <!-- JS Plugins Init. -->
    <script>
        // Toast Message script
        function showToast(message = "Product Added", type = "success") {
            const $toastEl = $('#toastMessage');
            const $toastBody = $toastEl.find('.toast-body');
            const $progressBar = $toastEl.find('.progress-bar-bottom'); // ✅ fixed selector
            const $toastIcon = $('#toastIcon');

            $toastBody.text(message);

            $toastEl.removeClass('text-bg-success text-bg-danger');
            $progressBar.removeClass('bg-success bg-danger');

            // Set styles & icons based on type
            if (type === 'success') {
                $toastEl.addClass('text-bg-success');
                $progressBar.addClass('bg-success');
                $toastIcon.removeClass().addClass('bi bi-check2-circle').css('color', '#28a745');
            } else {
                $toastEl.addClass('text-bg-danger');
                $progressBar.addClass('bg-danger');
                $toastIcon.removeClass().addClass('bi bi-exclamation-circle').css('color', '#dc3545');
            }

            // ✅ Reset animation safely
            $progressBar.removeClass('animate');
            void $progressBar[0].offsetWidth; // force reflow
            $progressBar.addClass('animate');

            const toast = new bootstrap.Toast($toastEl[0], {
                delay: 1500, // milliseconds
                autohide: true
            });
            toast.show();
        }
        // End Toast Message script

        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function() {
            // alert("jQuery is working!")

            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');


            $('.addToCartIndexBtn').on('click', function(e) {
                e.preventDefault();

                console.log("Working");

                // Validate and sanitize quantity input
                const variantId = $(this).data('variant-id');
                const quantity = $(this).data('quantity');

                console.log("variantId => " + variantId);

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        selected_variant_id: variantId,
                        quantity: quantity
                    },
                    success: function(response) {
                        showToast(response.message, "success");

                        setTimeout(function() {
                            location.reload();
                        }, 1200);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);

                        // Parse the error message from JSON
                        let errorMessage = "Something went wrong!";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            let errors = xhr.responseJSON.errors;

                            if (xhr.status === 401) {
                                // User not logged in (unauthorized)
                                let errorMessage = xhr.responseJSON?.message || "Please login to continue.";
                                showToast(errorMessage, "danger");
                            }
                            if (xhr.status === 404) {
                                // Product Variant not found
                                let errorMessage = xhr.responseJSON?.message;
                                showToast(errorMessage, "danger");
                            }
                            if (xhr.status === 409) {
                                // Product is already in your cart
                                let errorMessage = xhr.responseJSON?.message;
                                showToast(errorMessage, "danger");
                            }
                            if (errors.quantity) {
                                // User enters quantity more than stock
                                $('#quantityError').text(errors.quantity[0]).show();
                            }

                            // errorMessage = xhr.responseJSON.message;
                        }

                        //showToast(errorMessage, "danger"); // ❌ Show red toast
                    }
                });
            });
        });

        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();

            var productId = $(this).data('product-id');
            var variantId = $(this).data('variant-id');

            // console.log("Product ID : " + productId);
            // console.log("Variant ID : " + variantId);

            let $icon = $(this).find('.wishlist-icon');
            const isWishlisted = $icon.hasClass('bi-heart-fill');

            if (isWishlisted) {
                // Already in wishlist — ask before removing
                if (confirm("Do you really want to remove this item from your wishlist?")) {
                    $.ajax({
                        url: '{{ route("wishlist.remove") }}', // route we'll define below
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            variant_id: variantId
                        },
                        success: function(response) {
                            $icon.removeClass('bi-heart-fill active').addClass('bi-heart');
                            showToast("Removed from wishlist", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1200);
                        },
                        error: function() {
                            showToast("Error removing from wishlist", "danger");
                        }
                    });
                }
            } else {
                // Not in wishlist — add it
                $.ajax({
                    url: '{{ route("wishlist.add") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function(response) {
                        $icon.addClass('active bi-heart-fill').removeClass('bi-heart');
                        showToast(response.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1200);
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            // User not logged in (unauthorized)
                            let errorMessage = xhr.responseJSON?.message || "Please login to continue.";
                            showToast(errorMessage, "danger");
                        } else {
                            alert('Error adding to wishlist.');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>