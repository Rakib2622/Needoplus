@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <h3>✏️ Edit Product</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('admin.products.update', $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- CATEGORY --}}
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- NAME --}}
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           class="form-control">
                </div>

                {{-- DESCRIPTION (CKEDITOR) --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              id="description"
                              class="form-control">
                        {{ $product->description }}
                    </textarea>
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
                           class="form-control">
                </div>

                {{-- DISCOUNT PRICE --}}
                <div class="mb-3">
                    <label>Discount Price</label>
                    <input type="number"
                           name="discount_price"
                           value="{{ $product->discount_price }}"
                           class="form-control">
                </div>

                {{-- STOCK --}}
                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number"
                           name="stock"
                           value="{{ $product->stock }}"
                           class="form-control">
                </div>

                {{-- CURRENT IMAGE --}}
                <div class="mb-3">
                    <label>Current Image</label><br>

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             width="120"
                             class="rounded border mb-2">
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                {{-- NEW IMAGE --}}
                <div class="mb-3">
                    <label>Change Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-primary">
                    Update Product
                </button>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>

{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description');
</script>

@include('admin.partials.footer')