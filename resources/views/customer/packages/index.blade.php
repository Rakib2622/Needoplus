@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header -->
<!-- <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Packages</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Packages</p>
        </div>
    </div>
</div> -->

<!-- Packages Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">

        @forelse($packages as $package)

        <div class="col-lg-3 col-md-6 col-sm-12 pb-4">

            <div class="card border-0 shadow-sm h-100 package-card">

                {{-- HEADER (NAME AS VISUAL) --}}
                <div class="package-header text-white text-center p-4">

                    <h5 class="mb-0 font-weight-bold">
                        {{ $package->name }}
                    </h5>

                    <small>
                        {{ $package->products->count() }} items included
                    </small>

                </div>

                {{-- BODY --}}
                <div class="card-body text-center">

                    {{-- PRICE --}}
                    <h4 class="text-danger mb-1">
                        ৳ {{ number_format($package->final_price, 0) }}
                    </h4>

                    <small class="text-muted">
                        <del>৳ {{ number_format($package->total_product_price, 0) }}</del>
                    </small>

                    <div class="mt-2">
                        <span class="badge badge-success">
                            Save ৳ {{ number_format($package->total_product_price - $package->final_price, 0) }}
                        </span>
                    </div>

                    {{-- PRODUCT LIST PREVIEW --}}
                    <ul class="list-unstyled mt-3 text-left small">

                        @foreach($package->products->take(3) as $product)
                        <li>✔ {{ $product->name }}</li>
                        @endforeach

                        @if($package->products->count() > 3)
                        <li class="text-muted">+ more items</li>
                        @endif

                    </ul>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-white border-0 text-center">

                    <a href="{{ route('packages.show', $package->id) }}"
                        class="btn btn-outline-primary btn-sm rounded-pill mb-2 w-100">
                        View
                    </a>

                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                        @csrf

                        <input type="hidden" name="type" value="package">
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button class="btn btn-primary btn-sm rounded-pill w-100">
                            Add to Cart
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @empty
        <div class="col-12 text-center">
            <p>No packages available</p>
        </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="row px-xl-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $packages->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
<!-- Packages End -->

@include('customer.partial.footer')