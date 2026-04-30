@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📦 Orders</h3>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger shadow-sm">
        {{ session('error') }}
    </div>
    @endif

    {{-- TABLE --}}
<div class="card border-0 shadow-sm" style="border-radius:12px; overflow:hidden;">

    <div class="card-body p-0">

        {{-- 🔥 SCROLL WRAPPER --}}
        <div style="
            overflow-x:auto;
            overflow-y:auto;
            max-height:75vh;
        ">

            <table class="table table-hover align-middle mb-0" style="min-width:1300px;">

                {{-- 🔥 STICKY HEADER --}}
                <thead style="
                    background:#ffffff;
                    position: sticky;
                    top: 0;
                    z-index: 10;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                ">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Consignment</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)
                    <tr style="transition:0.2s;">

                        <td class="fw-bold text-muted">
                            #{{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>{{ $order->name }}</strong>
                        </td>

                        <td>{{ $order->phone }}</td>

                        <td style="max-width:220px;">
                            <small class="text-muted">
                                {{ $order->address }}
                            </small>
                        </td>

                        {{-- ITEMS --}}
                        <td style="min-width:180px;">
                            @foreach($order->items->take(2) as $item)
                                <div>
                                    • {{ $item->name }}
                                    <small class="text-muted">(x{{ $item->quantity }})</small>
                                </div>
                            @endforeach

                            @if($order->items->count() > 2)
                                <small class="text-muted">+ more...</small>
                            @endif
                        </td>

                        {{-- TOTAL --}}
                        <td class="fw-bold text-success">
                            ৳ {{ number_format($order->total_amount, 2) }}
                        </td>

                        {{-- CONSIGNMENT --}}
                        <td style="min-width:170px;">
                            @if($order->consignment_id)
                                <div class="fw-bold">
                                    {{ $order->consignment_id }}
                                </div>
                                <small class="text-primary">
                                    {{ $order->tracking_code }}
                                </small>
                            @else
                                <span class="badge bg-light text-dark">
                                    Not Sent
                                </span>
                            @endif
                        </td>

                        {{-- TIME --}}
                        <td>
                            <div class="fw-bold">
                                {{ $order->created_at->format('d M') }}
                            </div>
                            <small class="text-muted">
                                {{ $order->created_at->format('h:i A') }}
                            </small>
                        </td>

                        {{-- STATUS --}}
                        <td style="min-width:150px;">

                            @php
                                $statusColors = [
                                    'pending' => '#6c757d',
                                    'packeging' => '#17a2b8',
                                    'shipped' => '#007bff',
                                    'delivered' => '#28a745',
                                    'returned' => '#ffc107',
                                    'declined' => '#dc3545',
                                    'completed' => '#343a40',
                                ];
                            @endphp

                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf

                                <select name="status"
                                    onchange="this.form.submit()"
                                    class="form-control form-control-sm text-white fw-bold"
                                    style="
                                        background: {{ $statusColors[$order->status] ?? '#6c757d' }};
                                        border-radius: 10px;
                                        border: none;
                                    ">

                                    @foreach($statusColors as $status => $color)
                                        <option value="{{ $status }}"
                                            {{ $order->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach

                                </select>
                            </form>

                        </td>

                        {{-- ACTION --}}
                        <td>

                            <div class="d-flex flex-column">

                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-outline-primary mb-1">
                                    👁 View
                                </a>

                                @if(!$order->tracking_code)
                                    <form action="{{ route('admin.orders.sendCourier', $order->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success mb-1 w-100"
                                            onclick="return confirm('Send to courier?')">
                                            🚚 Send
                                        </button>
                                    </form>
                                @endif

                                @if($order->tracking_code)
                                    <a href="https://steadfast.com.bd/tracking?code={{ $order->tracking_code }}"
                                        target="_blank"
                                        class="btn btn-sm btn-dark w-100">
                                        📦 Track
                                    </a>
                                @endif

                            </div>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            No orders found
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

    {{-- PAGINATION --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

</div>

@include('admin.partials.footer')