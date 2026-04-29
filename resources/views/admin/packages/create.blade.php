@include('admin.partials.header')
@include('admin.partials.sidebar')

<div id="mainContent" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🎁 Create Package</h3>

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

    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">

                {{-- PACKAGE NAME --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <label><strong>Package Name</strong></label>
                        <input type="text" name="name" class="form-control" required>
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
                                <tr>

                                    <td>{{ $product->name }}</td>

                                    <td>
                                        ৳ {{ $product->final_price }}
                                    </td>

                                    <td>
                                        <input type="number"
                                               name="products[{{ $product->id }}]"
                                               class="form-control qty-input"
                                               data-price="{{ $product->final_price }}"
                                               value="0" min="0">
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
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
                                <option value="percent">Percent (%)</option>
                                <option value="flat">Flat (৳)</option>
                            </select>
                        </div>

                        {{-- DISCOUNT VALUE --}}
                        <div class="form-group">
                            <label>Discount Value</label>
                            <input type="number" name="value" id="discount-value"
                                   class="form-control" value="0" min="0">
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
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-primary w-100">
                            💾 Save Package
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>



@include('admin.partials.footer')