@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📦 Products</h3>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)
                            <tr>

                                {{-- ID --}}
                                <td>{{ $loop->iteration }}</td>

                                {{-- IMAGE --}}
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             width="60"
                                             height="60"
                                             class="rounded border">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                {{-- NAME --}}
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>

                                {{-- CATEGORY --}}
                                <td>
                                    {{ $product->category->name ?? 'N/A' }}
                                </td>

                                {{-- PRICE --}}
                                <td>
                                    @if($product->discount_price)
                                        <span class="text-danger fw-bold">
                                            {{ $product->discount_price }}
                                        </span>
                                        <br>
                                        <small class="text-muted text-decoration-line-through">
                                            {{ $product->price }}
                                        </small>
                                    @else
                                        {{ $product->price }}
                                    @endif
                                </td>

                                {{-- STOCK --}}
                                <td>
                                    {{ $product->stock }}
                                </td>

                                {{-- STATUS --}}
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                {{-- ACTIONS --}}
                                <td class="text-end">

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No products found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@include('admin.partials.footer')