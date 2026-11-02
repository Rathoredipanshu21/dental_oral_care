<?php
/**
 * LX Interior - Admin Enquiries Dashboard
 * File: admin/enquiries.php
 * Description: Secure admin panel to view all client inquiries fetched from MySQL via ../config/db.php,
 * featuring a centered modal popup for full details inspection and professional AKCS branding.
 */

// Include database configuration
$dbPath = __DIR__ . '/../config/db.php';
$pdo = null;

if (file_exists($dbPath)) {
    include_once $dbPath;
} else {
    // Fallback connection if path needs adjustment
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=lx_interior", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $dbError = "Database connection failed: " . $e->getMessage();
    }
}

// Fetch all inquiries
$inquiries = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM client_inquiries ORDER BY created_at DESC");
        $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $dbQueryError = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Client Inquiries | LX Interior</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../Assets/icon.png" type="image/x-icon" onerror="this.href='https://placehold.co/32x32/96703C/FFFFFF?text=LX'">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gold: #96703C; 
            --white: #FFFFFF;
            --dark-olive: #2B2A0C;
            --border-color: #D8D2C5;
            --text-gray: #666666;
            --light-bg: #F7F5F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-olive);
        }

        /* --- ADMIN HEADER --- */
        .admin-header {
            background-color: var(--dark-olive);
            color: var(--white);
            padding: 18px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-gold);
        }

        .admin-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-brand span {
            color: var(--primary-gold);
        }

        .admin-user {
            font-size: 0.9rem;
            color: #D8D2C5;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* --- MAIN DASHBOARD CONTAINER --- */
        .dashboard-container {
            padding: 40px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .dashboard-title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-title-bar h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--dark-olive);
        }

        .badge-count {
            background: var(--primary-gold);
            color: var(--white);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* --- TABLE STYLING --- */
        .table-card {
            background: var(--white);
            border-radius: 4px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(43, 42, 12, 0.04);
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        .data-table th {
            background: #F4F0E8;
            color: var(--dark-olive);
            padding: 16px 20px;
            font-weight: 600;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            border-bottom: 1px solid var(--border-color);
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #ECE7DE;
            color: var(--dark-olive);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background-color: #FAFAFA;
        }

        .btn-view {
            background: var(--dark-olive);
            color: var(--white);
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            transition: background 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-view:hover {
            background: var(--primary-gold);
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: var(--text-gray);
            font-style: italic;
        }

        /* --- CENTERED MODAL POPUP --- */
        #detail-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(43, 42, 12, 0.82);
            backdrop-filter: blur(6px);
            z-index: 10000;
            display: none;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-card {
            background: var(--white);
            max-width: 750px;
            width: 100%;
            max-height: 90vh;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            border: 1px solid var(--primary-gold);
            animation: modalPop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            overflow: hidden;
        }

        .modal-header {
            background: var(--dark-olive);
            color: var(--white);
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
            color: var(--white);
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            color: var(--white);
            font-size: 1.3rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .modal-close-btn:hover {
            color: var(--primary-gold);
        }

        .modal-body {
            padding: 30px;
            overflow-y: auto;
            max-height: calc(90vh - 80px);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-item {
            background: #FAF8F5;
            padding: 14px 18px;
            border-radius: 3px;
            border: 1px solid var(--border-color);
        }

        .detail-item.full-width {
            grid-column: span 2;
        }

        .detail-label {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-gold);
            font-weight: 700;
            margin-bottom: 4px;
            display: block;
        }

        .detail-value {
            font-size: 0.95rem;
            color: var(--dark-olive);
            font-weight: 500;
            word-break: break-word;
        }

        .detail-value a {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
        }
        .detail-value a:hover {
            text-decoration: underline;
        }

        @keyframes modalPop {
            0% { transform: scale(0.85); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 768px) {
            .detail-grid { grid-template-columns: 1fr; }
            .detail-item.full-width { grid-column: span 1; }
            .dashboard-title-bar { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
</head>
<body>

    <!-- ADMIN HEADER -->
    <header class="admin-header">
        <div class="admin-brand">
            <i class="fa-solid fa-shield-halved" style="color: var(--primary-gold);"></i>
            LX Interior <span>Admin Portal</span>
        </div>
        <div class="admin-user">
            <i class="fa-solid fa-user-tie"></i> AKCS Management
        </div>
    </header>

    <!-- DASHBOARD CONTENT -->
    <main class="dashboard-container">
        <div class="dashboard-title-bar">
            <h1>Client Inquiries <span class="badge-count"><?php echo count($inquiries); ?></span></h1>
        </div>

        <div class="table-card">
            <?php if (isset($dbError)): ?>
                <div style="padding: 30px; color: #b52a2a; text-align: center;">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($dbError); ?>
                </div>
            <?php elseif (empty($inquiries)): ?>
                <div class="no-data">
                    <i class="fa-regular fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                    No client inquiries found in the database yet.
                </div>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Client Name</th>
                            <th>Contact Number</th>
                            <th>Property Type</th>
                            <th>Submitted Date</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inquiries as $row): ?>
                            <tr>
                                <td><strong>#<?php echo htmlspecialchars($row['id'] ?? ''); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['client_name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['contact_number'] ?? ''); ?></td>
                                <td><span style="background: #F4F0E8; padding: 4px 10px; border-radius: 3px; font-size: 0.85rem; font-weight: 600;"><?php echo htmlspecialchars($row['property_type'] ?? ''); ?></span></td>
                                <td><?php echo htmlspecialchars($row['created_at'] ?? ''); ?></td>
                                <td style="text-align: center;">
                                    <button class="btn-view" onclick='openModal(<?php echo json_encode($row); ?>)'>
                                        <i class="fa-solid fa-eye"></i> View Details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <!-- CENTERED DETAIL MODAL -->
    <div id="detail-modal">
        <div class="modal-card">
            <div class="modal-header">
                <h2>Inquiry Questionnaire Breakdown</h2>
                <button class="modal-close-btn" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="detail-grid" id="modal-content-grid">
                    <!-- Populated dynamically via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT FOR MODAL INTERACTION -->
    <script>
        function openModal(data) {
            const grid = document.getElementById('modal-content-grid');
            grid.innerHTML = `
                <div class="detail-item">
                    <span class="detail-label">Client Full Name</span>
                    <span class="detail-value">${data.client_name || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Contact Number / WhatsApp</span>
                    <span class="detail-value">${data.contact_number || 'N/A'}</span>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Complete Property Address</span>
                    <span class="detail-value">${data.property_address || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Property Type</span>
                    <span class="detail-value">${data.property_type || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Property Status</span>
                    <span class="detail-value">${data.property_status || 'N/A'}</span>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Family Details</span>
                    <span class="detail-value">${data.family_details || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Possession Received?</span>
                    <span class="detail-value">${data.possession_received || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Work Availability</span>
                    <span class="detail-value">${data.work_availability || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">3D Visualisation Preference</span>
                    <span class="detail-value">${data.pref_3d || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Design Scope</span>
                    <span class="detail-value">${data.design_scope || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Design Theme</span>
                    <span class="detail-value">${data.design_theme || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">False Ceiling</span>
                    <span class="detail-value">${data.false_ceiling || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Home Automation</span>
                    <span class="detail-value">${data.home_automation || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Turnkey Furnishing</span>
                    <span class="detail-value">${data.include_furnishing || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Preferred Interior Style</span>
                    <span class="detail-value">${data.interior_style || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Submission Timestamp</span>
                    <span class="detail-value">${data.created_at || 'N/A'}</span>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Reference Notes / Links</span>
                    <span class="detail-value">${data.preferred_designs_text || 'N/A'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Floor Plan Document</span>
                    <span class="detail-value">${data.floor_plan ? `<a href="../${data.floor_plan}" target="_blank"><i class="fa-solid fa-file-pdf"></i> Download Floor Plan</a>` : 'Not Provided'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Reference Moodboard Image</span>
                    <span class="detail-value">${data.reference_image ? `<a href="../${data.reference_image}" target="_blank"><i class="fa-solid fa-image"></i> View Image</a>` : 'Not Provided'}</span>
                </div>
            `;
            document.getElementById('detail-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('detail-modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('detail-modal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>