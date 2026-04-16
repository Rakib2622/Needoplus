@include('admin.partials.header')

@include('admin.partials.sidebar')

<div class="main-content">

    <h2>👋 Welcome to Admin Dashboard</h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Categories</h5>
                <p>Manage all product categories</p>
                <a href="{{ route('admin.categories.index') }}">Go →</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Products</h5>
                <p>Manage all products</p>
                <a href="{{ route('admin.products.index') }}">Go →</a>
            </div>
        </div>

    </div>

</div>

@include('admin.partials.footer')