@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid py-5">
    <div class="row px-xl-5">

        <div class="col-12">
            <h3 class="mb-4">🛒 Your Cart</h3>
        </div>

        @php
        $cart = session('cart', []);
        $total = 0;
        @endphp

        @if(count($cart) > 0)

        <div class="col-lg-8">

            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($cart as $key => $item)

                        @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;

                        $product = null;
                        if($item['type'] == 'product'){
                        $product = \App\Models\Product::find($item['id']);
                        }
                        @endphp

                        <tr>

                            {{-- PRODUCT --}}
                            <td class="text-left d-flex align-items-center" style="gap:10px;">

                                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/no-image.png') }}"
                                    style="width:60px;height:60px;object-fit:cover;">

                                <div>

                                    {{ $item['name'] }}

                                    @if($item['type'] == 'package')
                                    <br><small class="text-info">Package</small>
                                    @endif

                                    {{-- COLOR SELECT --}}
                                    @if($product && $product->colors)

                                    <div class="mt-1">
                                        <select class="form-control form-control-sm color-select"
                                            data-key="{{ $key }}">

                                            <option value="">Select Color</option>

                                            @foreach($product->colors as $color)
                                            <option value="{{ $color }}"
                                                {{ $item['color'] == $color ? 'selected' : '' }}>
                                                {{ ucfirst($color) }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    @elseif($item['color'])
                                    <br><small>Color: {{ $item['color'] }}</small>
                                    @endif

                                </div>

                            </td>

                            {{-- PRICE --}}
                            <td>৳ {{ number_format($item['price'], 0) }}</td>

                            {{-- QUANTITY --}}
                            <td class="align-middle">

                                @php
                                $stock = null;

                                if ($item['type'] === 'product') {
                                $product = \App\Models\Product::find($item['id']);
                                $stock = $product ? $product->stock : 0;
                                }
                                @endphp

                                <div class="input-group quantity mx-auto" style="width: 110px;">

                                    <!-- ➖ MINUS -->
                                    <div class="input-group-btn">
                                        <button type="button"
                                            class="btn btn-sm btn-primary btn-minus"
                                            data-key="{{ $key }}">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                    <!-- 🔢 INPUT -->
                                    <input type="number"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        max="{{ $stock ?? 999 }}"
                                        class="form-control form-control-sm bg-secondary text-center qty-input"
                                        data-key="{{ $key }}">

                                    <!-- ➕ PLUS -->
                                    <div class="input-group-btn">
                                        <button type="button"
                                            class="btn btn-sm btn-primary btn-plus"
                                            data-key="{{ $key }}"
                                            {{ ($stock !== null && $item['quantity'] >= $stock) ? 'disabled' : '' }}>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                </div>

                                <!-- ⚠️ STOCK WARNING -->
                                @if($stock !== null && $item['quantity'] >= $stock)
                                <small class="text-danger d-block text-center mt-1">
                                    Max stock reached
                                </small>
                                @endif

                            </td>

                            {{-- SUBTOTAL --}}
                            <td>৳ {{ $subtotal }}</td>

                            {{-- REMOVE --}}
                            <td>
                                <button type="button"
                                    class="btn btn-danger btn-sm remove-btn"
                                    data-key="{{ $key }}">
                                    ✖
                                </button>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            <div class="border p-4">

                <h5 class="mb-3">Cart Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Total</span>
                    <strong>৳ {{ $total }}</strong>
                </div>

                <p class="text-muted small mb-2">
                    🚚 Shipping charge will be added at checkout
                </p>

                <a href="{{ route('checkout.index') }}"
                    class="btn btn-success w-100 mt-3">
                    Proceed to Checkout
                </a>

            </div>

        </div>

        @else

        <div class="col-12 text-center py-5">
            <h5>Your cart is empty</h5>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                Continue Shopping
            </a>
        </div>

        @endif

    </div>
</div>

@include('customer.partial.footer')