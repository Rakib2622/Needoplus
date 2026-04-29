<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Needo Plus</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/fav.png') }}" rel="icon" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">

        <!-- TOP STRIP -->
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="{{ route('terms') }}">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="{{ route('settings.help') }}">Help & Support</a>
                </div>
            </div>

            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/needoplus">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.linkedin.com/company/needoplus/">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.instagram.com/needoplus757/">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="https://www.youtube.com/@NeedoPlus">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- MAIN HEADER -->
        <div class="row align-items-center bg-primary py-3 px-xl-5">

            <!-- LOGO -->
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ route('home') }}"
               class="d-flex align-items-center text-decoration-none mb-3">

                <img src="{{ asset('assets/img/logg.png') }}" style="height:50px;">

                    <span class="silver-text">NEEDO+</span>
            
            </a>
            </div>

            <!-- SEARCH -->
            <div class="col-lg-6 col-6 text-left">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search for products..."
                            value="{{ request('search') }}">

                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-transparent border-0">
                                <i class="fa fa-search" style="color:#ffffff;"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- RIGHT ICONS -->
            <div class="col-lg-3 col-6 text-right">

                <!-- 🔔 NOTIFICATION -->
                <a href="#" class="btn position-relative">
                    <i class="fas fa-bell" style="color:#ffffff;"></i>
                    <span class="badge badge-danger position-absolute"
                        style="top:0; right:0;">
                        0
                    </span>
                </a>

                <!-- 🛒 CART -->
                <!-- 🛒 CART WITH DROPDOWN -->
                <div class="nav-item dropdown d-inline-block">

                    <a href="#" class="btn position-relative" id="cartDropdown" data-toggle="dropdown">
                        <i class="fas fa-shopping-cart" style="color:#ffffff;"></i>

                        <span id="cart-count"
                            class="badge text-white position-absolute"
                            style="top:0; right:0;">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>

                    <!-- DROPDOWN -->
                    <div class="dropdown-menu dropdown-menu-right shadow border-0 p-0"
                        style="min-width: 360px; border-radius:12px; overflow:hidden;"
                        id="cart-dropdown-menu">

                        <!-- HEADER -->
                        <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
                            <strong>My Cart</strong>
                            <small class="text-muted"><span id="cart-count">0</span> items</small>
                        </div>

                        <!-- ITEMS -->
                        <div id="cart-items" style="max-height: 320px; overflow-y:auto;">
                            <div class="text-center py-4 text-muted">
                                Loading...
                            </div>
                        </div>

                        <!-- FOOTER -->
                        <div class="px-3 py-3 border-top bg-white">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <strong>৳ <span id="cart-total">0</span></strong>
                            </div>

                            <small class="text-muted d-block mb-3">
                                Shipping & taxes calculated at checkout
                            </small>

                            <a href="{{ route('cart.index') }}"
                                class="btn btn-primary btn-block">
                                View Cart
                            </a>

                            <a href="{{ route('checkout.index') }}"
                                class="btn btn-success btn-block mb-2">
                                Checkout
                            </a>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Topbar End -->