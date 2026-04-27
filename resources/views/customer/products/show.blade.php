@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- Page Header -->
<!-- <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $product->name }}</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">{{ $product->category->name ?? 'Product' }}</p>
        </div>
    </div>
</div> -->

<!-- PRODUCT DETAIL -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">

        {{-- IMAGE CAROUSEL --}}
        <div class="col-lg-5 pb-5">

            @php
            $images = [];
            if($product->image) $images[] = $product->image;
            if($product->images) $images = array_merge($images, $product->images);
            @endphp

            {{-- MAIN IMAGE --}}
            <div class="position-relative border" style="overflow:hidden;">

                <img id="mainImage"
                    src="{{ asset('storage/' . ($images[0] ?? '')) }}"
                    class="w-100 zoom-image"
                    style="height:400px; object-fit:cover; cursor:zoom-in;">

            </div>

            {{-- 🔍 THUMBNAILS --}}
            @if(count($images) > 1)
            <div class="d-flex mt-3" style="gap:10px; overflow-x:auto;">

                @foreach($images as $key => $img)
                <img src="{{ asset('storage/' . $img) }}"
                    class="thumb-img {{ $key == 0 ? 'active-thumb' : '' }}"
                    onclick="changeImage('{{ asset('storage/' . $img) }}', this)"
                    style="width:70px;height:70px;object-fit:cover;cursor:pointer;
                        border:2px solid #ddd;border-radius:5px;">
                @endforeach

            </div>
            @endif

        </div>
        {{-- DETAILS --}}
        <div class="col-lg-7 pb-5">

            <h3 class="font-weight-semi-bold mb-3">{{ $product->name }}</h3>

            {{-- PRICE --}}
            <div class="mb-3">
                @if($product->final_price < $product->price)

                    <h4 class="text-danger d-inline">
                        ৳ <span id="unit-price">{{ $product->final_price }}</span>
                    </h4>

                    <small class="text-muted ml-2">
                        <del>৳ {{ $product->price }}</del>
                    </small>

                    <span class="badge badge-danger ml-2">
                        -{{ $product->discount_percent }}%
                    </span>

                    @else
                    <h4>৳ <span id="unit-price">{{ $product->price }}</span></h4>
                    @endif
            </div>

            {{-- STOCK --}}
            <p>
                <strong>Status:</strong>
                <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </p>

            {{-- COLORS --}}
            @if($product->colors)
            <div class="mb-3">
                <strong>Colors:</strong>

                <div class="d-flex mt-2" style="gap:8px;">
                    @foreach($product->colors as $color)
                    <span class="color-circle"
                        data-color="{{ $color }}"
                        style="width:28px;height:28px;border-radius:50%;
                             background:{{ $color }};
                             border:2px solid #ddd;
                             cursor:pointer;">
                    </span>
                    @endforeach
                </div>

                <small id="selected-color" class="text-muted"></small>
            </div>
            @endif

            {{-- QUANTITY + ADD TO CART INLINE --}}
            <div class="d-flex align-items-center mb-3" style="gap:10px;">

                <div class="input-group" style="width:130px;">
                    <div class="input-group-prepend">
                        <button class="btn btn-light border" id="minus">-</button>
                    </div>

                    <input type="text" id="qty" value="1" class="form-control text-center">

                    <div class="input-group-append">
                        <button class="btn btn-light border" id="plus">+</button>
                    </div>
                </div>

                {{-- ADD TO CART --}}
                <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="cart-qty" value="1">
                    <input type="hidden" name="color" id="cart-color">

                    <button class="btn btn-primary w-100 rounded-pill shadow-sm text-white"
                        {{ $product->stock > 0 ? '' : 'disabled' }}>
                        <i class="fa fa-shopping-bag mr-2"></i> Add to Cart
                    </button>
                </form>

            </div>

            {{-- TOTAL --}}
            <div class="mb-3">
                <strong>Total:</strong>
                <h4 class="text-primary">
                    ৳ <span id="total-price">{{ $product->final_price ?? $product->price }}</span>
                </h4>
            </div>

            {{-- ORDER + WHATSAPP IN ONE LINE --}}
            <div class="d-flex" style="gap:10px;">

                {{-- ORDER NOW --}}
                <form action="{{ route('checkout.index') }}" method="GET" class="w-50">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="order-qty" value="1">

                    <button class="btn w-100 rounded-pill text-white order-btn">
                        <i class="fa fa-bolt mr-1"></i> Order Now
                    </button>
                </form>

                {{-- WHATSAPP --}}
                <a href="https://wa.me/8801886699757?text=I%20want%20to%20order%20{{ urlencode($product->name) }}"
                    target="_blank"
                    class="btn w-50 rounded-pill text-white whatsapp-btn">
                    <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                </a>

            </div>

            {{-- POLICIES --}}
            <div class="mt-4">
                <a href="{{ route('settings.return') }}" class="text-primary mr-3">
                    🔁 Return Policy
                </a>

                <a href="{{ route('settings.warranty') }}" class="text-primary">
                    🛡 Warranty
                </a>
            </div>

        </div>
    </div>

    {{-- DESCRIPTION TAB --}}
    <div class="row px-xl-5 mt-5">
        <div class="col">

            {{-- TABS --}}
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active tab-btn" data-target="description">Description</a>
                <a class="nav-item nav-link tab-btn" data-target="reviews">Reviews (12)</a>
            </div>

            {{-- DESCRIPTION --}}
            <div class="tab-content-box" id="description">
                <h5 class="mb-3">Product Description</h5>

                <div class="p-3 border rounded bg-light" style="line-height:1.7;">
                    {!! $product->description ?? 'No description available' !!}
                </div>
            </div>

            
            {{-- REVIEWS --}}
<div class="tab-content-box d-none" id="reviews">

    <h5 class="mb-3">Customer Reviews ⭐ 4.7</h5>

    {{-- ✅ ADD THIS WRAPPER --}}
    <div id="review-list">

        <div class="review-item mb-3">
            <strong>রাকিব হাসান</strong>
            <div class="text-warning">★★★★★</div>
            <p>এই প্রোডাক্টটা সত্যিই অনেক ভালো...</p>
        </div>

        <div class="review-item mb-3">
            <strong>মেহেদী রহমান</strong>
            <div class="text-warning">★★★★★</div>
            <p>honestly bolte gele product ta expected er cheye better...</p>
        </div>

        <div class="review-item mb-3">
            <strong>সাব্বির আহমেদ</strong>
            <div class="text-warning">★★★★☆</div>
            <p>overall valo. finishing ektu improve hole perfect hoto...</p>
        </div>

        <div class="review-item mb-3">
            <strong>Farhan Sakib</strong>
            <div class="text-warning">★★★★★</div>
            <p>Really impressed with the product quality...</p>
        </div>

        <div class="review-item mb-3">
            <strong>Sarah Ahmed</strong>
            <div class="text-warning">★★★★☆</div>
            <p>Good product overall...</p>
        </div>

        <div class="review-item mb-3">
            <strong>আরিফুল ইসলাম</strong>
            <div class="text-warning">★★★★★</div>
            <p>প্রোডাক্টটা ব্যবহার করে অনেক ভালো লেগেছে...</p>
        </div>

        <div class="review-item mb-3">
            <strong>তানজিম হোসেন</strong>
            <div class="text-warning">★★★★☆</div>
            <p>মোটামুটি ভালো প্রোডাক্ট...</p>
        </div>

        <div class="review-item mb-3">
            <strong>Rafi Hasan</strong>
            <div class="text-warning">★★★★★</div>
            <p>product ta use kore khub bhalo lagse...</p>
        </div>

        <div class="review-item mb-3">
            <strong>Mehedi_X</strong>
            <div class="text-warning">★★★★★</div>
            <p>honestly bolte gele product ta khub e useful...</p>
        </div>

        <div class="review-item mb-3">
            <strong>Nusrat Jahan</strong>
            <div class="text-warning">★★★★☆</div>
            <p>product ta valo but delivery ektu late chilo...</p>
        </div>

        <div class="review-item mb-3">
            <strong>ফারহান কবির</strong>
            <div class="text-warning">★★★★★</div>
            <p>এক কথায় অসাধারণ...</p>
        </div>

    </div>

</div>

        </div>
    </div>
</div>

{{-- RELATED PRODUCTS --}}
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">You May Also Like</span>
        </h2>
    </div>

    <div class="row px-xl-5">

        @foreach($relatedProducts as $item)

        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="card product-item border-0">

                <div class="card-header p-0">
                    @php
                    $img = $item->image ?? ($item->images[0] ?? null);
                    @endphp

                    @if($img)
                    <img src="{{ asset('storage/' . $img) }}"
                        class="img-fluid w-100"
                        style="height:200px; object-fit:cover;">
                    @endif
                </div>

                <div class="card-body text-center p-2">
                    <h6 class="text-truncate">
                        {{ \Illuminate\Support\Str::limit($item->name, 30) }}
                    </h6>

                    <h6>৳ {{ $item->final_price }}</h6>
                </div>

                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-sm text-dark p-0">
                        <i class="fas fa-eye text-primary mr-1"></i>View
                    </a>
                </div>

            </div>
        </div>

        @endforeach

    </div>
</div>

<script>
    function changeImage(src, el) {
        document.getElementById('mainImage').src = src;

        // active thumb
        document.querySelectorAll('.thumb-img').forEach(img => {
            img.classList.remove('active-thumb');
        });
        el.classList.add('active-thumb');
    }

    /* 🔍 ZOOM EFFECT */
    const img = document.getElementById('mainImage');

    img.addEventListener('mousemove', function(e) {
        const rect = img.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = "scale(2)";
    });

    img.addEventListener('mouseleave', function() {
        img.style.transform = "scale(1)";
    });

    /* 🔥 CLICK → FULL PREVIEW */
    img.addEventListener('click', function() {
        document.getElementById('previewImage').src = this.src;
        $('#imageModal').modal('show');
    });
</script>

<script>
    let qty = 1;
    let price = parseFloat(document.getElementById('unit-price').innerText);

    function updateTotal() {
        document.getElementById('total-price').innerText = (qty * price).toFixed(2);
        document.getElementById('cart-qty').value = qty;
        document.getElementById('order-qty').value = qty;
        document.getElementById('qty').value = qty;
    }

    document.getElementById('plus').onclick = () => {
        qty++;
        updateTotal();
    };
    document.getElementById('minus').onclick = () => {
        if (qty > 1) qty--;
        updateTotal();
    };

    // COLOR SELECT
    document.querySelectorAll('.color-circle').forEach(el => {
        el.addEventListener('click', function() {

            document.querySelectorAll('.color-circle').forEach(c => c.style.border = '2px solid #ddd');

            this.style.border = '2px solid black';

            let color = this.dataset.color;

            document.getElementById('selected-color').innerText = "Selected: " + color;
            document.getElementById('color-input').value = color;
            document.getElementById('cart-color').value = color;
        });
    });
</script>

<script>
    const tabs = document.querySelectorAll('.tab-btn');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {

            // ACTIVE TAB STYLE
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            let target = this.dataset.target;

            // HIDE ALL
            document.querySelectorAll('.tab-content-box').forEach(box => {
                box.classList.add('d-none');
            });

            // SHOW BASED ON TAB
            if (target === 'description') {
                document.getElementById('description').classList.remove('d-none');
                document.getElementById('description-right').classList.remove('d-none');
            }

            if (target === 'reviews') {
                document.getElementById('reviews').classList.remove('d-none');
                document.getElementById('reviews-left').classList.remove('d-none');
            }

        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const container = document.getElementById("review-list");

    if (!container) return;

    let reviews = Array.from(container.querySelectorAll(".review-item"));

    // 🔀 Shuffle
    for (let i = reviews.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [reviews[i], reviews[j]] = [reviews[j], reviews[i]];
    }

    // 🧹 Clear + show only 4 (change if needed)
    container.innerHTML = "";

    reviews.slice(0, 10).forEach(el => {
        container.appendChild(el);
    });

});
</script>



@include('customer.partial.footer')