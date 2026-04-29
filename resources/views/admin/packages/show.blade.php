@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🎁 Package Details</h3>

        <div>
            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('admin.packages.index') }}" class="btn btn-dark">
                ← Back
            </a>
        </div>
    </div>

    <div class="row">

        {{-- LEFT: PRODUCT LIST --}}
        <div class="col-lg-8">

            <div class="card mb-3">
                <div class="card-body">

                    <h5 class="mb-3">📦 Products in Package</h5>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th width="120">Price</th>
                                <th width="100">Qty</th>
                                <th width="150">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($package->products as $product)
                                <tr>

                                    <td>{{ $product->name }}</td>

                                    <td>৳ {{ number_format($product->final_price, 2) }}</td>

                                    <td>{{ $product->pivot->quantity }}</td>

                                    <td>
                                        ৳ {{ number_format($product->final_price * $product->pivot->quantity, 2) }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        No products added
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

        {{-- RIGHT: SUMMARY --}}
        <div class="col-lg-4">

            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">📊 Summary</h5>

                    {{-- NAME --}}
                    <p>
                        <strong>Name:</strong><br>
                        {{ $package->name }}
                    </p>

                    {{-- TOTAL --}}
                    <p>
                        <strong>Total Product Price:</strong><br>
                        ৳ {{ number_format($package->total_product_price, 2) }}
                    </p>

                    {{-- DISCOUNT --}}
                    <p>
                        <strong>Discount:</strong><br>

                        @if($package->discount_type == 'percent')
                            {{ $package->value }}%
                        @elseif($package->discount_type == 'flat')
                            ৳ {{ number_format($package->value, 2) }}
                        @else
                            None
                        @endif

                    </p>

                    {{-- FINAL --}}
                    <p>
                        <strong>Final Price:</strong><br>
                        <span class="text-success h5">
                            ৳ {{ number_format($package->final_price, 2) }}
                        </span>
                    </p>

                    {{-- STATUS --}}
                    <p>
                        <strong>Status:</strong><br>
                        @if($package->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </p>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.partials.footer')