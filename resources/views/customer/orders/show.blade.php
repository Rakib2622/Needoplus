@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid py-5">
    <div class="row px-xl-5">

        <div class="col-12 mb-4">
            <h3>📄 Order Details</h3>
        </div>

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $subtotal = 0; @endphp

                        @foreach($order->items as $item)

                            @php
                                $subtotal += $item->subtotal;

                                $image = null;

                                if($item->product && $item->product->image){
                                    $image = $item->product->image;
                                } elseif($item->package && $item->package->image){
                                    $image = $item->package->image;
                                }
                            @endphp

                            <tr>

                                {{-- PRODUCT --}}
                                <td class="text-left d-flex align-items-center" style="gap:10px;">

                                    <img src="{{ $image ? asset('storage/' . $image) : asset('assets/img/no-image.png') }}"
                                         style="width:60px;height:60px;object-fit:cover;">

                                    <div>

                                        {{ $item->name }}

                                        @if($item->color)
                                            <br>
                                            <small class="text-muted">
                                                Color: {{ $item->color }}
                                            </small>
                                        @endif

                                        @if($item->product_id)
                                            <br><small class="text-primary">Product</small>
                                        @elseif($item->package_id)
                                            <br><small class="text-info">Package</small>
                                        @endif

                                    </div>

                                </td>

                                {{-- PRICE --}}
                                <td>৳ {{ number_format($item->price, 0) }}</td>

                                {{-- QTY --}}
                                <td>{{ $item->quantity }}</td>

                                {{-- SUBTOTAL --}}
                                <td>৳ {{ number_format($item->subtotal, 0) }}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            @php
                $shipping = $order->total_amount - $subtotal;

                $statusColors = [
                    'pending' => 'secondary',
                    'packaging' => 'info',
                    'shipped' => 'primary',
                    'delivered' => 'success',
                    'returned' => 'warning',
                    'declined' => 'danger',
                    'completed' => 'dark',
                ];
            @endphp

            {{-- ORDER INFO --}}
            <div class="border p-4 mb-4">

                <h5 class="mb-3">Order Info</h5>

                <p><strong>Invoice:</strong> #NEEDO100{{ $order->id }}</p>

                <p>
                    <strong>Date:</strong><br>
                    {{ $order->created_at->format('d M Y') }}<br>
                    <small class="text-muted">
                        {{ $order->created_at->format('h:i A') }}
                    </small>
                </p>

                <p>
                    <strong>Status:</strong><br>
                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

            </div>

            {{-- CUSTOMER --}}
            <div class="border p-4 mb-4">

                <h5 class="mb-3">Customer Info</h5>

                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong><br>{{ $order->address }}</p>

            </div>

            {{-- SUMMARY --}}
            <div class="border p-4 mb-4">

                <h5 class="mb-3">Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <strong>৳ {{ number_format($subtotal, 0) }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <strong>৳ {{ number_format($shipping, 0) }}</strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-success">
                        ৳ {{ number_format($order->total_amount, 0) }}
                    </strong>
                </div>

                <p class="mt-2 text-muted small">
                    Payment: {{ strtoupper($order->payment_method) }}
                </p>

            </div>

            {{-- TRACK --}}
            @if($order->tracking_code)
                <a href="https://steadfast.com.bd/tracking?code={{ $order->tracking_code }}"
                   target="_blank"
                   class="btn btn-dark w-100">
                    📦 Track Your Order
                </a>
            @endif

        </div>

    </div>
</div>

@include('customer.partial.footer')