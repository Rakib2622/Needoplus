@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🏷️ Create Discount</h3>
    </div>

    {{-- Success / Error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.discounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-body">

                <div class="row">

                    {{-- NAME --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Eid Sale" required>
                    </div>

                    {{-- TYPE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="global">🌍 Global</option>
                            <option value="category">📂 Category</option>
                            <option value="product">📦 Product</option>
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6 mb-3" id="categoryField" style="display:none;">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- PRODUCT --}}
                    <div class="col-md-6 mb-3" id="productField" style="display:none;">
                        <label class="form-label">Select Product</label>
                        <select name="product_id" class="form-control">
                            <option value="">-- Choose Product --</option>
                            @foreach($products as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DISCOUNT TYPE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="percent">📊 Percent (%)</option>
                            <option value="flat">💰 Flat (৳)</option>
                        </select>
                    </div>

                    {{-- VALUE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Value</label>
                        <input type="number" name="value" class="form-control" placeholder="e.g. 10 or 500" required>
                    </div>

                    {{-- START DATE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control">
                    </div>

                    {{-- END DATE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                    </div>

                    {{-- PREVIEW --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Preview</label><br>
                        <img id="preview" style="display:none; width:120px; border:1px solid #ddd; padding:5px; border-radius:6px;">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    Create Discount
                </button>

            </div>
        </div>

    </form>
</div>

{{-- JS --}}
<script>
    const typeSelect = document.getElementById('type');
    const categoryField = document.getElementById('categoryField');
    const productField = document.getElementById('productField');

    function toggleFields() {
        let type = typeSelect.value;

        categoryField.style.display = (type === 'category') ? 'block' : 'none';
        productField.style.display = (type === 'product') ? 'block' : 'none';
    }

    typeSelect.addEventListener('change', toggleFields);

    // run on load (important for UX)
    toggleFields();

    // image preview
    function previewImage(event) {
        let reader = new FileReader();

        reader.onload = function () {
            let img = document.getElementById('preview');
            img.src = reader.result;
            img.style.display = 'block';
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@include('admin.partials.footer')