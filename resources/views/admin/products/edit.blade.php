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

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              id="description"
                              class="form-control">{{ $product->description }}</textarea>
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
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

                {{-- CURRENT MAIN IMAGE --}}
                <div class="mb-3">
                    <label>Current Main Image</label><br>

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             width="120"
                             class="rounded border mb-2">
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                {{-- CHANGE MAIN IMAGE --}}
                <div class="mb-3">
                    <label>Change Main Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- GALLERY IMAGES --}}
                <div class="mb-3">
                    <label>Current Gallery Images</label><br>

                    @if($product->images)
                        @foreach($product->images as $img)
                            <img src="{{ asset('storage/' . $img) }}"
                                 width="80"
                                 class="rounded border me-2 mb-2">
                        @endforeach
                    @else
                        <p class="text-muted">No gallery images</p>
                    @endif
                </div>

                {{-- UPLOAD NEW GALLERY IMAGES --}}
                <div class="mb-3">
                    <label>Upload New Gallery Images (will replace old)</label>
                    <input type="file" name="images[]" multiple class="form-control">
                </div>

                {{-- COLORS --}}
                <div class="mb-3">
                    <label>Colors</label>

                    <div id="color-wrapper">

                        @if($product->colors)
                            @foreach($product->colors as $color)
                                <div class="d-flex mb-2">
                                    <input type="text"
                                           name="colors[]"
                                           value="{{ $color }}"
                                           class="form-control me-2">
                                    <button type="button" class="btn btn-danger remove-color">X</button>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex mb-2">
                                <input type="text" name="colors[]" class="form-control me-2" placeholder="Enter color">
                                <button type="button" class="btn btn-danger remove-color">X</button>
                            </div>
                        @endif

                    </div>

                    <button type="button" id="add-color" class="btn btn-sm btn-primary mt-2">
                        + Add Color
                    </button>
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

{{-- COLOR SCRIPT --}}
<script>
    document.getElementById('add-color').addEventListener('click', function () {
        let html = `
            <div class="d-flex mb-2">
                <input type="text" name="colors[]" class="form-control me-2" placeholder="Enter color">
                <button type="button" class="btn btn-danger remove-color">X</button>
            </div>
        `;
        document.getElementById('color-wrapper').insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-color')) {
            e.target.parentElement.remove();
        }
    });
</script>

@include('admin.partials.footer')