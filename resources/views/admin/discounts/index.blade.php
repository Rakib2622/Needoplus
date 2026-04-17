@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🏷️ Discount List</h3>

        <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary">
            + Create Discount
        </a>
    </div>

    {{-- Success --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Discount</th>
                        <th>Applied To</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($discounts as $key => $discount)

                    @php
                    $typeBadge = match($discount->type) {
                    'global' => 'bg-dark',
                    'category' => 'bg-info',
                    'product' => 'bg-warning',
                    default => 'bg-secondary'
                    };
                    @endphp

                    <tr>

                        {{-- SL --}}
                        <td>{{ $key + 1 }}</td>

                        {{-- IMAGE --}}
                        <td>
                            @if($discount->image)
                            <img src="{{ asset('storage/' . $discount->image) }}"
                                width="60" height="60"
                                style="object-fit: cover; border-radius: 6px;">
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>

                        {{-- NAME --}}
                        <td>
                            <strong>{{ $discount->name }}</strong>
                        </td>

                        {{-- TYPE --}}
                        <td>
                            <span class="badge {{ $typeBadge }}">
                                {{ strtoupper($discount->type) }}
                            </span>
                        </td>

                        {{-- DISCOUNT VALUE --}}
                        <td>
                            @if($discount->discount_type == 'percent')
                            <span class="text-danger fw-bold">
                                {{ $discount->value }}% OFF
                            </span>
                            @else
                            <span class="text-danger fw-bold">
                                ৳ {{ $discount->value }} OFF
                            </span>
                            @endif
                        </td>

                        {{-- APPLIED TO --}}
                        <td>
                            @if($discount->type == 'global')
                            🌍 All Products

                            @elseif($discount->type == 'category')
                            📂 {{ $discount->category->name ?? 'Deleted Category' }}

                            @elseif($discount->type == 'product')
                            📦 {{ $discount->product->name ?? 'Deleted Product' }}
                            @endif
                        </td>

                        {{-- DATE --}}
                        <td>
                            @if($discount->start_date || $discount->end_date)
                            <small>
                                {{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('d M Y') : '-' }}
                                <br>
                                →
                                <br>
                                {{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('d M Y') : '-' }}
                            </small>
                            @else
                            <span class="text-muted">No limit</span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($discount->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        {{-- ACTION --}}
                        <td class="d-flex gap-1">

                            <a href="{{ route('admin.discounts.edit', $discount->id) }}"
                                class="btn btn-sm btn-warning">
                                ✏️
                            </a>

                            <form action="{{ route('admin.discounts.destroy', $discount->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    🗑️
                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            No discounts found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@include('admin.partials.footer')