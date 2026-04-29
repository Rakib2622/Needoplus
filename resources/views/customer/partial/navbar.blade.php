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
        <div class="col-12 px-0">
            <div id="header-carousel" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <div class="carousel-item active" style="height: 500px;">
                        <img class="img-fluid w-100 h-100"
                             src="{{ asset('assets/img/banar1.png') }}"
                             style="object-fit: cover;">
                    </div>

                    <div class="carousel-item" style="height: 500px;">
                        <img class="img-fluid w-100 h-100"
                             src="{{ asset('assets/img/banar2.png') }}"
                             style="object-fit: cover;">
                    </div>

                </div>

                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon"></span>
                    </div>
                </a>

                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon"></span>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>