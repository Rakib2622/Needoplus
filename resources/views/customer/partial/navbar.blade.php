<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">

        <!-- FULL WIDTH NAVBAR -->
        <div class="col-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">

                <!-- Mobile Logo -->
                <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center d-block d-lg-none">
                    <img src="{{ asset('assets/img/logg.png') }}" alt="Needo+" style="height: 40px;">
                    <span class="text-primary" style="font-weight: bold; font-size: 28px; margin-left: 6px;">
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

                        <!-- CATEGORY DROPDOWN (SEPARATE MENU) -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                Category
                            </a>

                            <div class="dropdown-menu rounded-0 m-0">

                                @forelse($navCategories as $category)
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="dropdown-item d-flex align-items-center">

                                    @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        width="25"
                                        class="me-2"
                                        style="object-fit: cover;">
                                    @endif

                                    {{ $category->name }}
                                </a>
                                @empty
                                <span class="dropdown-item text-muted">No categories found</span>
                                @endforelse

                            </div>
                        </div>

                        <a href="{{ route('packages.index') }}" class="nav-item nav-link">Packages</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">About</a>

                        @guest
                        <a href="{{ route('settings') }}" class="nav-item nav-link">Settings & Help</a>
                        @endguest
                    </div>

                    <!-- AUTH MENU -->
                    <div class="navbar-nav ml-auto py-0">
                        @auth
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                                <i class="fa fa-user-circle mr-2" style="font-size: 20px;"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <a href="{{ route('profile.index') }}" class="dropdown-item">
                                    <i class="fa fa-user mr-2"></i> Profile
                                </a>
                                <a href="{{ route('orders.index') }}" class="dropdown-item">
                                    <i class="fa fa-box mr-2"></i> Orders
                                </a>
                                <a href="{{ route('settings') }}" class="dropdown-item">
                                    <i class="fa fa-cog mr-2"></i> Settings & Help
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
        </div>

        <!-- FULL WIDTH HERO -->
        <div class="container-fluid px-lg-4 px-2 py-3">

    <div id="header-carousel"
         class="carousel slide premium-carousel"
         data-ride="carousel"
         data-interval="4000">

        <div class="carousel-inner">

            {{-- 🔥 DYNAMIC --}}
            @if($discount && $discount->image)
            <div class="carousel-item active">
                <div class="carousel-card">

                    <img src="{{ asset('storage/' . $discount->image) }}" class="carousel-img">

                    <div class="carousel-overlay"></div>

                    <div class="carousel-content">

                        <a href="{{ $discountUrl }}" class="carousel-btn">
                            Shop Now →
                        </a>
                    </div>

                </div>
            </div>
            @endif

            {{-- STATIC 1 --}}
            <div class="carousel-item {{ !$discount ? 'active' : '' }}">
                <div class="carousel-card">

                    <img src="{{ asset('assets/img/banar1.png') }}" class="carousel-img">

                    <div class="carousel-overlay"></div>

                    <div class="carousel-content">

                        <a href="{{ route('products.index') }}" class="carousel-btn">
                            Shop Now →
                        </a>
                    </div>

                </div>
            </div>

            {{-- STATIC 2 --}}
            <div class="carousel-item">
                <div class="carousel-card">

                    <img src="{{ asset('assets/img/banar2.png') }}" class="carousel-img">

                    <div class="carousel-overlay"></div>

                    <div class="carousel-content">

                        <a href="{{ route('products.index') }}" class="carousel-btn">
                            Shop Now →
                        </a>
                    </div>

                </div>
            </div>

        </div>

        <!-- CONTROLS -->
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <span class="carousel-arrow">‹</span>
        </a>

        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <span class="carousel-arrow">›</span>
        </a>

    </div>

</div>

    </div>
</div>