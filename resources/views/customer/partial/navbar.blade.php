<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100"
                data-toggle="collapse"
                href="#navbar-vertical"
                style="height: 65px; margin-top: -1px; padding: 0 30px;">

                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>

            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">

                <div class="navbar-nav w-100 overflow-hidden" style="height: 420px">

                    <!-- Electronics -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            Electronics & Gadgets <i class="fa fa-angle-down float-right mt-1"></i>
                        </a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="#" class="dropdown-item">Smartphones</a>
                            <a href="#" class="dropdown-item">Laptops</a>
                            <a href="#" class="dropdown-item">Accessories</a>
                        </div>
                    </div>

                    <!-- Home & Kitchen -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            Home & Kitchen <i class="fa fa-angle-down float-right mt-1"></i>
                        </a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="#" class="dropdown-item">Kitchen Tools</a>
                            <a href="#" class="dropdown-item">Appliances</a>
                            <a href="#" class="dropdown-item">Storage</a>
                        </div>
                    </div>

                    <!-- Simple Categories -->
                    <a href="#" class="nav-item nav-link">Decoration & Lifestyle</a>
                    <a href="#" class="nav-item nav-link">Fashion & Clothing</a>
                    <a href="#" class="nav-item nav-link">Mobile Accessories</a>
                    <a href="#" class="nav-item nav-link">Beauty & Personal Care</a>
                    <a href="#" class="nav-item nav-link">Grocery & Daily Needs</a>
                    <a href="#" class="nav-item nav-link">Sports & Fitness</a>

                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">

                <!-- Mobile Logo -->
                <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center d-block d-lg-none">

                    <img src="{{ asset('assets/img/fav.png') }}" alt="Needo+" style="height: 40px;">

                    <span style="color:  #53c3d2; font-weight: bold; font-size: 24px; margin-left: 8px;">
                        NEEDO+
                    </span>

                </a>

                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                    <!-- MAIN MENU -->
                    <div class="navbar-nav mr-auto py-0">

                        <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>

                        <a href="{{ route('products.index') }}" class="nav-item nav-link">Shop</a>

                        <a href="{{ route('about') }}" class="nav-item nav-link">About</a>

                        <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>

                    </div>

                    <!-- AUTH MENU -->
                    <div class="navbar-nav ml-auto py-0">

                        @auth
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">

                                <!-- User Icon -->
                                <i class="fa fa-user-circle mr-2" style="font-size: 20px;"></i>

                                <!-- User Name -->
                                <span>{{ auth()->user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow">

                                <a href="{{ route('profile.index') }}" class="dropdown-item">
                                    <i class="fa fa-user mr-2"></i> Profile
                                </a>

                                <a href="{{ route('orders.index') }}" class="dropdown-item">
                                    <i class="fa fa-box mr-2"></i> Orders
                                </a>

                                <!-- NEW SETTINGS -->
                                <a href="{{ route('settings') }}" class="dropdown-item">
                                    <i class="fa fa-cog mr-2"></i> Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>

                            </div>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endauth

                    </div>

                </div>
            </nav>
            <div id="header-carousel" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="height: 410px; position: relative;">

                        <img class="img-fluid w-100 h-100"
                            src="{{ asset('assets/img/banar1.png') }}"
                            style="object-fit: cover;"
                            alt="Image">

                        <!-- Shop Now Button -->
                        <a href="{{ route('products.index') }}"
                            class="btn btn-primary"
                            style="position: absolute; bottom: 20px; right: 20px; border-radius: 30px;">
                            Shop Now
                        </a>

                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item" style="height: 410px; position: relative;">

                        <img class="img-fluid w-100 h-100"
                            src="{{ asset('assets/img/banar2.png') }}"
                            style="object-fit: cover;"
                            alt="Image">

                        <!-- Shop Now Button -->
                        <a href="{{ route('products.index') }}"
                            class="btn btn-primary"
                            style="position: absolute; bottom: 20px; right: 20px; border-radius: 30px;">
                            Shop Now
                        </a>

                    </div>

                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>

                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->