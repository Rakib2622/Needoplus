@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>✏️ Edit Discount</h3>
    </div>

    <form action="{{ route('admin.discounts.update', $discount->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="row">

                    {{-- NAME --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $discount->name }}" required>
                    </div>

                    {{-- TYPE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="global" {{ $discount->type == 'global' ? 'selected' : '' }}>
                                🌍 Global
                            </option>
                            <option value="category" {{ $discount->type == 'category' ? 'selected' : '' }}>
                                📂 Category
                            </option>
                            <option value="product" {{ $discount->type == 'product' ? 'selected' : '' }}>
                                📦 Product
                            </option>
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6 mb-3" id="categoryField">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $discount->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- PRODUCT --}}
                    <div class="col-md-6 mb-3" id="productField">
                        <label class="form-label">Select Product</label>
                        <select name="product_id" class="form-control">
                            <option value="">-- Choose Product --</option>
                            @foreach($products as $pro)
                                <option value="{{ $pro->id }}"
                                    {{ $discount->product_id == $pro->id ? 'selected' : '' }}>
                                    {{ $pro->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DISCOUNT TYPE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="percent" {{ $discount->discount_type == 'percent' ? 'selected' : '' }}>
                                📊 Percent (%)
                            </option>
                            <option value="flat" {{ $discount->discount_type == 'flat' ? 'selected' : '' }}>
                                💰 Flat (৳)
                            </option>
                        </select>
                    </div>

                    {{-- VALUE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Value</label>
                        <input type="number" name="value" class="form-control"
                               value="{{ $discount->value }}" required>
                    </div>

                    {{-- START DATE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control"
                               value="{{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    {{-- END DATE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control"
                               value="{{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)">

                        @if($discount->image)
                            <img src="{{ asset('storage/' . $discount->image) }}"
                                 width="100"
                                 class="mt-2 rounded border p-1">
                        @endif
                    </div>

                    {{-- PREVIEW --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">New Preview</label><br>
                        <img id="preview"
                             style="display:none; width:120px; border:1px solid #ddd; padding:5px; border-radius:6px;">
                    </div>

                </div>

                <button class="btn btn-primary mt-2">
                    Update Discount
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

    // IMPORTANT: run on load (fix UX bug)
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