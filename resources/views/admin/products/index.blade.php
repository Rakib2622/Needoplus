@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📦 Products</h3>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    {{-- Success --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @forelse($products as $categoryId => $categoryProducts)

    <!-- CATEGORY TITLE -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">
                📂 {{ $categoryProducts->first()->category->name ?? 'Uncategorized' }}
            </h5>
        </div>

        <!-- SCROLL CONTAINER -->
        <div class="product-scroll d-flex">

            @foreach($categoryProducts as $product)

            @php
                $discount = \App\Models\Discount::getApplicableDiscount($product);
                $finalPrice = $product->final_price;
                $originalPrice = $product->price;
                $hasDiscount = $finalPrice < $originalPrice;
                $saveAmount = $product->discount_amount;
                $percent = $product->discount_percent;
            @endphp

            <div class="product-card">

                <div class="card product-ui border-0 h-100">

                    <!-- IMAGE -->
                    <div class="img-box position-relative">

                        {{-- % BADGE --}}
                        @if($hasDiscount)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                {{ $percent }}% OFF
                            </span>
                        @endif

                        {{-- STATUS --}}
                        @if($product->is_active)
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                Active
                            </span>
                        @else
                            <span class="badge bg-secondary position-absolute top-0 end-0 m-2">
                                Off
                            </span>
                        @endif

                        {{-- IMAGE --}}
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}">
                        @else
                            <div class="no-img">No Image</div>
                        @endif

                    </div>

                    <div class="card-body p-2 d-flex flex-column">

                        <!-- NAME -->
                        <h6 class="fw-semibold small mb-1">
                            {{ Str::limit($product->name, 28) }}
                        </h6>

                        <!-- PRICE -->
                        <div class="mb-1">

                            @if($hasDiscount)
                                <span class="text-muted text-decoration-line-through small">
                                    ৳ {{ $originalPrice }}
                                </span>
                                <br>

                                <span class="text-danger fw-bold">
                                    ৳ {{ $finalPrice }}
                                </span>

                                <div class="small text-success">
                                    Save ৳ {{ $saveAmount }}
                                </div>

                            @else
                                <span class="fw-bold text-dark">
                                    ৳ {{ $originalPrice }}
                                </span>
                            @endif

                        </div>

                        <!-- STOCK -->
                        <small class="mb-2 
                            {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </small>

                        {{-- COUNTDOWN --}}
                        @if($discount && $discount->end_date)
                            <small class="text-warning mb-2">
                                ⏳ Ends: {{ \Carbon\Carbon::parse($discount->end_date)->format('d M Y H:i') }}
                            </small>
                        @endif

                        <!-- ACTION -->
                        <div class="d-flex gap-1 mt-auto">

                            <a href="{{ route('admin.products.show', $product->id) }}"
                                class="btn btn-sm btn-info w-50">
                                👁
                            </a>

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-warning w-50">
                                ✏️
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                method="POST" class="w-50">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger w-100"
                                    onclick="return confirm('Delete this product?')">
                                    🗑️
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>
    </div>

    @empty
    <div class="text-center text-muted py-5">
        No products found
    </div>
    @endforelse

</div>

@include('admin.partials.footer')