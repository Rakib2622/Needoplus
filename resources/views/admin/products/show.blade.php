@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📦 Product Details</h3>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    <div class="row">

        <!-- IMAGE -->
        <div class="col-lg-5 mb-3">
            <div class="card shadow-sm border-0">

                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-100"
                    style="height: 350px; object-fit: cover;">
                @else
                <div class="p-5 text-center text-muted">
                    No Image Available
                </div>
                @endif

            </div>
        </div>

        <!-- DETAILS -->
        <div class="col-lg-7">

            <div class="card shadow-sm border-0 p-3">

                <h4 class="fw-bold">{{ $product->name }}</h4>

                <p class="text-muted mb-2">
                    Category:
                    <strong>{{ $product->category->name ?? 'N/A' }}</strong>
                </p>

                <hr>

                <!-- PRICE -->
                <h5>
                    @if($product->discount_price)
                    <span class="text-muted text-decoration-line-through">
                        ৳ {{ $product->price }}
                    </span>
                    <br>
                    <span class="text-danger fw-bold fs-4">
                        ৳ {{ $product->discount_price }}
                    </span>
                    @else
                    <span class="fw-bold fs-4">
                        ৳ {{ $product->price }}
                    </span>
                    @endif
                </h5>



                <hr>

                <!-- STOCK + STATUS -->
                <p>
                    Stock:
                    <span class="fw-bold">{{ $product->stock }}</span>
                </p>

                <p>
                    Status:
                    @if($product->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>

                <hr>

                <!-- ACTIONS -->
                <div class="d-flex gap-2">

                    <a href="{{ route('admin.products.edit', $product->id) }}"
                        class="btn btn-warning">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger"
                            onclick="return confirm('Delete this product?')">
                            🗑 Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @if(!empty($product->description))
        <hr>

        <div class="mb-3">

            <h6 class="text-muted mb-2">📄 Description</h6>

            <div class="p-3 bg-light rounded border">
                {!! $product->description !!}
            </div>

        </div>
        @endif

    </div>

</div>

@include('admin.partials.footer')