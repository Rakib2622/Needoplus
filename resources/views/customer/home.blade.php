@include('customer.partial.header')
@include('customer.partial.navbar')




<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<div class="text-center">
        <h2 class="section-title px-5">
            <span class="px-2">Categories</span>
        </h2>
    </div>
<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">

    

        @foreach($homeCategories as $category)

        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">

                {{-- PRODUCT COUNT --}}
                <p class="text-right">
                    {{ $category->products_count }} Products
                </p>

                {{-- IMAGE --}}
                <a href="{{ route('category.show', $category->slug) }}"
                   class="cat-img position-relative overflow-hidden mb-3">

                    @if($category->image)
                        <img class="img-fluid"
                             src="{{ asset('storage/' . $category->image) }}"
                             style="height:200px; width:100%; object-fit:cover;">
                    @else
                        <img class="img-fluid"
                             src="{{ asset('assets/img/default.jpg') }}">
                    @endif

                </a>

                {{-- NAME --}}
                <h5 class="font-weight-semi-bold m-0">
                    {{ $category->name }}
                </h5>

            </div>
        </div>

        @endforeach

    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->

<!-- Offer End -->

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">Trendy Products</span>
        </h2>
    </div>
    
    @include('customer.partial.products')
</div>

@include('customer.partial.review')
@include('customer.partial.footer')