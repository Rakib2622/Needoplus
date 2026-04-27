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
        <div class="col-lg-3 col-md-12">

            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <p class="text-muted small">Coming soon...</p>
            </div>

        </div>
        <!-- Sidebar End -->


        <!-- Products Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">

                <!-- Search + Sort -->
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

                {{-- PRODUCT LOOP --}}
                @forelse($products as $product)

                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">

                        {{-- IMAGE --}}
                        @php
                            $img = $product->image ?? ($product->images[0] ?? null);
                        @endphp

                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">

                            {{-- Discount Badge --}}
                            @if($product->final_price < $product->price)
                                <span class="badge badge-danger position-absolute m-2">
                                    {{ $product->discount_percent }}% OFF
                                </span>
                            @endif

                            @if($img)
                                <img class="img-fluid w-100"
                                     src="{{ asset('storage/' . $img) }}"
                                     style="height:250px; object-fit:cover;">
                            @else
                                <div class="text-center p-5">No Image</div>
                            @endif

                        </div>

                        {{-- BODY --}}
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">

                            <h6 class="text-truncate mb-2">
                                {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                            </h6>

                            {{-- COLORS --}}
                            @if($product->colors)
                                <div class="mb-2">
                                    @foreach($product->colors as $color)
                                        <span title="{{ $color }}"
                                              style="display:inline-block;width:15px;height:15px;border-radius:50%;background:{{ $color }};border:1px solid #ccc;">
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- PRICE --}}
                            <div class="d-flex justify-content-center">

                                @if($product->final_price < $product->price)

                                    <h6>৳ {{ $product->final_price }}</h6>
                                    <h6 class="text-muted ml-2">
                                        <del>৳ {{ $product->price }}</del>
                                    </h6>

                                @else
                                    <h6>৳ {{ $product->price }}</h6>
                                @endif

                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="card-footer d-flex justify-content-between bg-light border">

                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>View Detail
                            </a>

                            <a href="#" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                            </a>

                        </div>

                    </div>
                </div>

                @empty

                <div class="col-12 text-center text-muted py-5">
                    No products found in this category
                </div>

                @endforelse


                {{-- PAGINATION --}}
                <div class="col-12 pb-1">
                    <nav>
                        {{ $products->links() }}
                    </nav>
                </div>

            </div>
        </div>
        <!-- Products End -->

    </div>
</div>
<!-- Shop End -->

@include('customer.partial.footer')