@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>

<!-- Shop Start -->
<div class="container-fluid pt-5">

    <!-- SORT BAR -->
    <div class="row px-xl-5 mb-4">
        <div class="col-12 d-flex justify-content-end">

            <div class="dropdown">
                <button class="btn border dropdown-toggle" data-toggle="dropdown">
                    Sort By
                </button>

                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="?sort=latest">
                        Latest
                    </a>

                    <a class="dropdown-item" href="?sort=low">
                        Price: Low → High
                    </a>

                    <a class="dropdown-item" href="?sort=high">
                        Price: High → Low
                    </a>

                    <a class="dropdown-item" href="?sort=discount">
                        Discount Available
                    </a>

                    <a class="dropdown-item" href="?sort=popular">
                        Popular (Coming Soon)
                    </a>

                </div>
            </div>

        </div>
    </div>

    <!-- ✅ REUSE YOUR PRODUCT CARD -->
    @include('customer.partial.products', ['products' => $products])

    <!-- PAGINATION -->
    <div class="row px-xl-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

</div>
<!-- Shop End -->

@include('customer.partial.footer')