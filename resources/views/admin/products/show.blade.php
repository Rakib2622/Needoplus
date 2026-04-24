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
            <div class="card shadow-sm border-0 p-2">

                {{-- MAIN IMAGE --}}
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-100 mb-2"
                    style="height: 300px; object-fit: cover;">
                @endif

                {{-- GALLERY IMAGES --}}
                @if($product->images)
                <div class="d-flex flex-wrap gap-2">
                    @foreach($product->images as $img)
                    <img src="{{ asset('storage/' . $img) }}"
                        width="70"
                        height="70"
                        style="object-fit: cover; border-radius:6px;">
                    @endforeach
                </div>
                @endif

                {{-- NO IMAGE --}}
                @if(!$product->image && !$product->images)
                <div class="p-5 text-center text-muted">
                    No Image Available
                </div>
                @endif

            </div>
    </div>

    <!-- DETAILS -->
    <div class="col-lg-7 mb-3">

        <div class="card shadow-sm border-0 p-3">

            <h4 class="fw-bold">{{ $product->name }}</h4>

            <p class="text-muted mb-2">
                Category:
                <strong>{{ $product->category->name ?? 'N/A' }}</strong>
            </p>

            {{-- COLORS --}}
            @if($product->colors)
            <p class="mb-2">
                Colors:
                @foreach($product->colors as $color)
                <span class="badge bg-light text-dark border">
                    {{ $color }}
                </span>
                @endforeach
            </p>
            @endif

            <hr>

            <!-- PRICE -->
            <h5>
                @if($product->final_price < $product->price)

                    <span class="text-muted text-decoration-line-through">
                        ৳ {{ $product->price }}
                    </span>
                    <br>

                    <span class="text-danger fw-bold fs-4">
                        ৳ {{ $product->final_price }}
                    </span>

                    <div class="text-success small">
                        Save ৳ {{ $product->discount_amount }}
                        ({{ $product->discount_percent }}% OFF)
                    </div>

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