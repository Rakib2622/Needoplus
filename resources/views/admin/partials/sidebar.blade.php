<div id="sidebar" class="sidebar">

    <h4 class="text-center mb-4">🛒 <span>Needo+</span></h4>

    <a href="{{ route('admin.dashboard') }}">🏠 <span>Dashboard</span></a>
    <a href="{{ route('admin.categories.index') }}">📂 <span>Categories</span></a>
    <a href="{{ route('admin.products.index') }}">📦 <span>Products</span></a>
    <a href="{{ route('admin.packages.index') }}">🎁 <span>Packages</span></a>

    {{-- ✅ DISCOUNT MENU --}}
    <a href="{{ route('admin.discounts.index') }}">🏷️ <span>Discounts</span></a>

    <a href="{{ route('admin.orders.index') }}">🧾 <span>Orders</span></a>
    <a href=#>👤 <span>Users</span></a>

    <hr>

    <a href="{{ route('home') }}">🔙 <span>Back</span></a>

</div>