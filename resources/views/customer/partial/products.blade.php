<div class="row px-xl-5 pb-3">

    @forelse($products as $product)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

        <div class="card product-item border-0 mb-4 shadow-sm">


            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">

                <img class="img-fluid w-100"
                    src="{{ $product->image 
                ? asset('storage/' . $product->image) 
                : asset('assets/img/no-image.png') }}"
                    style="height:250px; object-fit:cover;">

                <button class="quick-view-btn"
                    data-id="{{ $product->id }}">
                    👁 Quick View
                </button>


                {{-- 🔴 / 🟢 STOCK BADGE --}}
                @if($product->stock <= 0)
                    <div class="badge-circle badge-stock" style="background:#dc3545;">
                    Out<br>Stock
            </div>
            @else
            <div class="badge-circle badge-stock" style="background:#17a2b8;">
                {{ $product->stock }}<br>Stock
            </div>
            @endif


            {{-- 🟢 DISCOUNT --}}
            @php
            $discount = \App\Models\Discount::getApplicableDiscount($product);
            @endphp

            @if($discount)
            <div class="badge-circle badge-discount" style="background:#28a745;">
                @if($discount->discount_type == 'percent')
                -{{ $discount->value }}%
                @else
                -৳{{ $discount->value }}
                @endif
            </div>
            @endif

        </div>

        {{-- BODY --}}
        <div class="card-body border-left border-right text-center p-3">

            <h6 class="text-truncate mb-2">
                {{ $product->name }}
            </h6>

            <div class="d-flex justify-content-center align-items-center">

                @if($product->final_price < $product->price)

                    <h6 class="text-danger mb-0">
                        ৳ {{ $product->final_price }}
                    </h6>

                    <h6 class="text-muted ml-2 mb-0">
                        <del>৳ {{ $product->price }}</del>
                    </h6>

                    @else

                    <h6 class="mb-0">
                        ৳ {{ $product->price }}
                    </h6>

                    @endif

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-light border">

            {{-- VIEW DETAILS --}}
            <a href="{{ route('product.show', $product->slug) }}"
                class="btn btn-sm text-dark p-0">
                <i class="fas fa-eye text-primary mr-1"></i>
                View
            </a>

            {{-- ADD TO CART --}}
            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                @csrf

                <input type="hidden" name="type" value="product">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">

                <button type="submit"
                    class="btn btn-sm p-0 {{ $product->stock <= 0 ? 'text-muted' : 'text-dark' }}"
                    {{ $product->stock <= 0 ? 'disabled' : '' }}>

                    <i class="fas fa-shopping-cart text-primary mr-1"></i>
                    Add to Cart
                </button>
            </form>

        </div>

    </div>

</div>

@empty
<div class="col-12 text-center">
    <p>No products found</p>
</div>
@endforelse

</div>
</div>
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content quickview-modal">

            <div class="modal-body p-4">

                {{-- LOADER --}}
                <div id="qv-loading" class="text-center py-5">
                    <i class="fa fa-spinner fa-spin fa-2x"></i>
                </div>

                {{-- CONTENT --}}
                <div id="qv-content" style="display:none;">

                    <div class="row">

                        {{-- LEFT IMAGE --}}
                        <div class="col-lg-5">

                            <div class="qv-image-box">
                                <img id="qv-image"
                                    class="img-fluid w-100"
                                    style="height:350px; object-fit:cover;">
                            </div>

                        </div>

                        {{-- RIGHT DETAILS (YOUR FULL UI HERE) --}}
                        <div class="col-lg-7">

                            <h4 id="qv-name" class="mb-2 mt-3"></h4>

                            {{-- PRICE --}}
                            <div class="mb-2" id="qv-price"></div>

                            {{-- STOCK --}}
                            <p id="qv-stock"></p>

                            {{-- COLORS --}}
                            <div id="qv-colors" class="mb-3"></div>

                            {{-- QTY + ADD TO CART --}}
                            <div class="d-flex align-items-center mb-3" style="gap:10px;">

                                <div class="input-group" style="width:130px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-light border qv-minus">-</button>
                                    </div>

                                    <input type="text" id="qv-qty" value="1" class="form-control text-center">

                                    <div class="input-group-append">
                                        <button class="btn btn-light border qv-plus">+</button>
                                    </div>
                                </div>

                                <form id="qv-cart-form"
                                    action="{{ route('cart.add') }}"
                                    method="POST"
                                    class="add-to-cart-form flex-grow-1">

                                    @csrf

                                    <input type="hidden" name="type" value="product">
                                    <input type="hidden" name="product_id" id="qv-product-id">
                                    <input type="hidden" name="quantity" id="qv-cart-qty" value="1">
                                    <input type="hidden" name="color" id="qv-cart-color">

                                    <button type="submit" class="btn btn-info w-100 rounded-pill shadow-sm">
                                        <i class="fa fa-shopping-bag mr-2"></i>
                                        Add to Cart
                                    </button>
                                </form>

                            </div>

                            {{-- TOTAL --}}
                            <div class="mb-3">
                                <strong>Total:</strong>
                                <h5 class="text-primary">৳ <span id="qv-total"></span></h5>
                            </div>

                            {{-- ORDER + WHATSAPP --}}
                            <div class="d-flex" style="gap:10px; flex-wrap:wrap;">

                                {{-- ORDER NOW --}}
                                <button class="btn w-100 rounded-pill text-white order-btn">
                                    <i class="fa fa-bolt mr-1"></i> Order Now
                                </button>

                                {{-- WHATSAPP --}}
                                <a id="qv-whatsapp"
                                    target="_blank"
                                    class="btn w-100 rounded-pill text-white whatsapp-btn">
                                    <i class="fab fa-whatsapp mr-1"></i> Order to WhatsApp
                                </a>

                                {{-- 🔵 VIEW DETAILS --}}
                                <a id="qv-details"
                                    class="btn w-100 rounded-pill btn-outline-primary">
                                    <i class="fa fa-eye mr-1"></i> View Details
                                </a>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


<!-- Products End -->