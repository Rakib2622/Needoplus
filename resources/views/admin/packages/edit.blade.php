@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>✏️ Edit Package</h3>

        <a href="{{ route('admin.packages.index') }}" class="btn btn-dark">
            ← Back
        </a>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- LEFT --}}
            <div class="col-lg-8">

                {{-- NAME --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <label><strong>Package Name</strong></label>
                        <input type="text" name="name"
                               value="{{ $package->name }}"
                               class="form-control" required>
                    </div>
                </div>

                {{-- PRODUCTS --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Select Products</h5>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="120">Price</th>
                                    <th width="120">Qty</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)

                                @php
                                    $existingQty = optional(
                                        $package->products->firstWhere('id', $product->id)
                                    )->pivot->quantity ?? 0;
                                @endphp

                                <tr>

                                    <td>{{ $product->name }}</td>

                                    <td>৳ {{ $product->final_price }}</td>

                                    <td>
                                        <input type="number"
                                               name="products[{{ $product->id }}]"
                                               class="form-control qty-input"
                                               data-price="{{ $product->final_price }}"
                                               value="{{ $existingQty }}"
                                               min="0">
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Summary</h5>

                        {{-- TOTAL --}}
                        <p>
                            <strong>Total Product Price:</strong><br>
                            ৳ <span id="total-price">0</span>
                        </p>

                        {{-- DISCOUNT TYPE --}}
                        <div class="form-group">
                            <label>Discount Type</label>
                            <select name="discount_type" id="discount-type" class="form-control">
                                <option value="">None</option>
                                <option value="percent"
                                    {{ $package->discount_type == 'percent' ? 'selected' : '' }}>
                                    Percent (%)
                                </option>
                                <option value="flat"
                                    {{ $package->discount_type == 'flat' ? 'selected' : '' }}>
                                    Flat (৳)
                                </option>
                            </select>
                        </div>

                        {{-- VALUE --}}
                        <div class="form-group">
                            <label>Discount Value</label>
                            <input type="number"
                                   name="value"
                                   id="discount-value"
                                   class="form-control"
                                   value="{{ $package->value ?? 0 }}"
                                   min="0">
                        </div>

                        {{-- FINAL --}}
                        <p>
                            <strong>Final Price:</strong><br>
                            <span class="text-success h5">
                                ৳ <span id="final-price">0</span>
                            </span>
                        </p>

                        {{-- STATUS --}}
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ $package->is_active ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ !$package->is_active ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <button class="btn btn-primary w-100">
                            💾 Update Package
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalEl = document.getElementById('total-price');
    const finalEl = document.getElementById('final-price');
    const discountType = document.getElementById('discount-type');
    const discountValue = document.getElementById('discount-value');

    function calculate() {
        let total = 0;

        qtyInputs.forEach(input => {
            let qty = parseFloat(input.value) || 0;
            let price = parseFloat(input.dataset.price) || 0;
            total += qty * price;
        });

        totalEl.innerText = total.toFixed(2);

        let final = total;
        let discount = parseFloat(discountValue.value) || 0;

        if (discountType.value === 'percent') {
            final = total - (total * discount / 100);
        } else if (discountType.value === 'flat') {
            final = total - discount;
        }

        if (final < 0) final = 0;

        finalEl.innerText = final.toFixed(2);
    }

    // events
    qtyInputs.forEach(input => input.addEventListener('input', calculate));
    discountType.addEventListener('change', calculate);
    discountValue.addEventListener('input', calculate);

    // 🔥 IMPORTANT → run once on load
    calculate();
});
</script>

@include('admin.partials.footer')