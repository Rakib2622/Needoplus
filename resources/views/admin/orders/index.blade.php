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

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            {{-- 🔥 SCROLL WRAPPER --}}
            <div style="overflow-x:auto;">

                <table class="table table-hover align-middle mb-0" style="min-width: 1000px;">
                    
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Time & Date</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                        <tr>

                            <td class="fw-bold">{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $order->name }}</strong>
                            </td>

                            <td>{{ $order->phone }}</td>

                            {{-- ADDRESS --}}
                            <td style="max-width:220px;">
                                <small>{{ $order->address }}</small>
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
                            <td class="text-success fw-bold">
                                ৳ {{ number_format($order->total_amount, 2) }}
                            </td>

                            {{-- TIME & DATE --}}
                            <td>
                                <div>
                                    <strong>{{ $order->created_at->format('d M Y') }}</strong>
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
                                        'packaging' => '#17a2b8',
                                        'shipped' => '#007bff',
                                        'delivered' => '#26b3a9',
                                        'returned' => '#ffc107',
                                        'declined' => '#dc3545',
                                        'completed' => '#13ff5a',
                                    ];
                                @endphp

                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf

                                    <select name="status"
                                        onchange="this.form.submit()"
                                        class="form-control form-control-sm text-white fw-bold"
                                        style="
                                            background: {{ $statusColors[$order->status] ?? '#6c757d' }};
                                            border-radius: 8px;
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
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-primary shadow-sm">
                                    View
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
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