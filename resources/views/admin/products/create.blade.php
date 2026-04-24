@include('admin.partials.header')
@include('admin.partials.sidebar')

<div class="main-content">

    <h3>➕ Create Product</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- CATEGORY --}}
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- NAME --}}
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control">
                </div>

                {{-- STOCK --}}
                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control">
                </div>

                {{-- SINGLE IMAGE --}}
                <div class="mb-3">
                    <label>Main Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- MULTIPLE IMAGES --}}
                <div class="mb-3">
                    <label>Gallery Images</label>
                    <input type="file" name="images[]" multiple class="form-control">
                </div>

                {{-- COLORS --}}
                <div class="mb-3">
                    <label>Colors</label>

                    <div id="color-wrapper">
                        <div class="d-flex mb-2">
                            <input type="text" name="colors[]" class="form-control me-2" placeholder="Enter color (e.g. Red)">
                            <button type="button" class="btn btn-danger remove-color">X</button>
                        </div>
                    </div>

                    <button type="button" id="add-color" class="btn btn-sm btn-primary mt-2">
                        + Add Color
                    </button>
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-success">
                    Save Product
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

{{-- COLOR ADD/REMOVE SCRIPT --}}
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