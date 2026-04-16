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

                {{-- DESCRIPTION (CKEDITOR) --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control">
                </div>

                {{-- DISCOUNT PRICE --}}
                <div class="mb-3">
                    <label>Discount Price</label>
                    <input type="number" name="discount_price" class="form-control">
                </div>

                {{-- STOCK --}}
                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control">
                </div>

                {{-- IMAGE --}}
                <div class="mb-3">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control">
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

{{-- CKEDITOR INIT --}}
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description');
</script>

@include('admin.partials.footer')