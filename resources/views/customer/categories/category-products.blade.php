@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">
            {{ $category->name }}
        </h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">{{ $category->name }}</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Sidebar (static for now) -->
        
        <!-- Sidebar End -->


        <!-- Products Start -->
        <div class="col-md-12">

            {{-- SEARCH + SORT --}}
            <div class="col-12 pb-1">
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name"
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="dropdown ml-4">
                        <button class="btn border dropdown-toggle" data-toggle="dropdown">
                            Sort by
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="?sort=latest">Latest</a>
                            <a class="dropdown-item" href="?sort=low">Price Low</a>
                            <a class="dropdown-item" href="?sort=high">Price High</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 🔥 PRODUCT GRID --}}
            @include('customer.partial.products', ['products' => $products])

            {{-- PAGINATION --}}
            <div class="col-12 mt-4">
                {{ $products->links() }}
            </div>

        </div>
        <!-- Products End -->

    </div>
</div>
<!-- Shop End -->

@include('customer.partial.footer')