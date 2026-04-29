@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid py-5">
    <div class="row px-xl-5">

        {{-- LEFT: BILLING --}}
        <div class="col-lg-7">

            <div class="card shadow-sm border-0 p-4">
                <h4 class="mb-4">🧾 Billing Details</h4>

                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf

                    {{-- NAME --}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" 
                               name="name" 
                               class="form-control"
                               value="{{ auth()->check() ? auth()->user()->name : '' }}"
                               placeholder="Your Name" required>
                    </div>

                    {{-- PHONE --}}
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" 
                               name="phone" 
                               class="form-control"
                               value="{{ auth()->check() ? auth()->user()->phone : '' }}"
                               placeholder="01XXXXXXXXX" required>
                    </div>

                    {{-- ADDRESS --}}
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" 
                                  class="form-control" rows="3"
                                  placeholder="Full Address (Mention District e.g. Savar, Dhaka)" required>{{ auth()->check() ? auth()->user()->address : '' }}</textarea>
                    </div>

                    {{-- NOTE --}}
                    <div class="form-group">
                        <label>Order Note (optional)</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>

                    {{-- SHIPPING --}}
                    <div class="mt-4">
                        <h5>🚚 Shipping Area</h5>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="inside" name="shipping_area" value="inside" class="custom-control-input shipping-option" checked>
                            <label class="custom-control-label" for="inside">
                                Inside Dhaka (৳ 120)
                            </label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="outside" name="shipping_area" value="outside" class="custom-control-input shipping-option">
                            <label class="custom-control-label" for="outside">
                                Outside Dhaka (৳ 80)
                            </label>
                        </div>
                    </div>

                    {{-- PAYMENT --}}
                    <div class="mt-4">
                        <h5>💳 Payment Method</h5>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="cod" name="payment_method" value="cod" class="custom-control-input" checked>
                            <label class="custom-control-label" for="cod">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button class="btn btn-primary w-100 mt-4 rounded-pill shadow-sm">
                        🛒 Place Order
                    </button>

                </form>
            </div>
        </div>

        {{-- RIGHT: SUMMARY --}}
        <div class="col-lg-5">

            <div class="card shadow-sm border-0 p-4">

                <h4 class="mb-4">🧾 Order Summary</h4>

                @php $subtotal = 0; @endphp

                @foreach($cart as $item)

                    @php
                        $row = $item['price'] * $item['quantity'];
                        $subtotal += $row;
                    @endphp

                    <div class="d-flex justify-content-between mb-2">

                        <div>
                            {{ $item['name'] }}

                            @if($item['color'])
                                <br>
                                <small class="text-muted">Color: {{ $item['color'] }}</small>
                            @endif

                            <br>
                            <small>Qty: {{ $item['quantity'] }}</small>
                        </div>

                        <div>
                            ৳ {{ number_format($row, 0) }}
                        </div>

                    </div>

                    <hr>

                @endforeach

                {{-- TOTALS --}}
                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span id="subtotal" data-value="{{ $subtotal }}">
                        ৳ {{ number_format($subtotal, 0) }}
                    </span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Shipping</span>
                    <span id="shipping">৳ 120</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between font-weight-bold">
                    <span>Total</span>
                    <span id="final-total">৳ {{ number_format($subtotal + 120, 0) }}</span>
                </div>

                <p class="text-muted small mt-2">
                    Shipping charge will be finalized based on your location.
                </p>

            </div>

        </div>

    </div>
</div>


{{-- SCRIPT --}}


@include('customer.partial.footer')

