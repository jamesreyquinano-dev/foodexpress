<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .sidebar-panel { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #212529; z-index: 1000; padding: 1.5rem; }
        .main-content-area { margin-left: 260px; padding: 2.5rem; min-height: 100vh; }
    </style>
</head>
<body>

    <div class="sidebar-panel d-flex flex-column text-white">
        <div class="mb-4 pt-2">
            <span class="fs-4 fw-bold text-primary"> AdminPanel</span>
        </div>
        <hr class="text-secondary">
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="{{ route('dashboard') }}" class="nav-link text-white active fw-bold px-3">
                    <span class="me-2"></span> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('user') }}" class="nav-link text-white opacity-75 px-3">
                    <span class="me-2"></span> Users List
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('profile') }}" class="nav-link text-white opacity-75 px-3">
                    <span class="me-2"></span> Users Profile
                </a>
            </li>
        </ul>
        
        <hr class="text-secondary">
        <div class="d-grid">
            <a href="/logout" class="btn btn-danger btn-sm py-2 fw-semibold"> Logout</a>
        </div>
    </div>

    <div class="main-content-area">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h3 class="fw-bold text-dark mb-1">System Analytics Dashboard</h3>
                <p class="text-muted small mb-0">Monitor platform sales performance, tracking records, and graphic summaries.</p>
            </div>
            <span class="badge bg-dark px-3 py-2 fw-semibold shadow-sm"> Administrative Access</span>
        </div>
        
        <div class="row g-3 mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border-0 bg-primary text-white h-100">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <h6 class="text-uppercase text-white-50 small mb-1 fw-bold">Total Sales Revenue</h6>
                            <h3 class="fw-bold mb-0">${{ number_format($totalSales, 2) }}</h3>
                        </div>
                        <span style="font-size: 2rem;"></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border-0 bg-success text-white h-100">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <h6 class="text-uppercase text-white-50 small mb-1 fw-bold">Total Orders Placed</h6>
                            <h3 class="fw-bold mb-0">{{ $totalOrders }} Orders</h3>
                        </div>
                        <span style="font-size: 2rem;"></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="card shadow-sm border-0 bg-warning text-dark h-100">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <h6 class="text-uppercase text-muted small mb-1 fw-bold">Registered Customers</h6>
                            <h3 class="fw-bold mb-0">{{ $totalUsers }} Users</h3>
                        </div>
                        <span style="font-size: 2rem;"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 p-4 bg-white h-100">
                    <h5 class="mb-3 fw-bold text-dark border-bottom pb-2">Weekly Orders Volume</h5>
                    <div style="position: relative; height:260px;">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 p-4 bg-white h-100">
                    <h5 class="mb-3 fw-bold text-dark border-bottom pb-2">Top Selling Categories</h5>
                    <div style="position: relative; height:260px;" class="d-flex justify-content-center">
                        <canvas id="itemsPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const rawChartData = '{{ json_encode($chartData) }}';
        const cleanChartData = JSON.parse(rawChartData.replace(/&quot;/g, '"'));

        new Chart(document.getElementById('ordersChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{ data: cleanChartData, backgroundColor: '#0d6efd', borderRadius: 5 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('itemsPieChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Fresh Salads', 'Grilled Salmon', 'Smoothie Blast', 'Avocado Toast'],
                datasets: [{ data: [35, 25, 20, 20], backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, cutout: '72%' }
        });
    </script>
</body>
</html>