@include('customer.partial.header')


<div class="container py-5">

    <div class="card shadow-sm p-4" id="invoice-area">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between mb-4">
            <div>
                <h4 class="mb-0">🧾 Invoice</h4>
                <small>Order #{{ $order->id }}</small>
            </div>
            <div class="text-right">
                <h5 class="mb-0">NeedoPlus</h5>
                <small>Dhaka, Bangladesh</small>
            </div>
        </div>

        <hr>

        {{-- CUSTOMER INFO --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Customer Info</h6>
                <p class="mb-1"><strong>Name:</strong> {{ $order->name }}</p>
                <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
            </div>

            <div class="col-md-6 text-md-right">
                <h6>Order Info</h6>
                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p class="mb-1">
                    <strong>Status:</strong>
                    <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
                </p>
                <p class="mb-1"><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
            </div>
        </div>

        {{-- ITEMS TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center">

                <thead class="bg-light">
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @php 
                        $subtotal = 0; 
                    @endphp

                    @foreach($order->items as $item)

                        @php 
                            $rowTotal = $item->price * $item->quantity;
                            $subtotal += $rowTotal;
                        @endphp

                        <tr>
                            <td class="text-left">
                                {{ $item->name }}

                                @if($item->color)
                                    <br><small class="text-muted">Color: {{ $item->color }}</small>
                                @endif
                            </td>

                            <td>
                                {{ $item->product_id ? 'Product' : 'Package' }}
                            </td>

                            <td>৳ {{ number_format($item->price, 0) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>৳ {{ number_format($rowTotal, 0) }}</td>
                        </tr>

                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- TOTALS --}}
        <div class="row justify-content-end">
            <div class="col-md-4">

                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>৳ {{ number_format($subtotal, 0) }}</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Shipping</span>
                    <span>৳ {{ number_format($order->shipping_charge ?? 0, 0) }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between font-weight-bold">
                    <span>Total</span>
                    <span>৳ {{ number_format($order->total_amount, 0) }}</span>
                </div>

            </div>
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="text-center mt-4">

        <button onclick="downloadInvoice()" class="btn btn-dark rounded-pill">
            ⬇ Download Invoice
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill">
            🛍 Continue Shopping
        </a>

    </div>

</div>

<script>
function downloadInvoice() {
    window.print(); // simple print → save as PDF
}
</script>
    
</body>
</html>

