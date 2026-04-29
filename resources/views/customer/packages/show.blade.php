@include('customer.partial.header')
@include('customer.partial.navonly')

<!-- HEADER -->
<div class="container-fluid bg-light mb-4 py-4 text-center">
    <h2 class="font-weight-bold">{{ $package->name }}</h2>
    <small class="text-muted">{{ $package->products->count() }} products included</small>
</div>

<div class="container-fluid py-4">
    <div class="row px-xl-5">

        {{-- ================= LEFT: PRODUCTS ================= --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm p-3 mb-4">
                <h5 class="mb-3">📦 Package Includes</h5>

                <div>

                    @foreach($package->products as $product)

                    @php
                    $img = $product->image ?? ($product->images[0] ?? null);
                    @endphp

                    <div class="d-flex align-items-center justify-content-between border rounded px-3 py-2 mb-2">

                        {{-- LEFT: IMAGE + NAME --}}
                        <div class="d-flex align-items-center" style="gap:12px;">

                            <img src="{{ $img ? asset('storage/'.$img) : asset('assets/img/no-image.png') }}"
                                style="width:60px;height:60px;object-fit:cover;border-radius:6px;">

                            <div>
                                <h6 class="mb-1">{{ $product->name }}</h6>

                                <small class="text-muted">
                                    Qty: {{ $product->pivot->quantity }}
                                </small>
                            </div>

                        </div>

                        {{-- RIGHT: PRICE --}}
                        <div class="text-right">

                            <div class="small text-muted">
                                <del>৳ {{ number_format($product->price, 0) }}</del>
                            </div>

                            <div class="text-danger font-weight-bold">
                                ৳ {{ number_format($product->final_price, 0) }}
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>
            </div>

        </div>

        {{-- ================= RIGHT: PRICE + ACTION ================= --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-lg p-4 sticky-top" style="top:20px;">

                {{-- PRICE --}}
                <h4 class="text-danger mb-1">
                    ৳ {{ number_format($package->final_price, 0) }}
                </h4>

                <small class="text-muted">
                    <del>৳ {{ number_format($package->total_product_price, 0) }}</del>
                </small>

                <div class="mt-2">
                    <span class="badge badge-success">
                        Save ৳ {{ number_format($package->total_product_price - $package->final_price,0) }}
                    </span>
                </div>

                <hr>

                {{-- BREAKDOWN --}}
                <h6 class="mb-2">📊 Price Breakdown</h6>

                @php
                $originalTotal = 0;
                $productDiscountTotal = 0;
                @endphp

                @foreach($package->products as $product)

                @php
                $original = $product->price * $product->pivot->quantity;
                $final = $product->final_price * $product->pivot->quantity;

                $originalTotal += $original;
                $productDiscountTotal += ($original - $final);
                @endphp

                <div class="d-flex justify-content-between small">
                    <span>{{ $product->name }}</span>
                    <span>৳ {{ number_format($original,0) }}</span>
                </div>

                @endforeach

                <hr>

                <div class="d-flex justify-content-between small">
                    <span>Original</span>
                    <span>৳ {{ number_format($originalTotal,0) }}</span>
                </div>

                <div class="d-flex justify-content-between small text-info">
                    <span>Product Discount</span>
                    <span>-৳ {{ number_format($productDiscountTotal,0) }}</span>
                </div>

                <div class="d-flex justify-content-between small text-success">
                    <span>Bundle Discount</span>
                    <span>-৳ {{ number_format($package->total_product_price - $package->final_price,0) }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between font-weight-bold">
                    <span>Total</span>
                    <span>৳ {{ number_format($package->final_price,0) }}</span>
                </div>

                <hr>

                {{-- CTA BUTTONS --}}
                <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                    @csrf
                    <input type="hidden" name="type" value="package">
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="quantity" value="1">

                    <button class="btn btn-primary w-100 rounded-pill">
                        🛒 Add to Cart
                    </button>
                </form>

                <a href="{{ route('checkout.index') }}"
                    class="btn btn-dark w-100 rounded-pill mb-2">
                    ⚡ Order Now
                </a>

                <a href="https://wa.me/8801886699757?text=I%20want%20this%20package:%20{{ urlencode($package->name) }}"
                    target="_blank"
                    class="btn btn-success w-100 rounded-pill">
                    📲 WhatsApp Order
                </a>

                <small class="text-muted d-block mt-2 text-center">
                    🚚 Delivery charge added at checkout
                </small>

            </div>

        </div>

    </div>
</div>

@include('customer.partial.footer')