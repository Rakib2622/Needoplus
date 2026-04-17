@include('admin.partials.header')

@include('admin.partials.sidebar')

<!-- Main Content -->
<div id="mainContent" class="main-content">

    <h2 class="mb-4">📊 Dashboard Overview</h2>

    <!-- Stats Cards -->
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Total Sales</h6>
                <h3>৳ 1,25,000</h3>
                <small class="text-success">+12% this week</small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Total Orders</h6>
                <h3>320</h3>
                <small class="text-success">+8% this week</small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Products</h6>
                <h3>85</h3>
                <small class="text-muted">Updated recently</small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Customers</h6>
                <h3>150</h3>
                <small class="text-success">+5 new today</small>
            </div>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="row mt-4">

        <div class="col-lg-8 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-3">📈 Daily Orders</h5>
                <canvas id="ordersChart" height="100"></canvas>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-3">🧾 Recent Activity</h5>
                <ul class="list-unstyled mb-0">
                    <li>✔ Order #1023 placed</li>
                    <li>✔ Product added</li>
                    <li>✔ Category updated</li>
                    <li>✔ New customer registered</li>
                </ul>
            </div>
        </div>

    </div>

</div>

@include('admin.partials.footer')