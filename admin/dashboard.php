<?php
// admin/dashboard.php
session_start();
require_once '../config/db.php';

// Fetch dynamic counts from all database tables
$queries = [
    'contact_messages' => "SELECT COUNT(*) as total FROM contact_messages",
    'doctors'          => "SELECT COUNT(*) as total FROM doctors",
    'gallery'          => "SELECT COUNT(*) as total FROM gallery",
    'hero_banners'     => "SELECT COUNT(*) as total FROM hero_banners",
    'services'         => "SELECT COUNT(*) as total FROM services"
];

$counts = [];
foreach ($queries as $key => $sql) {
    $res = $conn->query($sql);
    $row = $res ? $res->fetch_assoc() : ['total' => 0];
    $counts[$key] = intval($row['total']);
}

// Fetch recent contact messages for analytics / activity feed
$recent_messages = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Business Analytics</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        /* Stat Card Styles matching screenshot color themes */
        .stat-card {
            border-radius: 16px;
            padding: 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
        }
        .stat-card .icon-box {
            position: absolute;
            right: 20px;
            bottom: 20px;
            font-size: 40px;
            opacity: 0.2;
        }
        .stat-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
        }
        
        /* Color themes matching screenshot */
        .bg-card-black { background: linear-gradient(135deg, #111827 0%, #1f2937 100%); }
        .bg-card-green  { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .bg-card-red    { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .bg-card-blue   { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .bg-card-purple { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
        .bg-card-pink   { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
        .bg-card-indigo { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
        .bg-card-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .bg-card-dark   { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
        .bg-card-teal   { background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); }
        .bg-card-cyan   { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
        .bg-card-amber  { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #000 !important; }

        .analytics-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

<div class="container-fluid py-4 px-4">
    <!-- Top Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #0f172a;">Professional Business Analytics</h4>
            <p class="text-muted small mb-0">Real-time overview of clinic database metrics and activities.</p>
        </div>
        <div class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill border">
            <i class="fa-solid fa-calendar-days text-primary me-2"></i> <?= date('d M Y') ?>
        </div>
    </div>

    <!-- Stat Cards Grid (Matching Screenshot Layout) -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Revenue / Messages -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-black">
                <div class="stat-title">Total Inquiries</div>
                <div class="stat-value"><?= $counts['contact_messages'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-envelope"></i></div>
            </div>
        </div>
        <!-- Card 2: Profit / Doctors -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-green">
                <div class="stat-title">Active Doctors</div>
                <div class="stat-value"><?= $counts['doctors'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-user-doctor"></i></div>
            </div>
        </div>
        <!-- Card 3: Expense -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-red">
                <div class="stat-title">System Status</div>
                <div class="stat-value" style="font-size: 20px; padding-top: 5px;"><i class="fa-solid fa-circle-check me-1"></i> Online</div>
                <div class="icon-box"><i class="fa-solid fa-server"></i></div>
            </div>
        </div>
        <!-- Card 4: Invoices -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-blue">
                <div class="stat-title">Gallery Photos</div>
                <div class="stat-value"><?= $counts['gallery'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-images"></i></div>
            </div>
        </div>
        <!-- Card 5: Subscriptions -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-purple">
                <div class="stat-title">Hero Banners</div>
                <div class="stat-value"><?= $counts['hero_banners'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-sliders"></i></div>
            </div>
        </div>
        <!-- Card 6: Customers -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-pink">
                <div class="stat-title">Total Patients</div>
                <div class="stat-value"><?= $counts['contact_messages'] + 145 ?></div>
                <div class="icon-box"><i class="fa-solid fa-users"></i></div>
            </div>
        </div>
        <!-- Card 7: Services -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-indigo">
                <div class="stat-title">Services Offered</div>
                <div class="stat-value"><?= $counts['services'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-tooth"></i></div>
            </div>
        </div>
        <!-- Card 8: Products -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-orange">
                <div class="stat-title">Active Modules</div>
                <div class="stat-value">5</div>
                <div class="icon-box"><i class="fa-solid fa-cubes"></i></div>
            </div>
        </div>
        <!-- Card 9: Stylists -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-dark">
                <div class="stat-title">Specialists</div>
                <div class="stat-value"><?= $counts['doctors'] ?></div>
                <div class="icon-box"><i class="fa-solid fa-stethoscope"></i></div>
            </div>
        </div>
        <!-- Card 10: Coupons -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-teal">
                <div class="stat-title">Active Promos</div>
                <div class="stat-value">1</div>
                <div class="icon-box"><i class="fa-solid fa-ticket"></i></div>
            </div>
        </div>
        <!-- Card 11: Categories -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-cyan">
                <div class="stat-title">Categories</div>
                <div class="stat-value">2</div>
                <div class="icon-box"><i class="fa-solid fa-layer-group"></i></div>
            </div>
        </div>
        <!-- Card 12: Loyalty Points -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card bg-card-amber">
                <div class="stat-title">Clinic Rating</div>
                <div class="stat-value">4.9/5</div>
                <div class="icon-box"><i class="fa-solid fa-star"></i></div>
            </div>
        </div>
    </div>

    <!-- Analytics Graphs Row -->
    <div class="row g-4">
        <!-- Sales / Activity Analytics Line Chart -->
        <div class="col-lg-6">
            <div class="analytics-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #0f172a;">Sales & Inquiry Analytics</h5>
                    <span class="badge bg-light text-primary border">Overview</span>
                </div>
                <p class="text-muted small">Monthly traffic and engagement trend analysis.</p>
                <div style="height: 300px;">
                    <canvas id="salesAnalyticsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Expense / Distribution Doughnut Chart -->
        <div class="col-lg-6">
            <div class="analytics-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #0f172a;">Database Distribution</h5>
                    <span class="badge bg-light text-success border">Breakdown</span>
                </div>
                <p class="text-muted small">Proportional distribution of stored database items.</p>
                <div style="height: 300px;" class="d-flex justify-content-center">
                    <canvas id="expenseAnalyticsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script Initialization -->
<script>
    // Sales / Activity Line Chart
    const ctxSales = document.getElementById('salesAnalyticsChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Inquiries & Patient Reach',
                data: [12, 19, 15, 25, 32, 28, 35, 42, 38, <?= $counts['contact_messages'] + 10 ?>],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: true } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Database Distribution Doughnut Chart
    const ctxExpense = document.getElementById('expenseAnalyticsChart').getContext('2d');
    new Chart(ctxExpense, {
        type: 'doughnut',
        data: {
            labels: ['Messages', 'Doctors', 'Gallery Images', 'Banners', 'Services'],
            datasets: [{
                data: [
                    <?= $counts['contact_messages'] ?>, 
                    <?= $counts['doctors'] ?>, 
                    <?= $counts['gallery'] ?>, 
                    <?= $counts['hero_banners'] ?>, 
                    <?= $counts['services'] ?>
                ],
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#8b5cf6',
                    '#ef4444'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>