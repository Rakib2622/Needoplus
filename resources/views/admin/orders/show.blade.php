@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📄 Order Details</h3>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
    <div class="alert alert-success shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    @php
    // ✅ CALCULATIONS
    $subtotal = $order->items->sum('subtotal');

    $shipping = $order->total_amount - $subtotal;

    if ($shipping < 0) {
        $shipping=0;
        }
        @endphp

        <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            {{-- 🧾 ITEMS --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <strong>🧾 Order Items</strong>
                </div>

                <div class="card-body p-0">

                    <div style="overflow-x:auto;">
                        <table class="table table-hover align-middle mb-0">

                            <thead style="background:#f8f9fa;">
                                <tr>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($order->items as $item)

                                @php
                                $image = null;

                                if ($item->product && $item->product->image) {
                                $image = asset($item->product->image);
                                } elseif ($item->package && $item->package->image) {
                                $image = asset($item->package->image);
                                }
                                @endphp

                                <tr>

                                    {{-- IMAGE --}}
                                    @php
                                    $image = null;

                                    if ($item->product) {
                                    $mainImage = $item->product->image;
                                    $galleryImage = $item->product->images[0] ?? null;

                                    if ($mainImage) {
                                    $image = asset('storage/' . $mainImage);
                                    } elseif ($galleryImage) {
                                    $image = asset('storage/' . $galleryImage);
                                    }
                                    }

                                    if (!$image && $item->package) {
                                    if ($item->package->image) {
                                    $image = asset('storage/' . $item->package->image);
                                    }
                                    }
                                    @endphp

                                    <td style="width:70px;">
                                        @if($image)
                                        <img src="{{ $image }}"
                                            style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                        @else
                                        <div style="
            width:60px;
            height:60px;
            background:#f1f1f1;
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:12px;
            color:#888;">
                                            No Image
                                        </div>
                                        @endif
                                    </td>

                                    {{-- ITEM --}}
                                    <td>
                                        <strong>{{ $item->name }}</strong>

                                        @if($item->color)
                                        <div>
                                            <small class="text-muted">Color: {{ $item->color }}</small>
                                        </div>
                                        @endif
                                    </td>

                                    {{-- TYPE --}}
                                    <td>
                                        @if($item->product_id)
                                        <span>Product</span>
                                        @elseif($item->package_id)
                                        <span>Package</span>
                                        @endif
                                    </td>

                                    {{-- PRICE --}}
                                    <td>৳ {{ number_format($item->price, 2) }}</td>

                                    {{-- QTY --}}
                                    <td>{{ $item->quantity }}</td>

                                    {{-- SUBTOTAL --}}
                                    <td class="fw-bold">
                                        ৳ {{ number_format($item->subtotal, 2) }}
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            {{-- 👤 CUSTOMER INFO --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <strong>👤 Customer Info</strong>
                </div>

                <div class="card-body">

                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Address:</strong><br>{{ $order->address }}</p>

                    @if($order->note)
                    <p><strong>Note:</strong><br>{{ $order->note }}</p>
                    @endif

                </div>
            </div>

            {{-- 💳 SUMMARY --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <strong>💳 Summary</strong>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Subtotal:</strong>
                        <span class="float-end">৳ {{ number_format($subtotal, 2) }}</span>
                    </p>

                    <p>
                        <strong>Shipping:</strong>
                        <span class="float-end">
                            ৳ {{ number_format($shipping, 2) }}
                        </span>
                    </p>

                    <hr>

                    <h5>
                        <strong>Total:</strong>
                        <span class="float-end text-success">
                            ৳ {{ number_format($order->total_amount, 2) }}
                        </span>
                    </h5>

                    <hr>

                    <p>
                        <strong>Payment:</strong>
                        <span class="float-end text-muted">
                            {{ strtoupper($order->payment_method) }}
                        </span>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="float-end">

                            @php
                            $statusColors = [
                            'pending' => '#6c757d',
                            'packaging' => '#17a2b8',
                            'shipped' => '#007bff',
                            'delivered' => '#28a745',
                            'returned' => '#ffc107',
                            'declined' => '#dc3545',
                            'completed' => '#343a40',
                            ];
                            @endphp

                            <span style="
                                padding:5px 10px;
                                border-radius:6px;
                                color:#fff;
                                background: {{ $statusColors[$order->status] ?? '#6c757d' }};
                                font-size:12px;
                            ">
                                {{ ucfirst($order->status) }}
                            </span>

                        </span>
                    </p>

                    <hr>

                    {{-- STATUS UPDATE --}}
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf

                        <label class="mb-1"><strong>Update Status</strong></label>

                        <select name="status"
                            onchange="this.form.submit()"
                            class="form-control text-white fw-bold"
                            style="
                                background: {{ $statusColors[$order->status] ?? '#6c757d' }};
                                border:none;
                                border-radius:8px;
                            ">

                            @foreach($statusColors as $status => $color)
                            <option value="{{ $status }}"
                                {{ $order->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach

                        </select>
                    </form>

                </div>
            </div>

            {{-- 🕒 TIME --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <strong>🕒 Order Time</strong>
                </div>

                <div class="card-body text-center">
                    <h5>{{ $order->created_at->format('d M Y') }}</h5>
                    <p class="text-muted mb-0">
                        {{ $order->created_at->format('h:i A') }}
                    </p>
                </div>
            </div>

        </div>

</div>

</div>

@include('admin.partials.footer')