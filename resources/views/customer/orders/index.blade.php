@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container-fluid py-5">
    <div class="row px-xl-5">

        <div class="col-12">
            <h3 class="mb-4">📦 My Orders</h3>
        </div>

        @if($orders->count() > 0)

        <div class="col-12">

            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($orders as $order)

                        @php
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

                        <tr>

                            {{-- ORDER ID --}}
                        

                            {{-- ITEMS --}}
                            <td class="text-left">

                                @foreach($order->items->take(2) as $item)

                                    @php
                                        $image = null;

                                        if($item->product && $item->product->image){
                                            $image = $item->product->image;
                                        } elseif($item->package && $item->package->image){
                                            $image = $item->package->image;
                                        }
                                    @endphp

                                    <div class="d-flex align-items-center mb-2" style="gap:10px;">

                                        <img src="{{ $image ? asset('storage/' . $image) : asset('assets/img/no-image.png') }}"
                                             style="width:50px;height:50px;object-fit:cover;">

                                        <div>
                                            {{ $item->name }}
                                            <br>
                                            <small class="text-muted">
                                                Qty: {{ $item->quantity }}
                                            </small>
                                        </div>

                                    </div>

                                @endforeach

                                @if($order->items->count() > 2)
                                    <small class="text-muted">+ more items...</small>
                                @endif

                            </td>

                            {{-- TOTAL --}}
                            <td>
                                <strong class="text-success">
                                    ৳ {{ number_format($order->total_amount, 0) }}
                                </strong>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            {{-- DATE --}}
                            <td>
                                <div>
                                    {{ $order->created_at->format('d M Y') }}
                                </div>
                                <small class="text-muted">
                                    {{ $order->created_at->format('h:i A') }}
                                </small>
                            </td>

                            {{-- ACTION --}}
                            <td>

                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="btn btn-sm btn-primary mb-1">
                                    View
                                </a>

                                {{-- TRACK BUTTON --}}
                                @if($order->tracking_code)
                                    <a href="https://steadfast.com.bd/tracking?code={{ $order->tracking_code }}"
                                        target="_blank"
                                        class="btn btn-sm btn-dark">
                                        Track
                                    </a>
                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="col-12 mt-3 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>

        @else

        {{-- EMPTY --}}
        <div class="col-12 text-center py-5">
            <h5>No orders found</h5>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                Continue Shopping
            </a>
        </div>

        @endif

    </div>
</div>

@include('customer.partial.footer')