@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🎁 Packages</h3>

        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            + Add Package
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Total Product Price</th>
                        <th>Discount</th>
                        <th>Final Price</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $package->name }}</td>

                        {{-- SUM OF PRODUCT FINAL PRICE --}}
                        <td>
                            ৳ {{ number_format($package->total_product_price, 2) }}
                        </td>

                        {{-- DISCOUNT --}}
                        <td>
                            @if($package->discount_type == 'percent')
                            {{ $package->value }}%
                            @elseif($package->discount_type == 'flat')
                            ৳ {{ $package->value }}
                            @else
                            -
                            @endif
                        </td>

                        {{-- FINAL PRICE --}}
                        <td class="text-success font-weight-bold">
                            ৳ {{ number_format($package->final_price, 2) }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($package->is_active)
                            <span class="badge badge-info text-dark">Active</span>
                            @else
                            <span class="badge badge-danger text-white">Inactive</span>
                            @endif
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <a href="{{ route('admin.packages.edit', $package->id) }}"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this package?')">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No packages found
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $packages->links() }}
    </div>

</div>

@include('admin.partials.footer')